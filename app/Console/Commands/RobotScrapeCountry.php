<?php

namespace App\Console\Commands;

use App\Console\Services\Worldometer\ScrapeCountryService;
use App\Helpers\Country as CountryHelper;
use App\Http\Models\Location;
use App\Http\Models\LocationImport;
use App\Http\Models\LocationType;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RobotScrapeCountry extends Command
{
    /**
     * @var string
     */
    protected $signature = 'robot:import:country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

    private function getCountriesToUpdate()
    {
        $locationType = $this->em->find(LocationType::class, 2);

        $qry = $this->em->createQueryBuilder();
        $qry->select('lo')
            ->from(Location::class, 'lo')
            ->where('lo.locationType = :locationType')
            ->setMaxResults(3);

        $qry->setParameters([
            'locationType' => $locationType,
        ]);

        return $qry->getQuery()->getResult();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $scrapeCountry = new ScrapeCountryService();

        $countryHelper = new CountryHelper();
        $countries = $this->getCountriesToUpdate();

        /** @var Location */
        foreach ($countries as $country) {
            $this->info('Downloading: HTML');
            $scrapeCountry->rock($country->getCode(), $countryHelper->getNameByIso($country->getCode()));
            $this->info('Mapped: ' . '250' . ' rows');
            $scrapeCountry->roll();
            $this->info('Imported: ' . '123' . ' locations');
        }
    }
}
