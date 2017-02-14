<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Cost extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = ['entity_id', 'project_id', 'product_id','cost_category_id', 'financer_cash', 'financer_pik', 'company_cash', 'company_pik'];

	public function entity(){
		return $this->belongsTo(Entity::class);
	}

	public function project(){
		return $this->belongsTo(Project::class);
	}

	public function product(){
		return $this->belongsTo(Product::class);
	}

	public function costCategory(){
		return $this->belongsTo(CostCategory::class);
	}
}
