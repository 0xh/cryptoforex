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
        \App\Console\Commands\CleanPrices::class,
        \App\Console\Commands\LoadPrices::class,
        \App\Console\Commands\LoadHistominute::class,
        \App\Console\Commands\ProcessDeals::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('cryptofx:process')->everyMinute();
        // $schedule->command('cryptofx:histo')->everyMinute();
        // $schedule->command('cryptofx:prices')->everyMinute();//->emailOutputTo('yanusdnd@inbox.ru');;
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
