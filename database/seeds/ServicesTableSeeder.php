<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'Wifi', 'Parking slot', 'Swimming pool', 'Sauna', 'Reception'
        ];

        foreach ($services as $service) {
            $new_service = new Service();
            $new_service->name = $service;
            $new_service->save();
        }

    }
}
