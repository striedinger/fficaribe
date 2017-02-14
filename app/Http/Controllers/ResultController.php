<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Result;

use App\Project;

use Gate;

class ResultController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function create(Request $request, $id){
        if($project =  Project::where(['id' => $id])->first()){
            if(Gate::allows('create-result', $project)){
                $this->validate($request, [
                    'name' => 'required'
                ]);
                $result = $project->results()->create([
                    'name' => $request->name,
                ]);
                if(isset($request->products)){
                    foreach($request->products as $product){
                        $result->products()->create([
                            'name' => $product
                        ]);
                    }
                }
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'Su resultado ha sido guardado');
                return redirect('/projects/' . $project->id . '#results');
            }else{
                abort(403, "Usuario no autorizado");
            }
        }else{
            abort(404);
        }
    }

    public function update(Request $request, $id){
        if($result =  Result::where(['id' => $id])->first()){
            if(Gate::allows('update-result', $result)){
                if($request->isMethod('post')){
                    $validator = $this->validate($request, [
                        'name' => 'required|max:255',
                        'state' => 'required'
                    ]);
                    $result->name = $request->name;
                    $result->description = $request->description;
                    $result->indicator = $request->indicator;
                    $result->source = $request->source;
                    $result->goal = $request->goal;
                    $result->state = $request->state;
                    $result->save();
                    $request->session()->flash('status', 'success');
                    $request->session()->flash('message', 'Su resultado ha sido actualizado');
                    return redirect('/results/' . $result->id . '/update');
                }
            return view('results.update', [
                'result' => $result
            ]);
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }

    public function destroy(Request $request, $id){
        if($result = Result::where(['id' => $id])->first()){
            if(Gate::allows('destroy-result', $result)){
                $result->delete();
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'Su resultado ha sido eliminado');
            return redirect('/projects/' . $result->project_id . '#result');
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }
}
