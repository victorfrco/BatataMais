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
        DB::table('users')->insert([
            'name' =>'ADMINISTRADOR',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
