@extends('layouts.app')

@section('title')
Actualizar Usuario
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/users') . '/' . $user->id }}">Perfil de Usuario</a></li>
        <li class="active">Actualizar Usuario</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Actualizar Usuario
                </div>
                <div class="panel-body">
                    <form method="post">
                        {{ csrf_field() }}
                        <label>E-mail</label>
                        <p>{{ $user->email }}</p>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Nombre</label>  
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label>Teléfono</label>  
                            <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-refresh"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
