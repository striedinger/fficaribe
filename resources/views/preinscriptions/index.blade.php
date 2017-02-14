@extends('layouts.app')

@section('title')
Preinscripción
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li class="active">Preinscripción</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            Preinscripción
        </div>
        <div class="panel-body">
            @if(Auth::user()->isEmpresario())
                @if(Auth::user()->company)
                    <p>A continuación podrá escoger entre las vigencias disponibles para realizar su preinscripción, si ya ha comenzado el proceso podrá continuarlo hasta la fecha indicada.</p>
                @else 
                    <div class="alert alert-warning">
                        <i class="fa fa-ban"></i> Para realizar la preinscripción es necesario primero registrar su empresa. @if(Auth::user()->isEmpresario())<a href="{{ url('/companies/create') }}">Registrar Empresa</a>@endif
                    </div>
                @endif
            @else
                <p>A continuación podrá escoger entre las vigencias disponibles para ver las preinscripciones realizadas hasta el momento.</p> 
            @endif
            @if((Auth::user()->isAdmin() || Auth::user()->isEmpresario() && Auth::user()->company))
                <ul>
            @if(count($terms)>0)
                    @foreach($terms as $term)
                        <li><a href="{{ url('/preinscription/term/') . '/' . $term->id }}">{{ $term->name }}</a></li>
                    @endforeach
                </ul>
            @else 
                <div class="alert alert-warning">
                    <p><strong>Lo sentimos,</strong> no hay vigencias disponibles para preinscripción.</p>
                </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection
