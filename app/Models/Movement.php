<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

	protected $fillable = [
		'id',
		'user_category_id',
		'user_id',
        'quantity',
		'isIncome',
		'created_at',
		'updated_at',
	];

	protected $table = 'movements';

	public $incrementing = false;

	public $keyType = 'string';

	public $attributes = [
		'isIncome' => false,
	];

	public function user()
	{
		return $this->belongsTo( User::class , 'user_id' , 'id');
	}

}
