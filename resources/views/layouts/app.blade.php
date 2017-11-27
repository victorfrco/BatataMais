<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Batata') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @php
        $navbar = Navbar::withBrand(config('app.name').'&ensp;'.Icon::plus(), route('home'))->inverse();
         if(Auth::check()){
             $arrayLinks = [

                 [
                  'Produtos',
                  [
                      [
                          'link' => route('admin.categories.index'),
                          'title' => 'Categorias'
                      ],
                      [
                          'link' => route('admin.brands.index'),
                          'title' => 'Marcas'
                      ],
                      [
                          'link' => route('admin.products.index'),
                          'title' => 'Produtos'
                      ],
                      Navigation::NAVIGATION_DIVIDER,
                      [
                          'link' => '#',
                          'title' => 'Relatórios'
                      ],
                  ]

              ],
              ['link' => route('admin.clients.index'), 'title' => 'Clientes'],
              ['link' => route('admin.providers.index'), 'title' => 'Fornecedores']
             ];
             $arrayLinksRight = [
             [
                Icon::user().' '.Auth::user()->name,
                [
                    [
                            'link' => route('logout'),
                            'title' => 'Logout &ensp;'.Icon::create('log-out'),
                            'linkAttributes' => [
                                'onclick' => "event.preventDefault();getElementById(\"form-logout\").submit();"
                            ]
                        ]
                    ]
                ]
             ];
             $navbar->withContent(Navigation::links($arrayLinks))
                    ->withContent(Navigation::links($arrayLinksRight)->right());

             $formLogout = FormBuilder::plain([
                'id' => 'form-logout',
                'url' => route('logout'),
                'method' => 'POST',
                'style' => 'display:none'
            ]);
         }
    @endphp
    {!! $navbar !!}
    @auth
        {!! form($formLogout) !!}
    @endauth

    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
