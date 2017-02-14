<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = ['product_id', 'name', 'description', 'responsible', 'start_date', 'end_date', 'activity_id', 'company_check', 'admin_check', 'amount'];

    public function result(){
    	return $this->belongsTo(Result::class);
    }

    public function costs(){
    	return $this->hasMany(Cost::class);
    }

    public function totalCosts(){
    	$total = 0;
    	foreach($this->costs as $cost){
    		$total = $total + ($cost->financer_cash + $cost->financer_pik + $cost->company_cash + $cost->company_pik);
    	}
    	return $total;
    }
}
