<?php

use App\View;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $view = new View();
            $view->user_ip = $faker->ipv4();
            $view->save();
        }
    }
}
