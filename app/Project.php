<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

	protected $dates = ['deleted_at'];

	protected $fillable = ['company_id', 'term_id', 'name', 'description', 'amount', 'status', 'active'];
    
    public function company(){
		return $this->belongsTo(Company::class);
	}

	public function term(){
		return $this->belongsTo(Term::class);
	}

	public function results(){
		return $this->hasMany(Result::class);
	}

	public function costs(){
		return $this->hasMany(Cost::class);
	}

	public function comments(){
		return $this->hasMany(ProjectComment::class);
	}
}
