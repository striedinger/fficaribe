@extends('layouts.app')

@section('title')
Registrar Proyecto
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/') }}">Inicio</a></li>
		<li><a href="{{ url('/projects') }}">Proyectos</a></li>
		<li class="active">Registrar Proyecto</li>
	</ol>
	<div>
		<div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Nuevo Proyecto
				</div>
				<div class="panel-body">
					<form method="POST">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<div class="form-group">
							<label>Empresa</label>
							{{ Form::select('company_id', $companies, null, ['class' => 'form-control']) }}
							@if ($errors->has('company_id'))
							<span class="help-block">
								<strong>{{ $errors->first('company_id') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" name="name" placeholder="Nombre del proyecto" value="{{ old('name') }}">
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label>Descripcion</label>
							<textarea class="form-control" name="description" placeholder="Descripcion corta">{{ old('description') }}</textarea>
							@if ($errors->has('description'))
							<span class="help-block">
								<strong>{{ $errors->first('description') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label>Valor del Proyecto</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="amount" placeholder="Valor del Proyecto" value="{{ old('amount') }}">
								<span class="input-group-addon">COP</span>
							</div>
							@if ($errors->has('amount'))
							<span class="help-block">
								<strong>{{ $errors->first('amount') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<label>Convocatoria</label>
							{{ Form::select('term', $terms, null, ['class' => 'form-control']) }}
							@if ($errors->has('term'))
							<span class="help-block">
								<strong>{{ $errors->first('term') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Registrar Proyecto</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection