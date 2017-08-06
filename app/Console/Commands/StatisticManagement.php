<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\StatisticManagementController;

class StatisticManagement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:statistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Statistic Management';

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
     * @return mixed
     */
    public function handle()
    {
        // Thống kê
        $statistic = new StatisticManagementController;

        //\Log::info('Tick');
    }
}
