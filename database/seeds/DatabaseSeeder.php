<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Type;
use App\Models\Transportation;
use App\Models\Machine;
use App\Models\Table;
use App\Models\Food;
use App\Models\Juice;
use App\Models\Drink;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Email;
use Illuminate\Support\Facades\URL;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Group_menusTableSeeder::class);
        $this->call(SedesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TransportationsTableSeeder::class);
        $this->call(MachinesTableSeeder::class);
        $this->call(TablesTableSeeder::class);
        $this->call(FoodsTableSeeder::class);
        $this->call(JuicesTableSeeder::class);
        $this->call(DrinksTableSeeder::class);
        $this->call(DomainsTableSeeder::class);
        $this->call(EmailsTableSeeder::class);
        $this->call(Ayb_itemsTableSeeder::class);
        $this->call(Brand_machinesTableSeeder::class);
        $this->call(Range_machinesTableSeeder::class);
        $this->call(Associated_machinesTableSeeder::class);
        $this->call(Value_machinesTableSeeder::class);
        $this->call(Play_machinesTableSeeder::class);
        $this->call(Model_machinesTableSeeder::class);
        $this->call(All_machinesTableSeeder::class);
        $this->call(SexsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        
        factory(Client::class, 1000)->create();
    }
}
