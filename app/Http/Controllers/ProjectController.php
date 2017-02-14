<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;

use App\Term;

use App\Company;

use App\Project;

use App\Entity;

use App\CostCategory;

class ProjectController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

	public function index(Request $request){
		if($request->user()->isEmpresario()){
			$projects = Project::where(['company_id' => $request->user()->company->id])->paginate(100);
		}else{
			$projects = Project::paginate(100);
		}
		return view('projects.index', ['projects' => $projects]);
	}

    public function create(Request $request){
    	if(Gate::allows('create-project')){
    		if($request->isMethod('post')){
    			$this->validate($request, [
    				'name' => 'required|max:255',
                	'description' => 'required',
                	'amount' => 'required|numeric',
                	'term' => 'required'
    			]);
    			Project::create([
                	'name' => $request->name,
                	'description' => $request->description,
                	'amount' => $request->amount,
                	'term_id' => $request->term,
                	'company_id' => $request->company_id,
                	'status' => 'Registrado',
                	'active' => true
            	]);
                $request->session()->flash('status', 'success');
    			$request->session()->flash('message', 'Su proyecto ha sido registrado');
    			return redirect('/projects');
    		}else{
    			$terms = Term::where(['active' => true])->pluck('name', 'id');
                $companies = Company::pluck('name', 'id');
    			return view('projects.create', ['terms' => $terms, 'companies' => $companies]);
    		}
    	}else{
    		abort(403);
    	}
    }

    public function update(Request $request, $id){
        if($project = Project::where(['id' => $id])->first()){
            if(Gate::allows('update-project', $project)){
            	if($request->isMethod('post')){
                	$validator = $this->validate($request, [
                    	'name' => 'required|max:255',
                    	'description' => 'required',
                    	'amount' => 'required|numeric'
                	]);
                	$project->name = $request->name;
                	$project->description = $request->description;
                	$project->amount = $request->amount;
                	$project->save();
                    $request->session()->flash('status', 'success');
                	$request->session()->flash('message', 'Su proyecto ha sido actualizado');
                	return redirect('/projects/' . $project->id);
            	}
            	return view('projects.update', [
                	'project' => $project
            	]);
            }else{
            	abort(403);
            }
        }else{
            abort(404);
        }
    }

    public function view(Request $request, $id){
        if($project = Project::where(['id' => $id])->first()){
            if(Gate::allows('view-project', $project)){
                $results = $project->results;
                $costs = $project->costs;
                $entities = Entity::pluck('name', 'id');
                $costCategories = CostCategory::all();
                return view('projects.view', ['project' => $project, 'results' => $results, 'costs' => $costs, 'entities' => $entities, 'costCategories' => $costCategories]);
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }
}
