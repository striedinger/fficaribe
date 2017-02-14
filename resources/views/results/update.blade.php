@extends('layouts.app')

@section('title')
Resultado
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/') }}">Inicio</a></li>
		<li><a href="{{ url('/projects') }}">Proyectos</a></li>
		<li><a href="{{ url('/projects') . '/' . $result->project->id . '#results'}}">Proyecto</a></li>
		<li class="active">Resultado</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			Resultado
		</div>
		<div class="panel-body">
			<form method="POST">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ $result->name }}">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Descripcion</label>
					<textarea class="form-control" name="description" placeholder="Descripcion">{{ $result->description }}</textarea>
					@if ($errors->has('description'))
					<span class="help-block">
						<strong>{{ $errors->first('description') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Indicador</label>
					<input type="text" class="form-control" name="indicator" placeholder="Indicador" value="{{ $result->indicator }}">
					@if ($errors->has('indicator'))
					<span class="help-block">
						<strong>{{ $errors->first('indicator') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Fuente Verificable</label>
					<input type="text" class="form-control" name="source" placeholder="Fuente Verificable" value="{{ $result->source }}">
					@if ($errors->has('source'))
					<span class="help-block">
						<strong>{{ $errors->first('source') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Meta</label>
					<input type="text" class="form-control" name="goal" placeholder="Meta" value="{{ $result->goal }}">
					@if ($errors->has('goal'))
					<span class="help-block">
						<strong>{{ $errors->first('goal') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Estado</label>
					<select class="form-control" name="state">
						<option value="Planeación" @if($result->state == 'Planeación') echo selected @endif>Planeación</option>
						<option value="Ejecución"  @if($result->state == 'Ejecución') echo selected @endif>Ejecución</option>
						<option value="Completado" @if($result->state == 'Completado') echo selected @endif>Completado</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Actualizar</button>
				</div>
			</form>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Productos
		</div>
		<div class="panel-body">
			@if(count($result->products)==0)
			<div class="alert alert-warning">
				<p class="text-center">No existen productos para este resultado</p>
			</div>
			@endif
			@if(count($result->products)>0)
			@foreach($result->products as $product)
			<p>
				@can('destroy-product', $product)
				{!! Form::open(['action' => array('ProductController@destroy', $product->id), 'method' => 'post'])!!}
				{{ method_field('DELETE') }}
				<button type="submit" class="pull-right close" onclick="return confirm('¿Esta seguro de querer borrar el producto?');">&times;</button>
				{!! Form::close() !!}
				@endcan
				<a href="{{ url('/products') . '/' . $product->id . '/update' }}">{{ $product->name }}</a>
			</p>
			@endforeach
			@endif
		</div>
	</div>
</div>
@endsection