<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description', 'state', 'project_id', 'indicator', 'source', 'goal'];

    public function project(){
    	return $this->belongsTo(Project::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }

    protected static function boot(){
    	parent::boot();

    	static::deleting(function($result){
    		$result->products()->delete();
    	});
    }
}
