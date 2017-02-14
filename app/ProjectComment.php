<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectComment extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = ['comment', 'project_id'];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function project(){
		return $this->belongsTo(Project::class);
	}
}
