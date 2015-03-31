<?php
use Illuminate\Database\Seeder;
use App\Models\KindBuyer;

class KindBuyersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        KindBuyer::truncate(); // очистить таблицу Buyer от предыдущих записей

        $list = ['Покупатель', 'Поставщик', 'Сотрудник', 'Пок-ль и Пост-щик' ];

        // faker добавит n разных записей в базу
        for ($i = 0; $i < 3; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json



            KindBuyer::create([
                'kind' => $list[$i]
            ]);
        }
    }

}