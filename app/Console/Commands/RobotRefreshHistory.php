<?php

namespace App\Console\Commands;

use App\Http\Models\Location;
use App\Http\Models\LocationHistory;
use App\Http\Models\LocationImportHistory;
use App\Http\Models\LocationType;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RobotRefreshHistory extends Command
{
    /** @var string */
    protected $signature = 'robot:refresh:history';

    /** @var string */
    protected $description = 'Refresh location history using imported data';

    /** @var EntityManager */
    private $em;

    /** @var array */
    private $imported;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->em = app('em');
        parent::__construct();
    }

    /**
     * @param Location $location
     * @return array
     */
    private function getExistingDates(Location $location): array
    {
        $locationHistory = $location->getLocationHistory(0);

        $existingDates = [];
            /** @var LocationHistory */
            foreach ($locationHistory as $locationHistoryItem) {
                $date = $locationHistoryItem->getDate()->format('Y-m-d');
                $existingDates[$date] = $date;
            }

        return $existingDates;
    }

    /**
     * @param Location $location
     * @return array
     */
    private function getImportedDates(Location $location): array
    {
        $results = $this->em->getRepository(LocationImportHistory::class)->findBy(
            ['code' => $location->getCode()],
            ['id' => 'ASC']
        );

        $dates = [];
        $this->imported = [];
        foreach ($results as $result) {
            $day = $result->getDate()->format('Y-m-d');
            $dates[$day] = $day;
            $this->imported[$day] = $result;
        }

        return $dates;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locationType = $this->em->getRepository(LocationType::class)->find(2);
        $locations = $this->em->getRepository(Location::class)->findBy(
            ['locationType' => $locationType],
            ['id' => 'ASC']
        );

        /** @var Location $location */
        foreach ($locations as $location) {
            $existingDates = $this->getExistingDates($location);
            $importedDates = $this->getImportedDates($location);
            $items = array_diff($importedDates, $existingDates);

            foreach ($items as $item) {
                /** @var LocationImportHistory */
                $imported = $this->imported[$item];
                $locationHistory = new LocationHistory();

                $locationHistory->setLocation($location);
                $locationHistory->setConfirmed($imported->getTotalCases());
                $locationHistory->setCured($imported->getTotalRecovered());
                $locationHistory->setDeaths($imported->getTotalDeaths());
                $locationHistory->setDate($imported->getDate());
                $this->em->persist($locationHistory);
            }
        }

        $this->em->flush();
    }
}
