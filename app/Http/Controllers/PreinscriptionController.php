<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Preinscription;

use App\Term;

class PreinscriptionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->user()->isEmpresario()){
            $terms = Term::where(['active' => true, 'stage' => 1])->get();
        }else{
            $terms = Term::all();
        }
    	return view('preinscriptions.index', ['terms' => $terms]);
    }

    public function term(Request $request, $term_id){
        if($term = Term::find($term_id)){
            if($request->user()->isEmpresario()){
                if($request->user()->company){
                    $preinscription = Preinscription::firstOrCreate(['user_id' => $request->user()->id, 'term_id' => $term_id]);
                    return view('preinscriptions.term', ['term' => $term, 'preinscription' => $preinscription]);
                }else{
                    return view('preinscriptions.term', ['term' => $term]);
                }
            }else{
                $preinscriptions = Preinscription::where(['term_id' => $term_id])->get();
                return view('preinscriptions.term', ['term' => $term, 'preinscriptions' => $preinscriptions]);
            }
        }else{
            abort(404);
        }
    }

    public function upload(Request $request, $term_id){
    	if($request->user()->isEmpresario() && $request->user()->company){
            if($term = Term::find($term_id)){
                if($request->hasFile('document') && $request->file('document')->isValid() && $request->document->extension() == 'pdf'){
                    $validator = $this->validate($request, [
                        'document' => 'max:5000'
                    ]);
                    $preinscription = Preinscription::where(['user_id' => $request->user()->id, 'term_id' => $term_id])->first();
                    $path = $request->document->store('files/preinscription');
                    if($request->document_id==1){
                        $preinscription->document1 = $path;
                    }elseif($request->document_id==2){
                        $preinscription->document2 = $path;
                    }else{
                        $preinscription->document3 = $path;
                    }
                    $preinscription->save();
                    $request->session()->flash('status', 'success');
                    $request->session()->flash('message', 'El documento se ha cargado exitosamente.');
                }else{
                    $request->session()->flash('status', 'danger');
                    $request->session()->flash('message', 'Ha ocurrido un error con el archivo, verifica que este bien e intenta de nuevo.');
                }
                return redirect('/preinscription/term/' . $term_id);
            }else{
                abort(404);
            }
    	}else{
    		abort(403);
    	}
    }
}
