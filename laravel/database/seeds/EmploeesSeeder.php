<?php
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Employee::truncate(); // очистить таблицу Buyer от предыдущих записей

        // faker добавит n разных записей в базу
        for ($i = 0; $i < 10; $i++) {
            // описание faker - http://systemsarchitect.net/faker-the-ultimate-lorem-ipsum-for-php/
            // и здесь - https://github.com/fzaninotto/Faker/blob/master/composer.json

            Employee::create([
                'name' => $faker->name,
                'salary' => $faker->randomNumber(5),
                'isWork' => $faker->boolean(),
            ]);
        }
    }

}