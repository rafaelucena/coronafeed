<?php

namespace App\Helpers;

class Country
{
    /** @var array */
    private $countries;

    public function __construct()
    {
        $this->countries = json_decode(file_get_contents(base_path('storage/helpers/countries.json')), true);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getIsoByName(string $name): string
    {
        $name = strtolower($name);
        foreach ($this->countries as $countryInfo) {
            if ($countryInfo['name'] === $name) {
                return $countryInfo['iso'];
            }
        }

        return '';
    }

    /**
     * @param string $name
     * @return string
     */
    public function getIsoByWorldometerName(string $name): string
    {
        $name = strtolower($name);
        foreach ($this->countries as $countryInfo) {
            if ($countryInfo['worldometer_name'] === $name) {
                return $countryInfo['iso'];
            }
        }

        return '';
    }

    /**
     * @param string $code
     * @return string
     */
    public function getNameByIso(string $code): string
    {
        $code = strtolower($code);

        if (empty($this->countries[$code]) === false) {
            $country = $this->countries[$code];
            return $country['name'];
        }

        return '';
    }

    /**
     * @param string $code
     * @return string
     */
    public function getHistoryNameByIso(string $code): string
    {
        $code = strtolower($code);

        if (empty($this->countries[$code]) === false) {
            $country = $this->countries[$code];

            if (empty($country['worldometer_route']) === false) {
                return $country['worldometer_route'];
            } elseif (empty($country['worldometer_name']) === false) {
                return $country['worldometer_name'];
            }
            return $country['name'];
        }

        return '';
    }
}
