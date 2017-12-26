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
//        DB::table('users')->insert([
//            'name' =>'ADMINISTRADOR',
//            'email' => 'admin@admin.com',
//            'password' => bcrypt('admin')
//        ]);
//
//        DB::table('users')->insert([
//        'name' =>'ADMIN',
//        'email' => 'admin',
//        'password' => bcrypt('pubadmin2017')
//         ]);
//
//        DB::table('users')->insert([
//            'name' =>'user',
//            'email' => 'user',
//            'password' => bcrypt('hookahpub')
//        ]);
//
//        DB::table('categories')->insert([
//            'name' =>'Bebidas',
//            'description' => 'Produtos como Cervejas, Whisky\'s, Vodkas'
//        ]);
//
//        DB::table('categories')->insert([
//            'name' =>'Rosh',
//            'description' => 'Sessão do narguile de consumo imediato'
//        ]);
//
//        DB::table('categories')->insert([
//            'name' =>'Fumos',
//            'description' => 'Produtos como Zomo, Nay, Vgod, Adalya...'
//        ]);
//
//        DB::table('categories')->insert([
//            'name' =>'Diversos',
//            'description' => 'Produtos diversos vendidos avulsos, como Trident, Balas, Dichavadores, Sedas, etc...'
//        ]);
//
        DB::table('brands')->insert([
            'name' =>'Corona',
            'description' => 'A cerveja mexincana!',
            'logo_path' => 'https://hedstrom.com/wp-content/uploads/2016/09/Corona-Logo.jpg',
            'status' => 1,
            'category_id' => 1
        ]);

        DB::table('brands')->insert([
            'name' =>'Combos',
            'description' => 'Combos de bebidas',
            'logo_path' => 'http://nopontodistribuidora.com.br/wp-content/uploads/2016/05/COMBO-01.png',
            'status' => 1,
            'category_id' => 1
        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Stella Artois',
//            'description' => 'Be Legacy!',
//            'logo_path' => 'https://seeklogo.com/images/S/stella-artois-logo-04BFEE2241-seeklogo.com.png',
//            'status' => 1,
//            'category_id' => 1
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Antarctica Original',
//            'description' => 'É difícil achar, mas vale a pena!',
//            'logo_path' => 'http://viracoposlanchonete.com.br/images/LOGO-BEBIDAS/ORIGINAL.png',
//            'status' => 1,
//            'category_id' => 1
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Coca-Cola',
//            'description' => 'Abra a felicidade!',
//            'logo_path' => 'https://seeklogo.com/images/C/Coca-Cola-logo-00A6B20F2F-seeklogo.com.png',
//            'status' => 1,
//            'category_id' => 1
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Guaraná Antarctica',
//            'description' => 'O original do Brasil',
//            'logo_path' => 'https://pedidodaweb.com.br/upload/1501087688-GUARANA.png',
//            'status' => 1,
//            'category_id' => 1
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Zomo',
//            'logo_path' => 'https://www.pegasustabacaria.com.br/wp-content/uploads/2017/11/logozomo.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Nay',
//            'logo_path' => 'http://centraldonarguile.com/wp-content/uploads/2017/10/nay.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'VGod',
//            'logo_path' => 'https://xlvape.com/media/wysiwyg/vgod-eliterda/elite-rda-logo-white.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Adalya',
//            'logo_path' => 'http://reidatabacaria.vteximg.com.br/arquivos/ids/155792-558-554/adalya1.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Haze',
//            'logo_path' => 'http://images.tcdn.com.br/img/img_prod/86670/haze_tobacco_250g_148_1_20170307173116.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Fumari',
//            'logo_path' => 'https://i2.wp.com/hookahdihufa.com/wp-content/uploads/2015/03/fumari_logo_grey.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Tangiers',
//            'logo_path' => 'http://images.tcdn.com.br/img/img_prod/86670/tangiers_tobacco_250g_86_1_20160928173330.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Pure Tobacco',
//            'logo_path' => 'http://www.emporionb.com.br/uploads/thumb-pure-morangie--250g_1477278708960480910.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Atcha',
//            'logo_path' => 'https://scontent.fgig1-2.fna.fbcdn.net/v/t1.0-9/13006759_1005994996159212_6112715578030064016_n.jpg?oh=1bb58a06a43fc092767a0c53640c9e92&oe=5AD194FF',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Mazaya',
//            'logo_path' => 'https://misternarguile.com.br/wp-content/uploads/2016/11/Mazaya-1.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Dichavadores',
//            'logo_path' => 'http://rolliepipe.com.br/wp-content/uploads/2017/09/Graphic1-550x550-300x300.png',
//            'status' => 1,
//            'category_id' => 4
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Doces & Aperitivos',
//            'logo_path' => 'http://newflashmotel.com.br/public/imagens/cardapio/diversos.png',
//            'status' => 1,
//            'category_id' => 4
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Rosh Simples',
//            'description' => 'rosh feito com fumos simples',
//            'logo_path' => 'http://ap.imagensbrasil.org/images/2017/12/15/logosimples.png',
//            'status' => 1,
//            'category_id' => 2
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Rosh Premium',
//            'description' => 'rosh feito com fumos premium',
//            'logo_path' => 'http://www.makebrandz.com/wp-content/uploads/2015/01/Premium-Quality-02_300x162.png',
//            'status' => 1,
//            'category_id' => 2
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Mazaya 2',
//            'logo_path' => 'https://misternarguile.com.br/wp-content/uploads/2016/11/Mazaya-1.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('brands')->insert([
//            'name' =>'Mazaya 3',
//            'logo_path' => 'https://misternarguile.com.br/wp-content/uploads/2016/11/Mazaya-1.png',
//            'status' => 1,
//            'category_id' => 3
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Heineken Long Neck',
//            'description' => 'contém 355ml',
//            'price_cost' => 3.3,
//            'price_resale' => 4,
//            'price_discount' => 3.75,
//            'qtd' => '200',
//            'brand_id' => 2
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Heineken 600ml',
//            'description' => 'Garrafa de 600',
//            'price_cost' => 6.0,
//            'price_resale' => 8,
//            'price_discount' => 7.60,
//            'qtd' => '100',
//            'brand_id' => 2
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Coca Lata',
//            'description' => 'contém 355ml',
//            'price_cost' => 1.80,
//            'price_resale' => 3,
//            'price_discount' => 3,
//            'qtd' => '150',
//            'brand_id' => 5
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Guaraná Lata',
//            'description' => 'contém 355ml',
//            'price_cost' => 1.80,
//            'price_resale' => 3,
//            'price_discount' => 3,
//            'qtd' => '150',
//            'brand_id' => 6
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Guaraná 600ml',
//            'description' => 'Garrafa 600ml',
//            'price_cost' => 2.80,
//            'price_resale' => 5,
//            'price_discount' => 5,
//            'qtd' => '50',
//            'brand_id' => 6
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Zomo 50g',
//            'description' => '',
//            'price_cost' => 5.5,
//            'price_resale' => 10,
//            'price_discount' => 10,
//            'qtd' => '50',
//            'brand_id' => 7
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Nay 50g',
//            'description' => '',
//            'price_cost' => 7.5,
//            'price_resale' => 12,
//            'price_discount' => 12,
//            'qtd' => '50',
//            'brand_id' => 8
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'VGod 50g',
//            'description' => '',
//            'price_cost' => 6.5,
//            'price_resale' => 12,
//            'price_discount' => 12,
//            'qtd' => '50',
//            'brand_id' => 9
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Adalya 50g',
//            'description' => '',
//            'price_cost' => 9.5,
//            'price_resale' => 15,
//            'price_discount' => 15,
//            'qtd' => '50',
//            'brand_id' => 10
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Adalya Love 66 150g',
//            'description' => '',
//            'price_cost' => 40,
//            'price_resale' => 70,
//            'price_discount' => 70,
//            'qtd' => '10',
//            'brand_id' => 10
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Haze 50g',
//            'description' => '',
//            'price_cost' => 17,
//            'price_resale' => 25,
//            'price_discount' => 25,
//            'qtd' => '50',
//            'brand_id' => 11
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Haze 100g',
//            'description' => '',
//            'price_cost' => 38,
//            'price_resale' => 55,
//            'price_discount' => 55,
//            'qtd' => '10',
//            'brand_id' => 11
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Fumari 100g',
//            'description' => '',
//            'price_cost' => 38,
//            'price_resale' => 55,
//            'price_discount' => 55,
//            'qtd' => '25',
//            'brand_id' => 12
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Tangiers 250g',
//            'description' => '',
//            'price_cost' => 100,
//            'price_resale' => 150,
//            'price_discount' => 150,
//            'qtd' => '15',
//            'brand_id' => 13
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Pure Tobacco 100g',
//            'description' => '',
//            'price_cost' => 45,
//            'price_resale' => 75,
//            'price_discount' => 75,
//            'qtd' => '50',
//            'brand_id' => 14
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Pure Tobacco 250g',
//            'description' => '',
//            'price_cost' => 80,
//            'price_resale' => 120,
//            'price_discount' => 120,
//            'qtd' => '10',
//            'brand_id' => 14
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Atcha 50g',
//            'description' => '',
//            'price_cost' => 5.5,
//            'price_resale' => 10,
//            'price_discount' => 10,
//            'qtd' => '50',
//            'brand_id' => 15
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Mazaya 50g',
//            'description' => '',
//            'price_cost' => 5.5,
//            'price_resale' => 10,
//            'price_discount' => 10,
//            'qtd' => '50',
//            'brand_id' => 16
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Rosh Simples',
//            'description' => '',
//            'price_cost' => 10,
//            'price_resale' => 15,
//            'price_discount' => 15,
//            'qtd' => '1000',
//            'brand_id' => 19
//        ]);
//
//        DB::table('products')->insert([
//            'name' =>'Rosh Premium',
//            'description' => '',
//            'price_cost' => 15,
//            'price_resale' => 25,
//            'price_discount' => 25,
//            'qtd' => '1000',
//            'brand_id' => 20
//        ]);
//
//        DB::table('clients')->insert([
//            'name' =>'Venda Avulsa',
//            'nickname' => 'Venda Avulsa',
//            'phone1' => '067999999990'
//        ]);
//
//        DB::table('clients')->insert([
//            'name' =>'Victor Oliveira',
//            'nickname' => 'Chico',
//            'phone1' => '067991321331',
//            'email' => 'victorfrco3@hotmail.com',
//            'cpf' => '44168257819',
//            'obs' => 'Cliente VIP',
//            'adr_street' => 'Rua Veridiana',
//            'adr_number' => '20',
//            'adr_neighborhood' => 'Estrela do Sul',
//            'adr_cep' => '79013360',
//            'adr_compl' => 'Quadra 4 Lote 3'
//        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
