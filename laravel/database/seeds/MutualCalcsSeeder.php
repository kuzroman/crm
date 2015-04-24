<?php
use Illuminate\Database\Seeder;
use App\Models\MutualCalc;

class MutualCalcsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        MutualCalc::truncate(); // очистить таблицу Buyer от предыдущих записей

        // faker добавит n разных записей в базу
        for ($i = 10; $i < 21; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json

            $dateCreated = '2015-04-';

            if ($i % 2 == 0) {
                $id_buyer = $faker->numberBetween($min = 1, $max = 10);
                $id_employee = '';
            }
            else {
                $id_buyer = '';
                $id_employee = $faker->numberBetween($min = 1, $max = 3);
            }

            MutualCalc::create([
                'date' => $dateCreated . $i,
                'id_order' => $faker->numberBetween($min = 1, $max = 10),
                'id_buyer' => $id_buyer,
                'id_employee' => $id_employee,
                'id_kindcost' => $faker->numberBetween($min = 1, $max = 3),
                'sum' => $faker->randomNumber(5),
                'desc' => $faker->text(100),
            ]);
        }
    }

}