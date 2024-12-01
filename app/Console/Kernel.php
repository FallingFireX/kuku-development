<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
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
     */
    protected function schedule(Schedule $schedule) {
        $schedule->command('check-news')
            ->everyMinute();
        $schedule->command('check-sales')
            ->everyMinute();
        $schedule->command('change-feature')
            ->monthly();
        $schedule->command('clean-donations')
            ->everyMinute();
        $schedule->exec('rm public/images/avatars/*.tmp')
            ->daily()->at('01:02');
        $schedule->command('update-extension-tracker')
            ->daily()->at('01:05');
        $schedule->command('update-credits')
            ->daily()->at('01:10');
        $schedule->command('update-staff-reward-actions')
            ->daily()->at('01:01');
        $schedule->command('restock-shops')
            ->daily()->at('01:15');
        $schedule->command('update-timed-stock')
            ->everyMinute();       
        $schedule->command('distribute-birthday-rewards')
            ->monthly(); // Runs on the 1st of every month at midnight
        $schedule->command('reset-hol')
            ->daily()->at('01:20');
        $schedule->command('update-timed-daily')
            ->everyMinute();          

    }

    /**
     * Register the commands for the application.
     */
    protected function commands() {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
