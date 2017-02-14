<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Company;

use App\Entity;

use Gate;

class EntityController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

    public function create(Request $request){
        if(Gate::allows('create-entity')){
            if($request->isMethod('post')){
                $this->validate($request, [
                    'name' => 'required',
                    'nit' => 'required',
                    'contact_name' => 'required',
                    'contact_phone' => 'required',
                    'contact_email' => 'required|email'
                ]);
                $request->user()->company->entities()->create([
                    'name' => $request->name,
                    'nit' => $request->nit,
                    'contact_name' => $request->contact_name,
                    'contact_phone' => $request->contact_phone,
                    'contact_email' => $request->contact_email
                ]);
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'Su entidad ha sido registrada');
                return redirect('/users/' . $request->user()->id);
            }else{
                return view('entities.create', []);
            }
        }else{
            abort(403, "Usuario no autorizado");
        }
    }

    public function update(Request $request, $id){
        if($entity = $this->entity->forId($id)){
            $this->authorize('update', $entity);
            if($request->isMethod('post')){
                $validator = $this->validate($request, [
                    'name' => 'required',
                    'nit' => 'required',
                    'contact_name' => 'required',
                    'contact_phone' => 'required',
                    'contact_email' => 'required|email'
                ]);
                $entity->name = $request->name;
                $entity->nit = $request->nit;
                $entity->contact_name = $request->contact_name;
                $entity->contact_phone = $request->contact_phone;
                $entity->contact_email = $request->contact_email;
                $entity->save();
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'Su entidad ha sido actualizada');
                return redirect('/companies/view/' . $entity->company_id);
            }
            return view('entities.update', [
                'entity' => $entity
            ]);
        }else{
            abort(404);
        }
    }

    public function destroy(Request $request, $id){
        if($entity = $this->entity->forId($id)){
            $this->authorize('destroy', $entity);
            $entity->delete();
            $request->session()->flash('status', 'success');
            $request->session()->flash('status', 'Su entidad ha sido eliminada');
            return redirect('/companies/view/' . $entity->company_id);
        }else{
            abort(404);
        }
    }
}
