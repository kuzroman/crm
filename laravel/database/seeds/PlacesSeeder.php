<?php
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlacesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Place::truncate(); // очистить таблицу Buyer от предыдущих записей

        $list = ['Flora F1250UV', 'Mimaki jv-3 SP160', 'Mustang MG3202 DK'];

        // faker добавит n разных записей в базу
        for ($i = 0; $i < 3; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json

            Place::create([
                'name' => $list[$i]
            ]);
        }
    }

}