<?php

namespace App\Console\Services\Worldometer;

use App\Http\Models\LocationImport;
use App\Helpers\Country;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ScrapeWorldService
{
    /** @var EntityManager */
    private $em;

    /** @var bool */
    private $isTest = false;

    /** @var string */
    private $webBaseUrl = 'https://www.worldometers.info/coronavirus/';

    /** @var string */
    private $webContent;

    /** @var array */
    private $webContentTableItems;

    /** @var array */
    private $mappedLocations = [];

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
     * @return void
     */
    public function rock(): void
    {
        $this->setContent();
        $this->setContentTables();
        $this->mapLocations();
    }

    /**
     * @return void
     */
    private function setContent(): void
    {
        if ($this->isTest === true) {
            $this->webContent = file_get_contents(base_path('storage/mocks/worldometers-coronavirus-20200601.html'));
            return;
        }

        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $this->webBaseUrl);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlObj, CURLOPT_HEADER, true);

        $this->webContent = curl_exec($curlObj);
        curl_close($curlObj);
    }

    /**
     * @return void
     */
    private function setContentTables(): void
    {
        $tablesToFind = [
            'today' => '<table id="main_table_countries_today',
            'yesterday' => '<table id="main_table_countries_yesterday',
        ];

        foreach ($tablesToFind as $tableName => $tableOpenTag) {
            $tableOpenTagPos = strpos($this->webContent, $tableOpenTag);
            $tableCloseTag = '</table>';
            $tableCloseTagPos = strpos($this->webContent, $tableCloseTag, $tableOpenTagPos);
            $tableContent = substr($this->webContent, ($tableOpenTagPos), ($tableCloseTagPos - $tableOpenTagPos));

            $this->setContentTableItems($tableName, $tableContent, 'world');
            $this->setContentTableItems($tableName, $tableContent, 'countries');
        }
    }

    /**
     * @param string $tableName
     * @param string $tableContent
     * @param string $type
     * @return void
     */
    private function setContentTableItems(string $tableName, string $tableContent, string $type): void
    {
        $offset = 0;
        $count = 0;

        $itemOpenTag = '<tr style="';
        if ($type === 'world') {
            $itemOpenTag = '<tr class="total_row_world';
        }
        $itemCloseTag = '</tr>';
        $itemOpenTagPos = strpos($tableContent, $itemOpenTag);
        while ($itemOpenTagPos == true) {
            //preventing infinite loop
            if ($count > 250) {
                break;
            }

            $itemOpenTagPos = strpos($tableContent, $itemOpenTag, $offset);
            $offset = $itemCloseTagPos = strpos($tableContent, $itemCloseTag, $itemOpenTagPos);
            $itemResult = substr($tableContent, $itemOpenTagPos, ($itemCloseTagPos - $itemOpenTagPos));
            // $itemResult = preg_replace('/\r|\n/', '', $itemResult);

            $this->webContentTableItems[$tableName][] = $itemResult;

            if (empty($offset)) {
                $offset = -1;
            }
            $count++;
        }
    }

    /**
     * @return void
     */
    private function mapLocations(): void
    {
        foreach ($this->webContentTableItems as $tableName => $tableItems) {
            foreach ($tableItems as $content) {
                $mappedContent = $this->getContentArray($content);
                $this->mappedLocations[$mappedContent['country']][$tableName] = $mappedContent;
            }
        }
    }

    /**
     * @param string $content
     * @return array
     */
    private function getContentArray(string $content): array
    {
        preg_match_all('/>(.+)?</', $content, $matches);

        $countryName = $matches[1][1];
        preg_match('/>(.+)</', $countryName, $nameMatch);
        if (isset($nameMatch[1]) === true) {
            $countryName = ($nameMatch[1]);
        }

        $population = $matches[1][13];
        preg_match('/>(.+)</', $population, $populationMatch);
        if (isset($populationMatch[1]) === true) {
            $population = ($populationMatch[1]);
        }

        $result = [
            'order' => (int) $this->removeTrashString($matches[1][0]),
            'country' => $countryName,
            'total_cases' => (int) $this->removeTrashString($matches[1][2]),
            'new_cases' => (int) $this->removeTrashString($matches[1][3]),
            'total_deaths' => (int) $this->removeTrashString($matches[1][4]),
            'new_deaths' => (int) $this->removeTrashString($matches[1][5]),
            'total_recovered' => (int) $this->removeTrashString($matches[1][6]),
            'active_cases' => (int) $this->removeTrashString($matches[1][7]),
            'serious_critical' => (int) $this->removeTrashString($matches[1][8]),
            'cases_by_1m_pop' => (float) $this->removeTrashString($matches[1][9]),
            'deaths_by_1m_pop' => (float) $this->removeTrashString($matches[1][10]),
            'total_tests' => (int) $this->removeTrashString($matches[1][11]),
            'tests_by_1m_pop' => (float) $this->removeTrashString($matches[1][12]),
            'population' => (int) str_replace(',', '', $population),
            'continent' => $this->removeTrashString($matches[1][14]),
        ];

        return $result;
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
     * @param string $location
     * @return array
     */
    public function getMappedLocation(string $location): array
    {
        return $this->mappedLocations[$location];
    }

    /**
     * @return array
     */
    public function getLocationsList(): array
    {
        return array_keys($this->mappedLocations);
    }

    /**
     * @return void
     */
    public function roll(): void
    {
        $this->em = app('em');

        $country = new Country();
        foreach ($this->mappedLocations as $location => $mappedLocation) {
            foreach ($mappedLocation as $type => $mapped) {
                $code = $country->getIsoByName($location) === '' ? $country->getIsoByWorldometerName($location) : $country->getIsoByName($location);
                $locationImport = new LocationImport();
                $locationImport->setCode($code);
                $locationImport->setCountry($location);
                $locationImport->setTotalCases($mapped['total_cases'] ?? 0);
                $locationImport->setNewCases($mapped['new_cases'] ?? 0);
                $locationImport->setTotalDeaths($mapped['total_deaths'] ?? 0);
                $locationImport->setNewDeaths($mapped['new_deaths'] ?? 0);
                $locationImport->setTotalRecovered($mapped['total_recovered'] ?? 0);
                $locationImport->setActiveCases($mapped['active_cases'] ?? 0);
                $locationImport->setSeriousCritical($mapped['serious_critical'] ?? 0);
                $locationImport->setCasesByPopulation($mapped['cases_by_1m_pop'] ?? 0);
                $locationImport->setDeathsByPopulation($mapped['deaths_by_1m_pop'] ?? 0);
                $locationImport->setTotalTests($mapped['total_tests'] ?? 0);
                $locationImport->setTestsByPopulation($mapped['tests_by_1m_pop'] ?? 0);
                $locationImport->setContinent($mapped['continent'] ?? '');
                $locationImport->setType($type);
                $this->em->persist($locationImport);
            }
        }
        $this->em->flush();
    }
}