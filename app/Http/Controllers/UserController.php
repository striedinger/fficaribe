<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Gate;

class UserController extends Controller
{
    public function view(Request $request, $id){
    	$user = User::findOrFail($id);
    	if(Gate::allows('view-user', $user)){
    		return view('users.view', ['user' => $user]);
    	}else{
    		abort(403);
    	}
    }

    public function update(Request $request, $id){
    	$user = User::findOrFail($id);
    	if(Gate::allows('update-user', $user)){
    		if($request->isMethod('post')){
                $validator = $this->validate($request, [
                    'name' => 'required|max:255',
                    'phone' => 'required|max:255',
                ]);
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->save();
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'El usuario ha sido actualizado');
            }
    		return view('users.update', ['user' => $user]);
    	}else{
    		abort(403);
    	}
    }
}
