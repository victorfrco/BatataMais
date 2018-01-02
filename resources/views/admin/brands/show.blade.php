@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row" align="left">
            <h2>Informações sobre: {{$brand->name}}</h2>
    <div align="center" style="margin-right: 80%">
        {!! Image::rounded(asset($brand->logo_path), 'rounded')
            ->responsive()
            ->withAttributes(['style' => 'height:200px;'])->withAlt('PENGUINS');
         !!}

        <h5>{{$brand->description}}</h5>
    </div>
            @php
                $linkEdit = route('admin.brands.edit', ['brand' => $brand->id]);
                $linkDelete = route('admin.brands.destroy', ['brand' => $brand->id]);
            @endphp
            {!! Button::primary('Editar  '.Icon::pencil())->asLinkTo($linkEdit) !!}
            {!! Button::danger('Excluir  '.Icon::remove())->asLinkTo($linkDelete)->addAttributes([
                'onClick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
            ]) !!}

            @php
                $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'url' => $linkDelete,
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]);
            @endphp
            {!! form($formDelete) !!}
        </div>
    </div>
@endsection