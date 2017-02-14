@extends('layouts.app')

@section('title')
Actualizar Empresa
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/users') . '/' . Auth::user()->id }}">Perfil de Usuario</a></li>
        <li class="active">Actualizar Empresa</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Actualizar Empresa
                </div>
                <div class="panel-body">
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Nombre</label>  
                            <input type="text" class="form-control" name="name" value="{{ $company->name }}" required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('nit') ? ' has-error' : '' }}">
                            <label>NIT</label>  
                            <input type="text" class="form-control" name="nit" value="{{ $company->nit }}" required>
                            @if ($errors->has('nit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nit') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('municipality') ? ' has-error' : '' }}">
                            <label>Municipio</label>  
                            <input type="text" class="form-control" name="municipality" value="{{ $company->municipality }}" required>
                            @if ($errors->has('municipality'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('municipality') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('state_id') ? ' has-error' : '' }}">
                            <label>Departamento</label>  
                            {{ Form::select('state_id', $states, $company->state_id, ['class' => 'form-control']) }}
                            @if ($errors->has('state_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state_id') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label>Dirección</label>  
                            <input type="text" class="form-control" name="address" value="{{ $company->address }}" required>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label>Teléfono</label>  
                            <input type="text" class="form-control" name="phone" value="{{ $company->phone }}" required>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('company_type') ? ' has-error' : '' }}">
                            <label>Tipo de Entidad y/o Empresa</label>  
                            {{ Form::select('company_type', $company_types, $company->company_type, ['class' => 'form-control']) }}
                            @if ($errors->has('company_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('company_type') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('employee_number') ? ' has-error' : '' }}">
                            <label>No. de Empleados</label>  
                            <input type="text" class="form-control" name="employee_number" value="{{ $company->employee_number }}" required>
                            @if ($errors->has('employee_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employee_number') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('assets_range') ? ' has-error' : '' }}">
                            <label>Rango de Activos Totales</label>  
                            {{ Form::select('assets_range', $assets_ranges, $company->assets_range, ['class' => 'form-control']) }}
                            @if ($errors->has('assets_range'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('assets_range') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('economic_activity') ? ' has-error' : '' }}">
                            <label>Actividad Economica</label>  
                            {{ Form::select('economic_activity', $economic_activities, $company->economic_activity, ['class' => 'form-control']) }}
                            @if ($errors->has('economic_activity'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('economic_activity') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="form-group {{ $errors->has('legal_representative') ? ' has-error' : '' }}">
                            <label>Representante Legal</label>  
                            <input type="text" class="form-control" name="legal_representative" value="{{ $company->legal_representative }}" required>
                            @if ($errors->has('legal_representative'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('legal_representative') }}</strong>
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
