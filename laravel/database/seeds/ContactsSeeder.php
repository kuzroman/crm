<?php
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Contact::truncate(); // очистить таблицу Buyer от предыдущих записей

        // faker добавит n разных записей в базу
        for ($i = 0; $i < 10; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json
            Contact::create([
                'name' => $faker->name,
                'cell_1' => $faker->phoneNumber,
                'cell_2' => $faker->phoneNumber,
                'email' => $faker->email
            ]);
        }
    }

}