<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'name', 'active'
    ];

    public function preinscriptions(){
    	return $this->hasMany(Preinscription::class);
    }
}
