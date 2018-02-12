@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>PÁGINA TESTE</h2>
        </div>
        {{Form::open(['route' => 'move', 'files' => true])}}

        {{Form::label('user_photo', 'User Photo',['class' => 'control-label'])}}
        {{Form::file('user_photo')}}
        {{Form::submit('Save', ['class' => 'btn btn-success'])}}

        {{Form::close()}}
        <div class="row" >
            <div style="max-height: 100px; max-width: 100px; background-color: black;">
                <a href="{!! route('admin.products.index') !!}"><img style="max-height: 100px; max-width: 100px;" src="{{asset('storage/images/brands/teste.jpg')}}"></a>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
@endsection