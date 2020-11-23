<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use HasFactory, Notifiable;

	protected $fillable = [
		'id',
		'name',
		'surname',
		'slug',
        'email',
		'password',
		'created_at',
		'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
	];

    protected $casts = [
        'email_verified_at' => 'datetime',
	];

	public $incrementing = false;
	public $keyType = 'string';


	public function movements()
	{
		return $this->hasMany( Movement::class , 'user_id' , 'id');
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class , 'users_categories' , 'user_id' , 'category_id');
	}

}
