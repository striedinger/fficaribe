@extends('layouts.app')

@section('title')
    Proyecto
@endsection

@section('content')
<div class="container">
	<ol class="breadcrumb">
		<li><a href="{{ url('/') }}">Inicio</a></li>
		<li><a href="{{ url('/projects') }}">Proyectos</a></li>
		<li class="active">Ver Proyecto</li>
	</ol>
	<div class="panel with-nav-tabs panel-default">
		<div class="panel-heading">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#project" aria-controls="project" role="tab" data-toggle="tab">Proyecto</a></li>
				<li role="presentation"><a href="#results" aria-controls="results" role="tab" data-toggle="tab">Resultados</a></li>
				<li role="presentation"><a href="#products" aria-controls="products" role="tab" data-toggle="tab">Productos</a></li>
				<li role="presentation"><a href="#costs" aria-controls="costs" role="tab" data-toggle="tab">Presupuesto</a></li>
				{{--<li role="presentation"><a href="#attachments" aria-controls="attachments" role="tab" data-toggle="tab">Adjuntos</a></li>--}}
				<li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comentarios</a></li>
			</ul>
		</div>
		<div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="project">
					@can('update-project', $project)
					<a href=" {{ url('/projects') . '/' . $project->id . '/update' }}" class="pull-right">Editar</a>
					@endcan
					<div class="form-group">
						<label>Nombre</label>
						<p>{{$project->name}}</p>
					</div>
					<div class="form-group">
						<label>Descripcion</label>
						<p>{{$project->description}}</p>
					</div>
					<div class="form-group">
						<label>Valor del Proyecto</label>
						<p>${{ number_format($project->amount) }} COP</p>
					</div>
					<div class="form-group">
						<label>Empresa</label>
						<p>{{$project->company->name}}</p>
					</div>
					<div class="form-group">
						<label>Convocatoria</label>
						<p>{{$project->term->name}}</p>
					</div>
					<label>Resumen General</label>
					@if(count($results)>0)
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<tr>
									<th>Resultado</th>
									<th>Indicador</th>
									<th>Fuente Verificable</th>
									<th>Meta</th>
									<th>Actividad</th>
									<th>Presupuesto <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Si el valor esperado concuerda con la suma de los rubros para el producto aparecera de color verde, de lo contrario aparecera de color rojo"></i></th>
									<th>Fecha Inicial</th>
									<th>Fecha Fin</th>
									<th>Marca Empresario</th>
									<th>Marca Asesor</th>
								</tr>
							</thead>
							@foreach($results as $result)
								@if(count($result->products)>0)
									@foreach($result->products as $product)
										<tr>
											@if($loop->first)
												<th rowspan="{{ count($result->products) }}">{{ $result->name }}</th>
												<td rowspan="{{ count($result->products) }}">{{ $result->indicator }}</td>
												<td rowspan="{{ count($result->products) }}">{{ $result->source }}</td>
												<td rowspan="{{ count($result->products) }}">{{ $result->goal }}</td>
											@endif	
											<td>{{ $product->name }}</td>
											<td class="{{ ($product->amount == $product->totalCosts())? 'success' : 'danger' }}">${{ number_format($product->amount) }} COP</td>
											<td>{{ $product->start_date }}</td>
											<td>{{ $product->end_date }}</td>
											<td align="center">{!! ($product->company_check)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
											<td align="center">{!! ($product->admin_check)? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
										</tr>	
									@endforeach	
								@endif
							@endforeach
						</table>
					</div>
					@else 
					<p>El resumen general solo esta disponible cuando comience a agregar resultados y productos</p>
					@endif
				</div>
				<div class="tab-pane fade in" id="results">
					@can('create-result', $project)
					{!! Form::open(['action' => array('ResultController@create', $project->id), 'method' => 'post']) !!}
					<div class="form-group">
						<label>Nombre de Resultado</label>
		 				<input type="text" class="form-control" name="name" placeholder="Nombre de resultado">
		 				@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
						<label>Productos <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ingrese los productos del resultado, separándolos presionando la tecla ENTER"></i></label>
						<select multiple data-role="tagsinput" name="products[]"></select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Agregar Resultado</button>
					</div>
					{!! Form::close() !!}
					@endcan		
					@if(count($results)==0)
					<div class="alert alert-warning">
						<p class="text-center">No existen resultados para este proyecto</p>
					</div>
					@endif
					@if(count($results)>0)
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<th>Resultado</th>
								<th>Estado</th>
								@can('destroy-result', $results[0])
								<th>Acciones</th>
								@endif
							</thead>
							<tbody>
								@foreach($results as $result)
								<tr>
									<td>{{ $result->name }}</td>
									<td>{{ $result->state }}</td>
									@can('destroy-result', $result) 
									{!! Form::open(['action' => array('ResultController@destroy', $result->id), 'method' => 'post'])!!}
									{{ method_field('DELETE') }}
									<td>
										<a href="{{ url('/results') . '/' . $result->id . '/update' }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
										&nbsp;
										<button class="btn btn-danger btn-xs" onclick="return confirm('¿Esta seguro de querer borrar el resultado?');">
  											<i class="fa fa-trash-o" title="Borrar" aria-hidden="true"></i>
  											<span class="sr-only">Borrar</span>
										</button>
									</td>
									{!! Form::close() !!}
									@endcan
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif
				</div>
				<div class="tab-pane fade in" id="products">
					@can('create-product', $project)
					{!! Form::open(['action' => array('ProductController@create'), 'method' => 'post']) !!}
					<div class="form-group">
						<label>Nombre de Producto</label>
		 				<input type="text" class="form-control" name="name" placeholder="Nombre de producto">
		 				@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
						<label>Resultado</label>
						<select class="form-control" name="result_id">
							@foreach($project->results as $result)
							<option value="{{ $result->id }}">{{ $result->name }}</option>
							@endforeach
						</select>
						@if ($errors->has('result_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('result_id') }}</strong>
                        </span>
                        @endif
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Agregar Producto</button>
					</div>
					{!! Form::close() !!}
					@endcan
					@if(count($results)==0)
					<div class="alert alert-warning">
						<p class="text-center">No existen productos para este proyecto</p>
					</div>
					@endif
					@if(count($results)>0)
					@foreach($results as $result)
					<div class="panel panel-default">
						<div class="panel-heading">
							{{ $result->name }}
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
					@endforeach
					@endif
				</div>
				<div class="tab-pane fade in" id="costs">
					@can('create-cost', $project)
					{!! Form::open(['action' => array('CostController@create', $project->id), 'method' => 'post']) !!}
					<div class="form-group">
						<label>Entidad</label>
						{{ Form::select('entity_id', $entities, null, ['class' => 'form-control']) }}		
						@if ($errors->has('entity_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('entity_id') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
						<label>Producto</label>
						<select class="form-control" name="product_id">
							@foreach($project->results as $result)
								<optgroup label="{{ $result->name }}">
									@foreach($result->products as $product1)
										<option value="{{ $product1->id }}"> {{ $product1->name }}</option>
									@endforeach
								</optgroup>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Rubro</label>
						<div style="height:150px;overflow:auto;padding:10px" class="well">
							@foreach($costCategories as $costCategory)
							<div class="radio">
								<label>
									<input type="radio" value="{{ $costCategory->id }}" name="cost_category_id">
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
									<input type="text" class="form-control" name="company_cash" placeholder="Efectivo Empresa" value="{{ old('company_cash') }}">
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
								<label>Especie Empresa</label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="text" class="form-control" name="company_pik" placeholder="Especie Empresa" value="{{ old('company_pik') }}">
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
									<input type="text" class="form-control" name="financer_cash" placeholder="Efectivo SENA" value="{{ old('company_cash') }}">
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
								<label>Especie SENA <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Ingrese solo si SENA actua como co-ejecutor, de lo contrario el valor debe ser 0"></i></label>
								<div class="input-group">
									<span class="input-group-addon">$</span>
									<input type="text" class="form-control" name="financer_pik" placeholder="Especie SENA" value="{{ old('company_pik') }}">
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
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Agregar Gasto</button>
					</div>
					{!! Form::close() !!}
					@endcan
					@if(count($costs)==0)
					<div class="alert alert-warning">
						<p class="text-center">No hay gastos asociados al proyecto</p>
					</div>
					@endif
					@if(count($costs)>0)
					<div class="table-responsive">
                		<table class="table table-hover table-bordered">
                			<thead>
                				<tr>
  									<th rowspan="2" style="vertical-align:middle;text-align:center">Rubro</th>
  									<th rowspan="2" style="vertical-align:middle;text-align:center">Entidad</th>
  									<th rowspan="2" style="vertical-align:middle;text-align:center">Producto</th>
  									<th colspan="2" style="text-align:center">SENA</th>
  									<th colspan="2" style="text-align:center">Entidad</th>
  									<th rowspan="2" style="vertical-align:middle;text-align:center">Total</th>
  									@can('destroy-cost', $costs[0]) 
  									<th rowspan="2" style="vertical-align:middle;text-align:center">Acciones</th>
  									@endcan
								</tr>
								<tr>
  									<th>Efectivo</th>
  									<th>Especies</th>
  									<th>Efectivo</th>
  									<th>Especies</th>
								</tr>
                			</thead>
                			<tbody>
                				@foreach($costs as $cost)
                				<tr>
                					<td><p data-toggle="tooltip" data-placement="top" title="{{ $cost->costCategory->name }}">{{ substr($cost->costCategory->name, 0, 30) . '...' }}</p></td>
                					<td><a href="{{ url('/entities/update') . '/' . $cost->entity->id }}">{{ $cost->entity->name }}</a></td>
                					<td><a href="{{ url('/products') . '/' . $cost->product->id . '/update'}}">{{ $cost->product->name }}</a></td>
                					<td>${{ number_format($cost->financer_cash) }}</td>
                					<td>${{ number_format($cost->financer_pik) }}</td>
                					<td>${{ number_format($cost->company_cash) }}</td>
                					<td>${{ number_format($cost->company_pik) }}</td>
                					<td>${{ number_format($cost->financer_cash+$cost->financer_pik+$cost->company_cash+$cost->company_pik) }}</td>
                					@can('destroy-cost', $cost) 
									{!! Form::open(['action' => array('CostController@destroy', $cost->id), 'method' => 'post'])!!}
									{{ method_field('DELETE') }}
									<td>
										<a href="{{ url('/costs') . '/' . $cost->id . '/update'}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
										&nbsp;
										<button class="btn btn-danger btn-xs" onclick="return confirm('¿Esta seguro de querer borrar el gasto?');">
  											<i class="fa fa-trash-o" title="Borrar" aria-hidden="true"></i>
  											<span class="sr-only">Borrar</span>
										</button>
									</td>
									{!! Form::close() !!}
									@endcan
                				</tr>
                				@endforeach
                			</tbody>
                		</table>
                	</div>
                	@endif
				</div>
				<div class="tab-pane fade in" id="attachments">
					
				</div>
				<div class="tab-pane fade in" id="comments">
					@can('create-project-comment', $project)
					{!! Form::open(['action' => array('ProjectCommentController@create', $project->id), 'method' => 'post']) !!}
					<div class="form-group">
						<div class="input-group">
							<textarea class="form-control" placeholder="Nuevo comentario" name="comment" required>{{ old('comment') }}</textarea>
							<span class="input-group-addon"><button type="submit" class="btn btn-primary">Enviar</button></span>
						</div>
						@if ($errors->has('comment'))
						<span class="help-block"> 
							<strong>{{ $errors->first('comment') }}</strong>
						</span>
						@endif
					</div>
					{!! Form::close() !!}
					@endcan
					<div class="list-group">
						@if(count($project->comments)==0)
						<div class="alert alert-warning">
							<p class="text-center">No hay comentarios para el proyecto</p>
						</div>
						@endif
						@foreach ($project->comments as $comment)
						<div class="list-group-item">
							@can('destroy-project-comment', $comment)	
							{!! Form::open(['action' => array('ProjectCommentController@destroy', $comment->id), 'method' => 'post'])!!}
							{{ method_field('DELETE') }}
							<button type="submit" class="pull-right close" onclick="return confirm('¿Esta seguro de querer borrar el comentario?');">&times;</button>
							{!! Form::close() !!}
							@endcan
							<p>{{ $comment->comment }}</p>	
							<small>{{ date_format(date_create($comment->created_at), "h:i A d/m/y") }} por <a href="{{ url('users/view') . '/' . $comment->user->id }}">{{ $comment->user->name }}</a></small>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () {
		$('.nav-tabs a[href="' +  window.location.hash +'"]').tab('show');
	});
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});
	$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  		if(e.which == 13) {
    		e.preventDefault();
    		return false;
  		}
});
</script>
@endsection