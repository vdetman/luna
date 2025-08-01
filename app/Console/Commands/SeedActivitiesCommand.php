<?php

namespace App\Console\Commands;

use Database\Seeders\ActivitySeeder;
use Illuminate\Console\Command;

class SeedActivitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed activities table with test data';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Seeding activities...');

        $seeder = new ActivitySeeder();
        $seeder->run();

        $this->info('Activities seeded successfully!');

        return Command::SUCCESS;
    }
} 