<?php

namespace App\Console\Commands;

use App\Console\Services\Worldometer\ScrapeWorldService;
use App\Http\Models\LocationImport;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RobotScrapeWorld extends Command
{
    /**
     * @var string
     */
    protected $signature = 'robot:import:world';

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

    private $scrapeWorld;

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
        $this->info('Downloading: HTML');
        $scrapeWorld = new ScrapeWorldService();
        $scrapeWorld->rock();
        $this->info('Mapped: ' . '250' . ' rows');

        $cmd = $this->em->getClassMetadata(LocationImport::class);
        $dbPlatform = $this->em->getConnection()->getDatabasePlatform();
        $query = $dbPlatform->getTruncateTableSql($cmd->getTableName());
        $this->em->getConnection()->executeUpdate($query);
        $this->info('Truncated: ' . $cmd->getTableName());
        //
        $scrapeWorld->roll();
        $this->info('Imported: ' . '123' . ' locations');
    }
}
