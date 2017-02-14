@extends('layouts.app')

@section('title')
Producto
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/') }}">Inicio</a></li>
		<li><a href="{{ url('/projects') }}">Proyectos</a></li>
		<li><a href="{{ url('/projects') . '/' . $product->result->project->id . '#products'}}">Proyecto</a></li>
		<li><a href="{{ url('/results') . '/' . $product->result->id . '/update'}}">Resultado</a></li>
		<li class="active">Producto</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			Producto
		</div>
		<div class="panel-body">
			<form method="POST">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" class="form-control" name="name" placeholder="Nombre" value="{{ $product->name }}">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Descripcion</label>
					<textarea class="form-control" name="description" placeholder="Descripcion">{{ $product->description }}</textarea>
					@if ($errors->has('description'))
					<span class="help-block">
						<strong>{{ $errors->first('description') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Valor del Producto</label>
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input type="text" class="form-control" name="amount" placeholder="Valor del Producto" value="{{ $product->amount }}">
						<span class="input-group-addon">COP</span>
					</div>
					@if ($errors->has('amount'))
					<span class="help-block">
						<strong>{{ $errors->first('amount') }}</strong>
					</span>
					@endif
				</div>
				<div class="row">
					<div class="col-xs-12 col-md-6 form-group">
						<label>Fecha de Inicio</label>
						<div class="input-group date">
							<input type="input" class="form-control datetimepicker" name="start_date" id="start_date" value="{{ $product->start_date }}">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
						@if ($errors->has('start_date'))
						<span class="help-block">
							<strong>{{ $errors->first('start_date') }}</strong>
						</span>
						@endif
					</div>
					<div class="col-xs-12 col-md-6 form-group">
						<label>Fecha de Fin</label>
						<div class="input-group date">
							<input type="input" class="form-control datetimepicker" name="end_date" id="end_date" value="{{ $product->end_date }}">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
						@if ($errors->has('end_date'))
						<span class="help-block">
							<strong>{{ $errors->first('end_date') }}</strong>
						</span>
						@endif
					</div>
				</div>
				<div class="form-group">
					<label>Responsable</label>
					<input type="text" class="form-control" name="responsible" placeholder="Responsable" value="{{ $product->responsible }}">
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group checkbox">
					<input type="hidden" name="company_check" value="0">
					<label><input type="checkbox" value="1" name="company_check" @if($product->company_check) checked @endif @if(!Auth::user()->isEmpresario()) disabled @endif> Completado</label>
				</div>
				<div class="form-group checkbox">
					<input type="hidden" name="admin_check" value="0">
					<label><input type="checkbox" value="1" name="admin_check" @if($product->admin_check) checked @endif @if(Auth::user()->isEmpresario()) disabled @endif> Completado (Administrador)</label>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(function () {
		$('.datetimepicker').datetimepicker({
			'format' : 'YYYY-MM-DD',
		});
	});
</script>
@endsection