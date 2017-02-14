@extends('layouts.app')

@section('title')
Gasto
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/') }}">Inicio</a></li>
		<li><a href="{{ url('/projects') }}">Proyectos</a></li>
		<li><a href="{{ url('/projects') . '/' . $cost->project->id . '#costs'}}">Proyecto</a></li>
		<li class="active">Gasto</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			Gasto
		</div>
		<div class="panel-body">
			<form method="POST">
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
					<label>Entidad</label>
					{{ Form::select('entity_id', $entities, $cost->entity_id, ['class' => 'form-control']) }}		
					@if ($errors->has('entity_id'))
					<span class="help-block">
						<strong>{{ $errors->first('entity_id') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<label>Rubro</label>
					<div style="height:150px;overflow:auto;padding:10px" class="well">
						@foreach($costCategories as $costCategory)
						<div class="radio">
							<label>
								<input type="radio" value="{{ $costCategory->id }}" name="cost_category_id" @if($cost->costCategory->id == $costCategory->id) echo checked @endif>
								{{ $costCategory->name }}
							</label>
						</div>
						@endforeach
					</div>
					@if ($errors->has('cost_category_id'))
					<span class="help-block">
						<strong>{{ $errors->first('cost_category_id') }}</strong>
					</span>
					@endif
				</div>
				<div class="row">
					<div class="col col-xs-12 col-sm-6">
						<div class="form-group">
							<label>Efectivo Empresa</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="company_cash" placeholder="Efectivo Empresa" value="{{ $cost->company_cash }}">
								<span class="input-group-addon">COP</span>
							</div>
							@if ($errors->has('company_cash'))
							<span class="help-block">
								<strong>{{ $errors->first('company_cash') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col col-xs-12 col-sm-6">
						<div class="form-group">
							<label>Especies Empresa</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="company_pik" placeholder="Especies Empresa" value="{{ $cost->company_pik }}">
								<span class="input-group-addon">COP</span>
							</div>
							@if ($errors->has('company_pik'))
							<span class="help-block">
								<strong>{{ $errors->first('company_pik') }}</strong>
							</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col col-xs-12 col-sm-6">
						<div class="form-group">
							<label>Efectivo SENA</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="financer_cash" placeholder="Efectivo SENA" value="{{ $cost->financer_cash }}">
								<span class="input-group-addon">COP</span>
							</div>
							@if ($errors->has('financer_cash'))
							<span class="help-block">
								<strong>{{ $errors->first('financer_cash') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col col-xs-12 col-sm-6">
						<div class="form-group">
							<label>Especies SENA</label>
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="financer_pik" placeholder="Especies SENA" value="{{ $cost->financer_pik }}">
								<span class="input-group-addon">COP</span>
							</div>
							@if ($errors->has('financer_pik'))
							<span class="help-block">
								<strong>{{ $errors->first('financer_pik') }}</strong>
							</span>
							@endif
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Actualizar Gasto</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection