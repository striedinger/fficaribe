<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = ['user_id', 'state_id', 'name', 'nit', 'municipality', 'company_type', 'employee_number', 'assets_range', 'economic_activity', 'legal_representative', 'phone', 'address', 'website'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function state(){
    	return $this->belongsTo(State::class);
    }

    public function projects(){
    	return $this->hasMany(Project::class);
    }

    public function entities(){
        return $this->hasMany(Entity::class);
    }
}
