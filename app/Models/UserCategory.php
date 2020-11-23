<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'id',
		'user_id',
		'category_id',
		'created_at',
		'updated_at',
	];

	protected $table = 'user_categories';

	public $incrementing = false;

	public $keyType = 'string';


}
