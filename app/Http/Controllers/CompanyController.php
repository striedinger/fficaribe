<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\State;

use App\Company;

use Gate;

class CompanyController extends Controller
{

	public function __construct(){
		$this->company_types = ['Publica' => 'Publica', 'Privada' => 'Privada'];
		$this->assets_ranges = [
			'Inferiores a 500 SMMLV - Microempresa' => 'Inferiores a 500 SMMLV - Microempresa',
			'Entre 501 y 5.000 SMMLV - Pequeña' => 'Entre 501 y 5.000 SMMLV - Pequeña',
			'Entre 5001 y 30.000 SMMLV - Mediana' => 'Entre 5001 y 30.000 SMMLV - Mediana',
			'Entre 30.001 SMMLV o más - Grande' => 'Entre 30.001 SMMLV o más - Grande'
		];
		$this->economic_activities = [
			'Agricultura, ganadería, caza, silvicultura pesca' => 'Agricultura, ganadería, caza, silvicultura pesca',
			'Explotación de minas y canteras' => 'Explotación de minas y canteras',
			'Industrias manufactureras' => 'Industrias manufactureras',
			'Suministro de electricidad, gas y agua' => 'Suministro de electricidad, gas y agua',
			'Distribución de agua; evacuación y tratamiento de aguas residuales, gestión de desechos y actividades de saneamiento ambiental' => 'Distribución de agua; evacuación y tratamiento de aguas residuales, gestión de desechos y actividades de saneamiento ambiental',
			'Construcción' => 'Construcción',
			'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas' => 'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas',
			'Transporte y almacenamiento' => 'Transporte y almacenamiento',
			'Alojamiento y servicios de comida' => 'Alojamiento y servicios de comida',
			'Información y comunicaciones' => 'Información y comunicaciones',
			'Actividades financieras y de seguros' => 'Actividades financieras y de seguros',
			'Actividades inmobiliarias' => 'Actividades inmobiliarias',
			'Actividades profesionales, científicas y técnicas' => 'Actividades profesionales, científicas y técnicas',
			'Actividades de servicios administrativos y de apoyo' => 'Actividades de servicios administrativos y de apoyo',
			'Administración pública y defensa; planes de seguridad social de afiliación obligatoria' => 'Administración pública y defensa; planes de seguridad social de afiliación obligatoria',
			'Educación' => 'Educación',
			'Actividades de atención de la salud humana y de asistencia social' => 'Actividades de atención de la salud humana y de asistencia social',
			'Actividades artísticas, de entretenimiento y recreación' => 'Actividades artísticas, de entretenimiento y recreación',
			'Otras actividades de servicios' => 'Otras actividades de servicios',
			'Actividades de los hogares en calidad de empleadores; actividades no diferenciadas de los hogares individuales como productores de bienes y servicios para uso propio' => 'Actividades de los hogares en calidad de empleadores; actividades no diferenciadas de los hogares individuales como productores de bienes y servicios para uso propio',
			'Actividades de organizaciones y entidades extraterritoriales' => 'Actividades de organizaciones y entidades extraterritoriales'
		];
	}

    public function create(Request $request){
    	$states = State::pluck('name', 'id');
    	if(Gate::allows('create-company')){
    		if($request->isMethod('post')){
    			$this->validate($request, [
    				'name' => 'required|max:255',
                	'nit' => 'required|max:255',
                	'municipality' => 'required|max:255',
                	'company_type' => 'required',
                	'employee_number' => 'required|numeric',
                	'assets_range' => 'required',
                	'economic_activity' => 'required',
                	'legal_representative' => 'required|max:255',
                	'phone' => 'required',
                	'address' => 'required',
                	'state_id' => 'required'
    			]);
    			$request->user()->company()->create($request->all());
    			$request->session()->flash('status', 'success');
                $request->session()->flash('message', 'La empresa ha sido registrada');
                return redirect('/users/' . $request->user()->id);
    		}else{
    			return view('companies.create', ['states' => $states, 'company_types' => $this->company_types, 'assets_ranges' => $this->assets_ranges, 'economic_activities' => $this->economic_activities]);
    		}
    	}else{
    		abort(403);
    	}
    }

    public function update(Request $request, $id){
    	$company = Company::findOrFail($id);
    	$states = State::pluck('name', 'id');
    	if(Gate::allows('update-company', $company)){
    		if($request->isMethod('post')){
                $this->validate($request, [
    				'name' => 'required|max:255',
                	'nit' => 'required|max:255',
                	'municipality' => 'required|max:255',
                	'company_type' => 'required',
                	'employee_number' => 'required|numeric',
                	'assets_range' => 'required',
                	'economic_activity' => 'required',
                	'legal_representative' => 'required|max:255',
                	'phone' => 'required',
                	'address' => 'required',
                	'state_id' => 'required'
    			]);
                $company->name = $request->name;
               	$company->nit = $request->nit;
               	$company->municipality = $request->municipality;
               	$company->company_type = $request->company_type;
               	$company->employee_number = $request->employee_number;
               	$company->assets_range = $request->assets_range;
               	$company->economic_activity = $request->economic_activity;
               	$company->legal_representative = $request->legal_representative;
               	$company->phone = $request->phone;
               	$company->address = $request->address;
               	$company->state_id = $request->state_id;
                $company->save();
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'La empresa ha sido actualizada');
            }
    		return view('companies.update', ['company' => $company, 'states' => $states, 'company_types' => $this->company_types, 'assets_ranges' => $this->assets_ranges, 'economic_activities' => $this->economic_activities]);
    	}else{
    		abort(403);
    	}
    }
}
