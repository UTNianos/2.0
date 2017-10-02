<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = new \Utnianos\Core\Usuario();
        $testUser->email = 'test@example.com';
        $testUser->usuario = 'test';
        $testUser->password = 'password';
        $testUser->save();

        $this->call(CarrerasSeeder::class);
    }
}
