<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preinscription extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = ['user_id', 'term_id', 'document1', 'document2', 'document3', 'status', 'message'];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function term(){
		return $this->belongsTo(Term::class);
	}
}
