@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <h1>Configurações do Site</h1>
@endsection

@section('content')

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            <h5><i class="icons fas fa-ban"></i>Ocorreu um erro.</h5>

            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-info">
            {{session('warning')}}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('settings.save')}}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Titulo do Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub-titulo do Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="subtitle" value="" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail do Site</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="" class="form-control"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor de Fundo</label>
                    <div class="col-sm-10">
                        <input type="color" name="backgraundcolor" value="" class="form-control" style="width: 70px"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do Texto</label>
                    <div class="col-sm-10">
                        <input type="color" name="textcolot" value="" class="form-control" style="width: 70px"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success"/>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection