@extends('layouts.app')

@section('title')
Registrar Entidad
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/companies') }}">Empresas</a></li>
		<li><a href="{{ url('/companies/view') . '/' . Auth::user()->company->id }}">Empresa</a></li>
		<li class="active">Registrar Entidad</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			Registrar Entidad
		</div>
		<div class="panel-body">
			<form method="POST">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" name="name" class="form-control" placeholder="Nombre de entidad" value="{{ old('name') }}">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>NIT</label>
					<input type="text" name="nit" class="form-control" placeholder="Numero de Identificacíon Tributaria" value="{{ old('nit') }}">
					@if ($errors->has('nit'))
					<span class="help-block">
						<strong>{{ $errors->first('nit') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Nombre de Contacto</label>
					<input type="text" name="contact_name" class="form-control" placeholder="Nombre de Contacto"  value="{{ old('contact_name') }}">
					@if ($errors->has('contact_name'))
					<span class="help-block">
						<strong>{{ $errors->first('contact_name') }}</strong>
					</span>
					@endif
				</div>
				<div class="row">
					<div class="form-group col col-xs-12 col-sm-6">
						<label>Telefono de Contacto</label>
						<input type="text" name="contact_phone" class="form-control" placeholder="Telefono de Contacto"  value="{{ old('contact_phone') }}">
						@if ($errors->has('contact_phone'))
						<span class="help-block">
							<strong>{{ $errors->first('contact_phone') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group col col-xs-12 col-sm-6">
						<label>E-mail de Contacto</label>
						<input type="text" name="contact_email" class="form-control" placeholder="E-mail de Contacto"  value="{{ old('contact_email') }}">
						@if ($errors->has('contact_email'))
						<span class="help-block">
							<strong>{{ $errors->first('contact_email') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Registrar Entidad</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection