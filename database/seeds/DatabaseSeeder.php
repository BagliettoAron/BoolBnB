<?php

use App\Accomodation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccomodationsTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(ViewsTableSeeder::class);

    }
}
