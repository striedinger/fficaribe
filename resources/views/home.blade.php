@extends('layouts.app')

@section('title')
Inicio
@endsection

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="active">Inicio</li>
    </ol>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bienvenido
                </div>
                <div class="panel-body">
                    <p>Bienvenido a la plataforma de gestión de proyectos del Fondo de Fomento a la Innovación y Desarrollo Tecnológico en las Empresas (FFI Caribe).</p>
                    <p>En esta página encontrara siempre las últimas noticias, instrucciones y progreso personalizado de su estado en la convocatoria. Asegúrese de revisar frecuentemente.</p>
                    <hr>
                    <p><strong>Contacto</strong></p>
                    <p>Si tiene cualquier duda comuníquese con uno de nuestros asesores:</p>
                    <ul>
                        <li>Nicolás E. Gómez Jacome - <a href="mailto:njacome@uninorte.edu.co">njacome@uninorte.edu.co</a></li>
                        <li>Tatiana C. Alfaro Díaz - <a href="mailto:alfarot@uninorte.edu.co">alfarot@uninorte.edu.co</a></li>
                        <li>Valeria Chain Pugliese - <a href="mailto:vchain@uninorte.edu.co">vchain@uninorte.edu.co</a></li>
                        <li>Emyle Britton Acevedo - <a href="mailto:ebritton@uninorte.edu.co">ebritton@uninorte.edu.co</a></li>
                        <li>Ana Marcela Velaidez - <a href="mailto:avelaidez@uninorte.edu.co">avelaidez@uninorte.edu.co</a></li>
                    </ul>
                    <p>O nos puede contactar a través de nuestro correo general: <a href="mailto:fficaribe@uninorte.edu.co">fficaribe@uninorte.edu.co</a></p>
                    <hr>
                    <p><strong>Apoyan</strong></p>
                    <div class="row" align="center">
                        <div class="col-xs-4">
                            <img src="{{ URL::asset('/img/sena.png') }}" style="width:100%">
                        </div>
                        <div class="col-xs-4">
                            <img src="{{ URL::asset('/img/sennova.png') }}" style="width:100%">
                        </div>
                        <div class="col-xs-4">
                            <img src="{{ URL::asset('/img/uninorte-cesi.png') }}" style="width:100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Noticias
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
