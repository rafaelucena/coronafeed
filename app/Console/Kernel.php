<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('robot:import:world')->twiceDaily(10, 22);
        $schedule->command('robot:refresh:numbers')->twiceDaily(11, 23);

        $schedule->command('robot:import:country highest')->dailyAt('12:00');
        $schedule->command('robot:import:country high')
                 ->mondays()
                 ->wednesdays()
                 ->fridays()
                 ->at('13:00');
        $schedule->command('robot:import:country normal')
                 ->mondays()
                 ->fridays()
                 ->at('14:00');
        $schedule->command('robot:import:country low')
                 ->weeklyOn(1, '15:00');
        $schedule->command('robot:import:country lowest')
                 ->monthlyOn(15, '16:00');
        $schedule->command('robot:refresh:history')->dailyAt('17:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
