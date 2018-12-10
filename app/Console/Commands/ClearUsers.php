<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class ClearUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear users table last update in one month.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $date = Carbon::now()->subMonth();

        $amount = DB::table('users')->where('updated_at', '<=', $date)->delete();

        $this->info($amount . ' old users deleted!');
    }
}
