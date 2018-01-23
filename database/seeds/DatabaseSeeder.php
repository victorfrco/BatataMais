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
		    'name' =>'Vendedor',
		    'email' => 'user',
		    'password' => bcrypt('hookahpub')
	    ]);

	    DB::table('users')->insert([
		    'name' =>'ADMIN',
		    'email' => 'admin',
		    'password' => bcrypt('pubadmin2017')
	    ]);

        DB::table('categories')->insert([
            'name' =>'Bebidas',
            'description' => 'Produtos como Cervejas, Whisky\'s, Vodkas'
        ]);

        DB::table('categories')->insert([
            'name' =>'Rosh',
            'description' => 'Sessão do narguile de consumo imediato'
        ]);

        DB::table('categories')->insert([
            'name' =>'Fumos',
            'description' => 'Produtos como Zomo, Nay, Vgod, Adalya...'
        ]);

        DB::table('categories')->insert([
            'name' =>'Diversos',
            'description' => 'Produtos diversos vendidos avulsos, como Trident, Balas, Dichavadores, Sedas, etc...'
        ]);
		
		DB::table('brands')->insert([
            'name' =>'Heineken',
            'description' => 'Open your World!',
            'logo_path' => 'storage/images/brands/Heineken.png',
            'status' => 1,
            'category_id' => 1
        ]);

        DB::table('brands')->insert([
            'name' =>'Stella Artois',
            'description' => 'Be Legacy!',
            'logo_path' => 'storage/images/brands/Stella Artois.png',
            'status' => 1,
            'category_id' => 1
        ]);

        DB::table('brands')->insert([
            'name' =>'Antarctica Original',
            'description' => 'É difícil achar, mas vale a pena!',
            'logo_path' => 'storage/images/brands/Antarctica Original.png',
            'status' => 1,
            'category_id' => 1
        ]);

        DB::table('brands')->insert([
            'name' =>'Coca-Cola',
            'description' => 'Abra a felicidade!',
            'logo_path' => 'storage/images/brands/Coca-Cola.png',
            'status' => 1,
            'category_id' => 1
        ]);

        DB::table('brands')->insert([
            'name' =>'Guarana Antarctica',
            'description' => 'O original do Brasil',
            'logo_path' => 'storage/images/brands/Guarana Antarctica.png',
            'status' => 1,
            'category_id' => 1
        ]);

        DB::table('brands')->insert([
            'name' =>'Zomo',
            'logo_path' => 'storage/images/brands/Zomo.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Nay',
            'logo_path' => 'storage/images/brands/Nay.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'VGod',
            'logo_path' => 'storage/images/brands/VGod.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Adalya',
            'logo_path' => 'storage/images/brands/Adalya.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Haze',
            'logo_path' => 'storage/images/brands/Haze.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Fumari',
            'logo_path' => 'storage/images/brands/Fumari.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Tangiers',
            'logo_path' => 'storage/images/brands/Tangiers.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Pure Tobacco',
            'logo_path' => 'storage/images/brands/Pure Tobacco.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Atcha',
            'logo_path' => 'storage/images/brands/Atcha.jpg',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Mazaya',
            'logo_path' => 'storage/images/brands/Mazaya.png',
            'status' => 1,
            'category_id' => 3
        ]);

        DB::table('brands')->insert([
            'name' =>'Dichavadores',
            'logo_path' => 'storage/images/brands/Dichavadores.png',
            'status' => 1,
            'category_id' => 4
        ]);

        DB::table('brands')->insert([
            'name' =>'Doces e Aperitivos',
            'logo_path' => 'storage/images/brands/Doces e Aperitivos.png',
            'status' => 1,
            'category_id' => 4
        ]);

        DB::table('brands')->insert([
            'name' =>'Rosh Simples',
            'description' => 'rosh feito com fumos simples',
            'logo_path' => 'storage/images/brands/Rosh Simples.png',
            'status' => 1,
            'category_id' => 2
        ]);

        DB::table('brands')->insert([
            'name' =>'Rosh Premium',
            'description' => 'rosh feito com fumos premium',
            'logo_path' => 'storage/images/brands/Rosh Premium.png',
            'status' => 1,
            'category_id' => 2
        ]);

	    DB::table('brands')->insert([
		    'name' =>'Corona',
		    'description' => 'A cerveja mexincana!',
		    'logo_path' => 'storage/images/brands/Corona.jpg',
		    'status' => 1,
		    'category_id' => 1
	    ]);

	    DB::table('brands')->insert([
		    'name' =>'Combos',
		    'description' => 'Combos de bebidas',
		    'logo_path' => 'storage/images/brands/Combos.png',
		    'status' => 1,
		    'category_id' => 1
	    ]);

        DB::table('products')->insert([
            'name' =>'Heineken Long Neck',
            'description' => 'contém 355ml',
            'price_cost' => 3.3,
            'price_resale' => 4,
            'price_discount' => 3.75,
            'qtd' => '200',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Heineken 600ml',
            'description' => 'Garrafa de 600',
            'price_cost' => 6.0,
            'price_resale' => 8,
            'price_discount' => 7.60,
            'qtd' => '100',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Coca Lata',
            'description' => 'contém 355ml',
            'price_cost' => 1.80,
            'price_resale' => 3,
            'price_discount' => 3,
            'qtd' => '150',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Guaraná Lata',
            'description' => 'contém 355ml',
            'price_cost' => 1.80,
            'price_resale' => 3,
            'price_discount' => 3,
            'qtd' => '150',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Guaraná 600ml',
            'description' => 'Garrafa 600ml',
            'price_cost' => 2.80,
            'price_resale' => 5,
            'price_discount' => 5,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Zomo 50g',
            'description' => '',
            'price_cost' => 5.5,
            'price_resale' => 10,
            'price_discount' => 10,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Nay 50g',
            'description' => '',
            'price_cost' => 7.5,
            'price_resale' => 12,
            'price_discount' => 12,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'VGod 50g',
            'description' => '',
            'price_cost' => 6.5,
            'price_resale' => 12,
            'price_discount' => 12,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Adalya 50g',
            'description' => '',
            'price_cost' => 9.5,
            'price_resale' => 15,
            'price_discount' => 15,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Adalya Love 66 150g',
            'description' => '',
            'price_cost' => 40,
            'price_resale' => 70,
            'price_discount' => 70,
            'qtd' => '10',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Haze 50g',
            'description' => '',
            'price_cost' => 17,
            'price_resale' => 25,
            'price_discount' => 25,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Haze 100g',
            'description' => '',
            'price_cost' => 38,
            'price_resale' => 55,
            'price_discount' => 55,
            'qtd' => '10',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Fumari 100g',
            'description' => '',
            'price_cost' => 38,
            'price_resale' => 55,
            'price_discount' => 55,
            'qtd' => '25',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Tangiers 250g',
            'description' => '',
            'price_cost' => 100,
            'price_resale' => 150,
            'price_discount' => 150,
            'qtd' => '15',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Pure Tobacco 100g',
            'description' => '',
            'price_cost' => 45,
            'price_resale' => 75,
            'price_discount' => 75,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Pure Tobacco 250g',
            'description' => '',
            'price_cost' => 80,
            'price_resale' => 120,
            'price_discount' => 120,
            'qtd' => '10',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Atcha 50g',
            'description' => '',
            'price_cost' => 5.5,
            'price_resale' => 10,
            'price_discount' => 10,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Mazaya 50g',
            'description' => '',
            'price_cost' => 5.5,
            'price_resale' => 10,
            'price_discount' => 10,
            'qtd' => '50',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Rosh Simples',
            'description' => '',
            'price_cost' => 10,
            'price_resale' => 15,
            'price_discount' => 15,
            'qtd' => '1000',
            'brand_id' => 1
        ]);

        DB::table('products')->insert([
            'name' =>'Rosh Premium',
            'description' => '',
            'price_cost' => 15,
            'price_resale' => 25,
            'price_discount' => 25,
            'qtd' => '1000',
            'brand_id' => 1
        ]);

        DB::table('clients')->insert([
            'name' =>'Venda Avulsa',
            'nickname' => 'Venda Avulsa',
            'phone1' => '000000000000'
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
        // $this->call(UsersTableSeeder::class);
    }
}
