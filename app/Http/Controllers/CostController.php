<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;

use App\Project;

use App\Cost;

use App\Entity;

use App\CostCategory;

class CostController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function create(Request $request, $id){
    	if($project = Project::where(['id' => $id])->first()){
    		if(Gate::allows('create-cost', $project)){
    			$this->validate($request, [
    				'entity_id' => 'required',
                    'cost_category_id' => 'required',
                    'financer_cash' => 'required|numeric',
                    'financer_pik' => 'required|numeric',
                    'company_cash' => 'required|numeric',
                    'company_pik' => 'required|numeric',
                    'product_id' => 'required'
    			]);
                if(count(Cost::where(['project_id' => $project->id, 'entity_id' => $request->entity_id, 'cost_category_id' => $request->cost_category_id, 'product_id' => $request->product_id])->get())>0){
                	$request->session()->flash('status', 'warning');
                    $request->session()->flash('message', 'El gasto ya había sido ingresado para la entidad, producto, y rubro indicados');
                }else{
                    $product = $project->costs()->create([
                        'entity_id' => $request->entity_id,
                        'cost_category_id' => $request->cost_category_id,
                        'financer_cash' => $request->financer_cash,
                        'financer_pik' => $request->financer_pik,
                        'company_cash' => $request->company_cash,
                        'company_pik' => $request->company_pik,
                        'product_id' => $request->product_id
                    ]);
                    $request->session()->flash('status', 'success');
                    $request->session()->flash('message', 'Su gasto ha sido guardado');
                }
    			return redirect('/projects/' . $project->id . '#costs');
    		}else{
    			abort(403, "Usuario no autorizado");
    		}
    	}else{
    		abort(404);
    	}
    }

    public function update(Request $request, $id){
        if($cost = Cost::where(['id' => $id])->first()){
            if(Gate::allows('update-cost', $cost)){
                if($request->isMethod('post')){
                    $validator = $this->validate($request, [
                        'entity_id' => 'required',
                        'cost_category_id' => 'required',
                        'financer_cash' => 'required|numeric',
                        'financer_pik' => 'required|numeric',
                        'company_cash' => 'required|numeric',
                        'company_pik' => 'required|numeric',
                        'product_id' => 'required'
                    ]);
                    $cost->entity_id = $request->entity_id;
                    $cost->cost_category_id = $request->cost_category_id;
                    $cost->financer_cash = $request->financer_cash;
                    $cost->financer_pik = $request->financer_pik;
                    $cost->company_cash = $request->company_cash;
                    $cost->company_pik = $request->company_pik;
                    $cost->product_id = $request->product_id;
                    $cost->save();
                    $request->session()->flash('status', 'Su gasto ha sido actualizado');
                    return redirect('/costs/' . $cost->id . '/update');
                }
                $entities = Entity::where(['company_id' => $cost->project->company->id])->pluck('name', 'id');
                $costCategories = CostCategory::all();
                return view('costs.update', [
                    'cost' => $cost,
                    'entities' => $entities,
                    'costCategories' => $costCategories
                ]);
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }

    public function destroy(Request $request, $id){
        if($cost = Cost::where(['id' => $id])->first()){
            if(Gate::allows('destroy-cost', $cost)){
            	$cost->delete();
            	$request->session()->flash('status', 'success');
            	$request->session()->flash('message', 'Su gasto ha sido eliminado');
            	return redirect('/projects/' . $cost->project_id . '#costs');
            }else{
            	abort(403);
            }
        }else{
            abort(404);
        }
    }
}
