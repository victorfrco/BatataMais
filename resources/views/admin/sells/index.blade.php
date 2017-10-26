@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>PÁGINA TESTE</h2>
        </div>
        <div class="row" >
            @php
            $image =

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