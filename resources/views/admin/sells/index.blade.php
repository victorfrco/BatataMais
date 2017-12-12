@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>PÁGINA TESTE</h2>
        </div>
        <div class="row" >
            @php
            $image =
$divBrand = "<div class=\"col-sm-2\" style=\"height: 120px; max-width: 120px; font-size: 12px; font-weight:bold; text-align: center; border: 2px solid grey; border-radius: 8px;\">{!! $brand->name.Image::rounded(\'https://seeklogo.com/images/C/Coca-Cola-logo-00A6B20F2F-seeklogo.com.png\', \'rounded\')->responsive()->withAttributes([\'style\' => \'max-height:90px; \']);!!}</div>";

            Image::rounded('https://seeklogo.com/images/C/Coca-Cola-logo-00A6B20F2F-seeklogo.com.png', 'rounded')->responsive();
            @endphp
            <div style="max-height: 100px; max-width: 100px; background-color: black;">
                <a href="{!! route('admin.products.index') !!}"><img style="max-height: 100px; max-width: 100px;" src="https://seeklogo.com/images/C/Coca-Cola-logo-00A6B20F2F-seeklogo.com.png"></a>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
@endsection