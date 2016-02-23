<?php

//ORM / Object Relational Mapping - Models to DB tables, using Eloquent
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public function posts()
	{
		return $this->hasMany('Post');
	}

	protected $fillable = array('password', 'firstname','lastname','email');


}
