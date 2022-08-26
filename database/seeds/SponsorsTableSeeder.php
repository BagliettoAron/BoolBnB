<?php

use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors_name = [
            'Silver', 'Gold', 'Platinum'
        ];

        $sponsors_prices = [
            '2.99', '5.99', '9.99'
        ];

        $sponsors_durations = [
            24, 72, 144
        ];

        for ($i=0; $i < 3; $i++) {
            $new_sponsor = new Sponsor();
            $new_sponsor->name = $sponsors_name[$i];
            $new_sponsor->price = $sponsors_prices[$i];
            $new_sponsor->duration = $sponsors_durations[$i];
            $new_sponsor->save();
        }
    }
}
