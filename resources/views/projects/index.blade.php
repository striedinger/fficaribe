@extends('layouts.app')

@section('title')
    Proyectos
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active">Proyectos</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            Proyectos @can('create-project')<a href="{{ url('projects/register') }}" class="pull-right"><i class="fa fa-plus"></i></a>@endcan
        </div>
        <div class="panel-body">
            @if (count($projects)==0)  
                <div class="alert alert-warning">
                    <p>No hay proyectos registrados.</p>
                </div>
            @endif
            @if (count($projects) > 0)
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Nombre</th>
                        <th>Administrador</th>
                        <th>Empresa</th>
                        <th>Convocatoria</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr class="{{ $project->active ? 'success' : 'danger' }}">
                            <td class="table-text">{{ $project->name}}</td>
                            <td class="table-text"><a href="{{ url('/users/view') . '/' . $project->user_id }}">{{ $project->company->user->name}}</a></td>
                            <td class="table-text"><a href="{{ url('/companies/view') . '/' . $project->company_id }}">{{ $project->company->name}}</a></td>
                            <td class="table-text">{{ $project->term->name}}</td>
                            <td><a href="{{ url('/projects') . '/' . $project->id }}" class="btn btn-xs btn-primary"><i class="fa fa-search"></i></a> <a href="{{ url('/projects') . '/' . $project->id . '/update' }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
    <div align="center">
        {{ $projects->render() }}
    </div>
</div>
@endsection