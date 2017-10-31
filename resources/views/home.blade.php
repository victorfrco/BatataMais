@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>PÁGINA TESTE</h2>
            <div class="col-sm-2" style="height: 150px; max-width: 150px; font-size: 12px; font-weight:bold; text-align: center;
            border: 2px solid grey; border-radius: 8px;">
                {!! 'chico'.Image::rounded('https://seeklogo.com/images/C/Coca-Cola-logo-00A6B20F2F-seeklogo.com.png', 'rounded')
                    ->responsive()
                    ->withAttributes(['style' => 'max-height:120px; ']);
                !!}
            </div>
    </div>
        <div class="row">
            <div class="col-sm-8" style="background-color:lightblue; height: 400px;" id="tabsCategorias" data-url="<?= route('admin.categories.create') ?>">
                @php

                    foreach($categories as $category){
                        $brands = App\Models\Brand::all()->where('category_id', '=', $category->id);
                        $table = Table::withContents($brands)->hover();

                        $names[] = [
                                'title' => $category->name,
                                'content' => "<div class=\"row\" style=\"max-height: 355px; overflow:auto\">$table</div>"
                            ];
                     }
                      $names[] = [
                         'title' => Icon::create('plus'),
                         'content' => ''
                     ];

                @endphp
                {!! Tabbable::withContents($names) !!}
            </div>
            <div class="col-sm-4" style="background-color:firebrick; height: 400px">
                <div style="background-color:#99cb84;"> TESTE</div>
                <div style="background-color:#c9e2b3; margin-top: 97%">TOTAL</div>
            </div>
        </div>

    </div>

@endsection
@section('scripts')
    <script>
        $('#tabsCategorias > ul> li:last').click(function (e) {
            e.preventDefault();
            window.location = $('#tabsCategorias').attr('data-url');
        });
    </script>
@endsection