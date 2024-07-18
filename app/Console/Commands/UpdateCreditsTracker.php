<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateCreditsTracker extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-credits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command in order to add artist credits to your list of credits. This helps you to keep track of what artworks are used on your site and who created them.';

    /**
     * Create a new command instance.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info("\n".'****************************');
        $this->info('* UPDATE CREDITS TRACKER *');
        $this->info('****************************');

        $extendos = [];
        foreach (glob('config/lorekeeper/creds-tracker/*.php') as $cred) {
            $extendos[basename($cred, '.php')] = include $cred;
        }

        $this->line('Adding site credits...existing entries will be updated.'."\n");

        foreach ($extendos as $key => $data) {
            $cred = DB::table('site_creds')->where('key', $key);
            if (!$cred->exists()) {
                DB::table('site_creds')->insert([
                    'key'      => $key,
                    'creator' => $data['creator'],
                    'credits' => $data['credits'],
                ]);
                $this->info('Added:   '.$key.' / Credits: '.$data['credits']);
            } else {
                $this->line('Skipped: '.$key.' / Credits: '.$data['credits']);
            }
        }

        if (app()->runningInConsole()) {
            $creds = DB::table('site_creds')->pluck('key')->toArray();
            $processed = array_keys($extendos);

            $missing = array_merge(array_diff($processed, $creds), array_diff($creds, $processed));

            if (count($missing)) {
                $miss = implode(', ', $missing);
                $this->line("\033[31m");
                $this->error('The following credit'.(count($missing) == 1 ? ' is' : 's are').' not present as a file but '.(count($missing) == 1 ? 'is' : 'are').' still in your database:');
                $this->line($miss);

                $confirm = $this->confirm('Do you want to remove '.(count($missing) == 1 ? 'this credit' : 'these credits').' from your database and credits list? This will not affect any other files.');
                if ($confirm) {
                    foreach ($missing as $ext) {
                        $cred = DB::table('site_creds')->where('key', $ext)->delete();
                        $this->info('Deleted:   '.$ext);
                    }
                } else {
                    $this->line('Leaving credit'.(count($missing) == 1 ? '' : 's').' alone.');
                }
            }
        }

        $this->info("\n".'All credits are in tracker.'."\n");
    }
}
