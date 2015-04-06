<?php
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Order::truncate(); // очистить таблицу Buyer от предыдущих записей

        // faker добавит n разных записей в базу
        for ($i = 10; $i < 21; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json

            $dateCreated = '2015-04-';
            //$dateCreated = $faker->date($format = 'Y-m-d', $max = 'now');
            //$dateCompleted = $faker->date($format = 'Y-m-d', $max = 'now' );

            Order::create([
                'dateCreated' => $dateCreated . $i,
                'dateCompleted' => $dateCreated . ($i + 2),
                'id_buyer' => $faker->numberBetween($min = 1, $max = 10),
                'id_place' => $faker->numberBetween($min = 1, $max = 3),
                'desc' => $faker->text(100),
                'price' => $faker->randomNumber(5),
                'cash' => $faker->boolean(),
                'paid' => $faker->boolean(),
                'finished' => $faker->boolean(),
            ]);
        }
    }

}