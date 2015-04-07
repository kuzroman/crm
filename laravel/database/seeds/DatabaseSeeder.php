<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('MutualCalcsSeeder');
        $this->call('BuyersSeeder');
        $this->call('KindBuyersSeeder');
        $this->call('ContactsSeeder');
        $this->call('OrdersSeeder');
        $this->call('PlacesSeeder');
        $this->call('KindCostsSeeder');
        $this->call('EmployeesSeeder');
	}
}