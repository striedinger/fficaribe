@extends('layouts.app')

@section('title')
Preinscripción para vigencia '{{ $term->name }}'
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Inicio</a></li>
        <li><a href="{{ url('/preinscription') }}">Preinscripción</a></li>
        <li class="active">{{ $term->name }}</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            Preinscripción para vigencia <strong>{{ $term->name }}</strong>
        </div>
        <div class="panel-body">
            @if(Auth::user()->isEmpresario())
                @if(Auth::user()->company)
                    <p>Para realizar la preinscripción es necesario que imprima el siguiente formato, lo firme, escanee y adjunte abajo. <a href="">Formato de Preinscripción</a></p>
                    <strong><small>Nota: Los archivos deberan ser adjuntos en formato PDF y con un tamaño maximo de 5MB cada uno.</small></strong>
                    <br><br>
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <label>Documento #1</label>
                            <p>Formato de preinscripción firmado.</p>
                            @if(!isset($preinscription->document1))
                                {!! Form::open(array('url'=> 'preinscription/term/' . $term->id . '/upload','method'=>'POST', 'files'=>true)) !!}
                                <div class="form-group">
                                    <input type="file" name="document" accept="application/pdf">
                                    <input type="hidden" name="document_id" value="1">
                                    @if($errors->has('document'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('document') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Cargar Documento</button>
                                </div>
                                {!! Form::close() !!}
                            @else 
                                <p><i class="fa fa-check"></i> Cargado</p>
                            @endif
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <label>Documento #2</label>
                            <p>Certificado de Existencia y Representación legal o el documento equivalente en original, expedido por autoridad competente, con fecha de expedición no menor  a tres meses al momento de remitir el documento.</p>
                            @if(!isset($preinscription->document2))
                                {!! Form::open(array('url'=> 'preinscription/term/' . $term->id . '/upload','method'=>'POST', 'files'=>true)) !!}
                                <div class="form-group">
                                    <input type="file" name="document" accept="application/pdf">
                                    <input type="hidden" name="document_id" value="2">
                                    @if ($errors->has('document'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('document') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Cargar Documento</button>
                                </div>
                                {!! Form::close() !!}
                            @else 
                                <p><i class="fa fa-check"></i> Cargado</p>
                            @endif
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <label>Documento #3</label>
                            <p>Certificado suscrito por Contador Público o Revisor Fiscal en el que certifique los valores por ingresos operacionales en 2015 y a junio de 2016. (Anexo 5)</p>
                            @if(!isset($preinscription->document3))
                                {!! Form::open(array('url'=> 'preinscription/term/' . $term->id . '/upload','method'=>'POST', 'files'=>true)) !!}
                                <div class="form-group">
                                    <input type="file" name="document" accept="application/pdf">
                                    <input type="hidden" name="document_id" value="3">
                                    @if ($errors->has('document'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('document') }}</strong>
                                        </span>
                                    @endif 
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Cargar Documento</button>
                                </div>
                                {!! Form::close() !!}
                            @else 
                                <p><i class="fa fa-check"></i> Cargado</p>
                            @endif
                        </div>
                    </div>
                @else 
                    <div class="alert alert-warning">
                        <i class="fa fa-ban"></i> Para realizar la preinscripción es necesario primero registrar su empresa. @if(Auth::user()->isEmpresario())<a href="{{ url('/companies/create') }}">Registrar Empresa</a>@endif
                    </div>
                @endif
            @else
                @if(count($preinscriptions)>0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Empresa</th>
                                <th>Documento 1</th>
                                <th>Documento 2</th>
                                <th>Documento 3</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @foreach($preinscriptions as $preinscription)   
                                    <tr>
                                        <td>{{ $preinscription->id }}</td>
                                        <td>{{ $preinscription->user->company->name }}</td>
                                        <td>{!! (isset($preinscription->document1))? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                                        <td>{!! (isset($preinscription->document2))? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                                        <td>{!! (isset($preinscription->document3))? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                                        <td><a href="" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else 
                    <div class="alert alert-warning">
                        <p>Aun no hay preinscripciones para la vigencia seleccionada.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
