<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'id',
		'name',
		'description',
		'created_at',
		'updated_at',
	];

	protected $table = 'categories';

	public $incrementing = false;

	public $keyType = true;


	public function users()
	{
		return $this->belongsToMany(User::class , 'users_categories' , 'category_id' , 'user_id' );
	}
}
