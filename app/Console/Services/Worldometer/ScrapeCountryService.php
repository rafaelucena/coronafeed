<?php

namespace App\Console\Services\Worldometer;

use App\Http\Models\LocationImportHistory;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ScrapeCountryService
{
    public const LABELS = [
        'coronavirus-cases-linear' => 'total-cases',
        'graph-cases-daily' => 'new-cases-daily',
        'graph-active-cases-total' => 'active-cases',
        'coronavirus-deaths-linear' => 'total-deaths',
        'graph-deaths-daily' => 'deaths-daily',
    ];

    /** @var EntityManager */
    private $em;

    /** @var bool */
    private $isTest = false;

    /** @var string */
    private $webBaseUrl = 'https://www.worldometers.info/coronavirus/country/:route:';

    /** @var string */
    private $webContent;

    /** @var array */
    private $webContentCharts;

    /** @var array */
    private $mappedCharts = [];

    /** @var int */
    private $imported;

    /** @var string */
    private $code;

    /** @var string */
    private $country;

    /**
     * @param boolean $isTest
     * @return void
     */
    public function setIsTest(bool $isTest = true): void
    {
        $this->isTest = $isTest;
    }

    /**
     * @return boolean
     */
    public function getIsTest(): bool
    {
        return $this->isTest;
    }

    /**
     * @param string $code
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $country
     * @return void
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return void
     */
    public function rock(string $code, string $country): void
    {
        $this->em = app('em');
        $this->setCode($code);
        $this->setCountry($country);
        $this->setContent();
        $this->setContentCharts();
        $this->mapCharts();
    }

    /**
     * @return void
     */
    private function setContent(): void
    {
        $this->imported = 0;
        $this->webContentCharts = [];
        $this->mappedCharts = [];
        if ($this->isTest === true) {
            $this->webContent = file_get_contents(base_path('storage/mocks/worldometers-coronavirus-country-20200505.html'));
            return;
        }

        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, str_replace(':route:', strslug($this->country), $this->webBaseUrl));
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlObj, CURLOPT_HEADER, true);

        $this->webContent = curl_exec($curlObj);
        curl_close($curlObj);
    }

    /**
     * @return void
     */
    private function setContentCharts(): void
    {
        $offset = 0;
        $count = 0;

        $chartOpenTag = 'Highcharts.chart';
        $chartCloseTag = '});';
        $chatOpenTagPos = strpos($this->webContent, $chartOpenTag);
        while ($chatOpenTagPos == true) {
            //preventing infinite loop
            if ($count > 10) {
                break;
            }

            $chatOpenTagPos = strpos($this->webContent, $chartOpenTag, $offset);
            $offset = $chartCloseTagPos = strpos($this->webContent, $chartCloseTag, $chatOpenTagPos);
            $itemResult = substr($this->webContent, $chatOpenTagPos, ($chartCloseTagPos - $chatOpenTagPos));

            $this->webContentCharts[] = $itemResult;

            if (empty($offset)) {
                $offset = -1;
            }
            $count++;
        }
    }

    /**
     * @return void
     */
    private function mapCharts(): void
    {
        $patternLabel = '/Highcharts.chart\(\'(.+)\'/';
        $patternCategories = '/categories: \[(.+)\]/';
        $patternData = '/data: \[(.+)\]/';

        $chartsByType = [];
        foreach ($this->webContentCharts as $contentChart) {
            preg_match($patternLabel, $contentChart, $match);
            if (isset($match[1]) === false) {
                continue;
            }

            $label = $match[1];
            if (isset(self::LABELS[$label]) === false) {
                continue;
            }

            preg_match($patternCategories, $contentChart, $match);
            $categories = explode(',', str_replace('"', '', $match[1]));

            preg_match($patternData, $contentChart, $match);
            $data = explode(',', $match[1]);

            foreach ($categories as $key => $category) {
                $chartsByType[$label][$category] = (int) $data[$key];
            }
        }

        $this->groupChartsByDate($chartsByType);
    }

    /**
     * @param array $chartsByType
     * @return void
     */
    private function groupChartsByDate(array $chartsByType): void
    {
        $this->mappedCharts = [];
        foreach ($chartsByType as $key => $chartByDate) {
            foreach ($chartByDate as $date => $value) {
                $this->mappedCharts[$date][$key] = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function getMappedCharts(): array
    {
        return $this->mappedCharts;
    }

    /**
     * @return integer
     */
    public function getImported(): int
    {
        return $this->imported;
    }

    /**
     * @param string $input
     * @return string
     */
    private function removeTrashString(string $input): string
    {
        return str_replace([',', '+'], ['', ''], $input);
    }

    /**
     * @return array
     */
    private function getCurrentExistingDates(): array
    {
        $qry = $this->em->createQueryBuilder();
        $qry->select('loih.code, loih.date')
            ->from(LocationImportHistory::class, 'loih')
            ->where('loih.code = :code');

        $qry->setParameters([
            'code' => $this->code,
        ]);

        $results = $qry->getQuery()->getResult();

        $dates = [];
        foreach ($results as $result) {
            $day = $result['date']->format('M d');
            $dates[$day] = $day;
        }

        return $dates;
    }

    /**
     * @return void
     */
    public function roll(): void
    {
        $labels = array_flip(self::LABELS);

        $existingDates = $this->getCurrentExistingDates();

        foreach ($this->mappedCharts as $key => $values) {
            $date = new \DateTime($key);
            if (empty($existingDates[$key]) === false) {
                continue;
            }
            $this->imported++;

            $locationImportHistory = new LocationImportHistory();
            $locationImportHistory->setCode($this->code);
            $locationImportHistory->setCountry($this->country);
            $locationImportHistory->setDate($date);
            $locationImportHistory->setTotalCases($values[$labels['total-cases']]);
            $locationImportHistory->setNewCases($values[$labels['new-cases-daily']]);
            $locationImportHistory->setActiveCases($values[$labels['active-cases']] ?? 0);
            $locationImportHistory->setTotalDeaths($values[$labels['total-deaths']]);
            $locationImportHistory->setNewDeaths($values[$labels['deaths-daily']]);
            $locationImportHistory->setTotalRecovered($values[$labels['total-cases']] - $values[$labels['total-deaths']] - ($values[$labels['active-cases']] ?? 0));

            $this->em->persist($locationImportHistory);
        }
        $this->em->flush();
    }
}