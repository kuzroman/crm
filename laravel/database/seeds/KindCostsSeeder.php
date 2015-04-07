<?php
use Illuminate\Database\Seeder;
use App\Models\KindCost;

class KindCostsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        KindCost::truncate(); // очистить таблицу Buyer от предыдущих записей

        $list = ['Материалы','Выплата работнику','Оборудование','Аренда','Хоз.нужды','Прочее', 'Премия работнику',
            'Налог НДС или УСН','Налог по зарплатам и выплаты в фонды','БРАК','Выплата по кредиту',];

        // faker добавит n разных записей в базу
        for ($i = 0; $i < 11; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json

            KindCost::create([
                'name' => $list[$i]
            ]);
        }
    }

}