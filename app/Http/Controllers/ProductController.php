<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

use App\Result;

use Gate;

class ProductController extends Controller
{
   	public function __construct(){
   		$this->middleware('auth');
   	}

   	public function create(Request $request){
        if($result = Result::where(['id' => $request->result_id])->first()){
            if($request->user()->id == $result->project->company->user_id){
                $this->validate($request, [
                    'name' => 'required'
                ]);
                $product = $result->products()->create([
                    'name' => $request->name,
                    'result_id' => $request->result_id,
                ]);
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'Su producto ha sido guardada');
                return redirect('/projects/' . $result->project->id . '#products');
            }else{
                abort(403, "Usuario no autorizado");
            }
        }else{
            abort(404);
        }
    }

    public function update(Request $request, $id){
        if($product = Product::where(['id' => $id])->first()){
            if(Gate::allows('update-product', $product)){
            	if($request->isMethod('post')){
                	$validator = $this->validate($request, [
                    	'name' => 'required|max:255',
                    	'start_date' => 'required|date|before:end_date',
                    	'end_date' => 'required|date|after:start_date',
                        'amount' => 'required|numeric',
                	]);
                	$product->name = $request->name;
                	$product->description = $request->description;
                	$product->start_date = $request->start_date;
                	$product->end_date = $request->end_date;
                    $product->amount = $request->amount;
                    if($request->user()->isEmpresario()){
                        $product->company_check = $request->company_check;
                    }else{
                        $product->admin_check = $request->admin_check;
                    }
                	$product->save();
                	$request->session()->flash('status', 'success');
                	$request->session()->flash('message', 'Su producto ha sido actualizado');
                	return redirect('/products/' . $product->id . '/update');
            	}
            	return view('products.update', [
                	'product' => $product
            	]);
            }else{
            	abort(403);
            }
        }else{
            abort(404);
        }
    }

    public function destroy(Request $request, $id){
        if($product = Product::where(['id' => $id])->first()){
        	if(Gate::allows('destroy-product', $product)){
        		$product->delete();
            	$request->session()->flash('status', 'success');
            	$request->session()->flash('message', 'Su producto ha sido eliminado');
            	return redirect('/projects/' . $product->result->project_id . '#products');
        	}else{
        		abort(403);
        	}
        }else{
            abort(404);
        }
    }
}
