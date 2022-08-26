<?php

use App\Message;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $message = new Message();
            $message->name = $faker->firstName();
            $message->surname = $faker->lastName();
            $message->email = $faker->email();
            $message->message_content = $faker->paragraph();
            $message->save();
        }

    }
}
