<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectComment;
use Gate;

class ProjectCommentController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

    public function create(Request $request, $id){
    	if($project = Project::find($id)){
    		if(Gate::allows('create-project-comment', $project)){
    			$this->validate($request, [
    				'comment' => 'required'
    			]);
    			$request->user()->projectComments()->create([
    				'project_id' => $project->id,
    				'comment' => $request->comment
    			]);
    			$request->session()->flash('status', 'Su comentario ha sido guardado');
    			return redirect('/projects/' . $project->id . '#comments');
    		}else{
    			abort(403, "Usuario no autorizado");
    		}
    	}else{
    		abort(404);
    	}
    }

    public function destroy(Request $request, $id){
        if($comment = ProjectComment::find($id)){
            if(Gate::allows('destroy-project-comment', $comment)){
                $comment->delete();
                $request->session()->flash('status', 'Su comentario ha sido eliminado');
                return redirect('/projects/' . $comment->project_id . '#comments');
            }else{
                abort(403, "Usuario no autorizado");
            }
        }else{
            abort(404);
        }
    }
}
