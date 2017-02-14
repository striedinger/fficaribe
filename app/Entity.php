<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = ['name', 'nit', 'contact_name', 'contact_phone', 'contact_email', 'company_id'];

	public function company(){
		return $this->belongsTo(Company::class);
	}

	public function costs(){
		return $this->hasMany(Cost::class);
	}

	protected static function boot(){
    	parent::boot();

    	static::deleting(function($entity){
    		$entity->costs()->delete();
    	});
    }
}
