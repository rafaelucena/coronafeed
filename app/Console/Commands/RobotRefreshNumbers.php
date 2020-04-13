<?php

namespace App\Console\Commands;

use App\Http\Models\Location;
use App\Http\Models\LocationType;
use App\Http\Models\LocationImport;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RobotRefreshNumbers extends Command
{
    /**
     * @var string
     */
    protected $signature = 'robot:refresh:numbers';

    /**
     * @var string
     */
    protected $description = 'Refresh location numbers using imported data';

    /**
     * @var EntityManager
     */
    private $em;

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
            $locationNumbers = $location->getLocationNumbers();
            $location->getCode();

            /** @var LocationImport $locationImport */
            $locationImport = $this->em->getRepository(LocationImport::class)->findOneBy([
                'code' => $location->getCode(),
                'type' => 'today',
            ]);

            if ($locationImport !== null && $locationNumbers->getConfirmed() < $locationImport->getTotalCases()) {
                /** @var LocationImport $locationImportOld */
                $locationImportOld = $this->em->getRepository(LocationImport::class)->findOneBy([
                    'code' => $location->getCode(),
                    'type' => 'yesterday',
                ]);
                $locationNumbers->setCured($locationImport->getTotalRecovered());
                $locationNumbers->setNewCases($locationImportOld->getNewCases());
                $locationNumbers->setDeaths($locationImport->getTotalDeaths());
                $this->em->persist($locationNumbers);
            }
            // $this->info('Dirty: ' . $locationImport->dirty;
        }

        $this->em->flush();
    }
}
