<?php

namespace App\Http\Services\Location;

use App\Http\Models\Location;

class MapsService
{
    /** @var float */
    private $logMultiplier;

    /** @var array **/
    private $world;

    /** @var EntityManager */
    private $em;

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->em = app('em');
        $this->setWorld($location);
    }

    /**
     * @param PersistentCollection $locationsList
     * @return void
     */
    private function setLogMultiplier(array $locationsList): void
    {
        $highestValue = 0;
        foreach ($locationsList as $locationItem) {
            if (empty($locationItem->getCode()) === true) {
                continue;
            }

            if ($highestValue === 0) {
                $highestValue = $locationItem->getLocationNumbers()->getConfirmed() - $locationItem->getLocationNumbers()->getDeaths() - $locationItem->getLocationNumbers()->getCured();
                continue;
            }
            $currentValue = $locationItem->getLocationNumbers()->getConfirmed() - $locationItem->getLocationNumbers()->getDeaths() - $locationItem->getLocationNumbers()->getCured();
            if ($highestValue < $currentValue) {
                $highestValue = $currentValue;
            }
        }

        $this->logMultiplier = 100 / log($highestValue);
    }

    /**
     * @param Location $location
     * @return void
     */
    private function setWorld(Location $location): void
    {
        $locationsList = $this->em->getRepository(Location::class)->findBy(
            ['locationType' => $location->getLocationType()],
            ['name' => 'ASC']
        );

        $this->setLogMultiplier($locationsList);

        $this->world = [];
        foreach ($locationsList as $locationItem) {
            if (empty($locationItem->getCode()) === true) {
                continue;
            }

            $activeCases = $locationItem->getLocationNumbers()->getConfirmed() - $locationItem->getLocationNumbers()->getDeaths() - $locationItem->getLocationNumbers()->getCured();
            $this->world[] = [
                [
                    'v' => $locationItem->getCode(),
                    'f' => $locationItem->getName(),
                ],
                // $this->getLogScale($activeCases),
                $activeCases,
                'Casos ativos: ' . $activeCases,
            ];
        }
    }

    /**
     * @param integer $value
     * @return integer
     */
    private function getLogScale(int $value): int
    {
	    return round((($this->logMultiplier * log($value)) / 10), 0);
    }

    /**
     * @return array
     */
    public function getWorld(): array
    {
        return $this->world;
    }
}