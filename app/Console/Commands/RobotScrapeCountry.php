<?php

namespace App\Console\Commands;

use App\Console\Services\Worldometer\ScrapeCountryService;
use App\Helpers\Country as CountryHelper;
use App\Http\Models\Location;
use App\Http\Models\LocationImport;
use App\Http\Models\LocationPriority;
use App\Http\Models\LocationType;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RobotScrapeCountry extends Command
{
    /**
     * @var string
     */
    protected $signature = 'robot:import:country {priority}';

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
        parent::__construct();
        $this->em = app('em');
    }

    private function getCountriesToUpdate()
    {
        $locationType = $this->em->find(LocationType::class, 2);

        $input = $this->argument('priority');
        $locationPriority = $this->em->getRepository(LocationPriority::class)->findOneBy([
            'slug' => $input,
        ]);

        $qry = $this->em->createQueryBuilder();
        $qry->select('lo')
            ->from(Location::class, 'lo')
            ->where('lo.locationType = :locationType AND lo.locationPriority = :locationPriority');

        $qry->setParameters([
            'locationType' => $locationType,
            'locationPriority' => $locationPriority,
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
            $this->info('Downloading: HTML for ' . $countryHelper->getNameByIso($country->getCode()));
            $scrapeCountry->rock($country->getCode(), $countryHelper->getHistoryNameByIso($country->getCode()));
            $this->info('Mapped: ' . count($scrapeCountry->getMappedCharts()) . ' rows');
            // print_r(current($scrapeCountry->getMappedCharts()));die;

            $scrapeCountry->roll();
            $this->info('Imported: ' . $scrapeCountry->getImported() . ' dates');

            $seconds = random_int(1, 3);
            sleep($seconds);
        }
    }
}
