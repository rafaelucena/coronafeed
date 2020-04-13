<?php

namespace App\Console\Services;

use App\Http\Models\LocationImport;
use App\Helpers\Country;

class ScrapeWorldOMetersService
{
    private $em;

    private $webBaseUrl = 'https://www.worldometers.info/coronavirus/';

    private $webContent;

    private $webContentTableItems;

    private $mappedLocations = [];

    public function __construct()
    {
        $this->em = app('em');
        $this->setContent($this->webBaseUrl);
        $this->setContentTables();
        $this->mapLocations();
    }

    private function setContent(string $url)
    {
        // $this->webContent = file_get_contents(base_path('public/mock/worldometers-data.html'));
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $url);
        // // $User_Agent = 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
        // // curl_setopt($curlObj, CURLOPT_USERAGENT, $User_Agent);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlObj, CURLOPT_HEADER, true);
        $this->webContent = curl_exec($curlObj);

        curl_close($curlObj);
    }

    private function setContentTables()
    {
        $tablesToFind = ['today' => '<table id="main_table_countries_today', 'yesterday' => '<table id="main_table_countries_yesterday'];

        foreach ($tablesToFind as $tableName => $tableOpenTag) {
            $tableOpenTagPos = strpos($this->webContent, $tableOpenTag);
            $tableCloseTag = '</table>';
            $tableCloseTagPos = strpos($this->webContent, $tableCloseTag, $tableOpenTagPos);
            $tableContent = substr($this->webContent, ($tableOpenTagPos), ($tableCloseTagPos - $tableOpenTagPos));

            $this->setContentTableItems($tableName, $tableContent);
        }
    }

    private function setContentTableItems(string $tableName, string $tableContent)
    {
        $offset = 0;
        $count = 0;
        $itemOpenTag = '<tr style="';
        $itemCloseTag = '</tr>';
        $itemOpenTagPos = strpos($tableContent, $itemOpenTag);
        while ($itemOpenTagPos == true) {
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

    private function mapLocations()
    {
        foreach ($this->webContentTableItems as $tableName => $tableItems) {
            foreach ($tableItems as $content) {
                $mappedContent = $this->getContentArray($content);
                $this->mappedLocations[$mappedContent['country']][$tableName] = $mappedContent;
            }
        }
    }

    private function getContentArray(string $content)
    {
        preg_match_all('/>(.+)?</', $content, $matches);

        $countryName = $matches[1][0];
        preg_match('/>(.+)</', $countryName, $nameMatch);
        if (isset($nameMatch[1]) === false) {
            return [
                'country' => 'error',
                'continent' => $countryName,
            ];
        }
        $countryName = ($nameMatch[1]);

        $result = [
            'country' => $countryName,
            'total_cases' => (int) $this->removeTrashString($matches[1][1]),
            'new_cases' => (int) $this->removeTrashString($matches[1][2]),
            'total_deaths' => (int) $this->removeTrashString($matches[1][3]),
            'new_deaths' => (int) $this->removeTrashString($matches[1][4]),
            'total_recovered' => (int) $this->removeTrashString($matches[1][5]),
            'active_cases' => (int) $this->removeTrashString($matches[1][6]),
            'serious_critical' => (int) $this->removeTrashString($matches[1][7]),
            'cases_by_1m_pop' => (float) $this->removeTrashString($matches[1][8]),
            'deaths_by_1m_pop' => (float) $this->removeTrashString($matches[1][9]),
            'total_tests' => (int) $this->removeTrashString($matches[1][10]),
            'tests_by_1m_pop' => (float) $this->removeTrashString($matches[1][11]),
            'continent' => $matches[1][12],
        ];

        return $result;
    }

    private function removeTrashString($string)
    {
        return str_replace([',', '+'], ['', ''], $string);
    }

    public function getMappedLocation(string $location)
    {
        return $this->mappedLocations[$location];
    }

    public function getLocationsList()
    {
        return array_keys($this->mappedLocations);
    }

    public function roll()
    {
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