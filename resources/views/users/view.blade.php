@extends('layouts.app')

@section('title')
Usuario
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active">Ver Usuario</li>
    </ol>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Perfil de Usuario @can('update-user', $user)<a href="{{ url('/users') . '/' . $user->id . '/update' }}" class="pull-right">Editar</a>@endcan
                </div>
                <div class="panel-body">
                    <label>E-mail</label>
                    <p>{{ $user->email }}</p>
                    <label>Nombre</label>
                    <p>{{ $user->name }}</p>
                    <label>Telefono</label>
                    <p>{{ $user->phone }}</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Empresa @if($user->company) @can('update-company', $user->company)<a href="{{ url('/companies') . '/' . $user->company->id . '/update' }}" class="pull-right">Editar</a>@endcan @endif
                </div>
                <div class="panel-body">
                    @if($user->company)
                        <label>Nombre</label>
                        <p>{{ $user->company->name }}</p>
                        <label>NIT</label>
                        <p>{{ $user->company->nit }}</p>
                        <label>Municipio</label>
                        <p>{{ $user->company->municipality }}</p>
                        <label>Departamento</label>
                        <p>{{ $user->company->state->name }}</p>
                        <label>Dirección</label>
                        <p>{{ $user->company->address }}</p>
                        <label>Teléfono</label>
                        <p>{{ $user->company->phone }}</p>
                        <label>Tipo de Entidad y/o Empresa</label>
                        <p>{{ $user->company->company_type }}</p>
                        <label>No. de Empleados</label>
                        <p>{{ $user->company->employee_number }}</p>
                        <label>Rango de Activos Totales</label>
                        <p>{{ $user->company->assets_range }}</p>
                        <label>Actividad Economica</label>
                        <p>{{ $user->company->economic_activity }}</p>
                        <label>Nombre de Representante Legal</label>
                        <p>{{ $user->company->legal_representative }}</p>
                    @else 
                        <p>El usuario todavia no ha registrado su empresa. @if($user->isEmpresario())<a href="{{ url('/companies/create') }}">Registrar Empresa</a>@endif</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
