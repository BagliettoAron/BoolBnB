<?php

use App\Accomodation;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AccomodationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $accomodation = new Accomodation();
            // $accomodation->user_id = $faker->numberBetween(1,$i);
            $accomodation->title = $faker->sentence();
            $accomodation->picture = $faker->imageUrl(640, 480, 'house_picture', true);
            $accomodation->number_of_rooms = $faker->numberBetween(1, 15);
            $accomodation->number_of_beds = $faker->numberBetween(1, 15);
            $accomodation->number_of_bathrooms = $faker->numberBetween(1, 5);
            $accomodation->square_meters = $faker->numberBetween(20, 500);
            $accomodation->price_per_night = $faker->numberBetween(20, 10000);
            $accomodation->visible = $faker->boolean();
            $accomodation->address = $faker->address();
            $accomodation->lat = $faker->latitude($min = -90, $max = 90);
            $accomodation->lon = $faker->longitude($min = -180, $max = 180);
            $accomodation->save();

        }
    }
}
