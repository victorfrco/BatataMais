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
            'password' => bcrypt('admin')
        ]);

        DB::table('categories')->insert([
            'name' =>'Comidas',
            'description' => 'Produtos como Doritos, Ruffles, Pimentinha, Salamitos e Pé de moleque.'
        ]);

        DB::table('categories')->insert([
            'name' =>'Bebidas Alcoólicas',
            'description' => 'Produtos como Cervejas, Whisky\'s, Vodkas'
        ]);

        DB::table('categories')->insert([
            'name' =>'Bebidas Não-alcoólicas',
            'description' => 'Produtos como Refrigerantes, Energéticos e Água'
        ]);


        DB::table('categories')->insert([
            'name' =>'Diversos',
            'description' => 'Produtos diversos vendidos avulsos, como Trident, Balas, Fichas de Sinuca, etc...'
        ]);

        DB::table('brands')->insert([
            'name' =>'Brahma',
            'description' => 'A melhor cerveja!',
            'status' => 1,
            'category_id' => 2
        ]);

        DB::table('brands')->insert([
            'name' =>'Heineken',
            'description' => 'Open your world!',
            'status' => 1,
            'category_id' => 2
        ]);

        DB::table('brands')->insert([
            'name' =>'Coca-Cola',
            'description' => 'Abra a felicidade!',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Marca Inativa',
            'description' => 'Teste de exibição',
            'status' => 0,
            'category_id' => 4
        ]);

        DB::table('products')->insert([
            'name' =>'Heineken Long Neck',
            'description' => 'contém 355ml',
            'price_cost' => 3.3,
            'price_resale' => 4,
            'price_discount' => 3.75,
            'qtd' => '200',
            'brand_id' => 2
        ]);

        DB::table('products')->insert([
            'name' =>'Fanta Lata',
            'description' => 'contém 355ml',
            'price_cost' => 1.80,
            'price_resale' => 3,
            'price_discount' => 3,
            'qtd' => '150',
            'brand_id' => 3
        ]);

        DB::table('clients')->insert([
            'name' =>'Victor Oliveira',
            'nickname' => 'Chico',
            'phone1' => '067991321331',
            'email' => 'victorfrco3@hotmail.com',
            'cpf' => '44168257819',
            'obs' => 'Cliente VIP',
            'adr_street' => 'Rua Veridiana',
            'adr_number' => '20',
            'adr_neighborhood' => 'Estrela do Sul',
            'adr_cep' => '79013360',
            'adr_compl' => 'Quadra 4 Lote 3'
        ]);

        DB::table('clients')->insert([
            'name' =>'Robert Willian',
            'nickname' => 'Robert',
            'phone1' => '067999999999',
            'email' => 'robertwds.88@gmail.com',
            'cpf' => '12345678910',
            'obs' => 'Cliente VIP',
            'adr_street' => 'Rua Joaima',
            'adr_number' => '547',
            'adr_neighborhood' => 'Anhandui',
            'adr_cep' => '79025000',
            'adr_compl' => ''
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
