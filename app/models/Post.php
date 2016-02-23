<?php

//ORM / Object Relational Mapping - Models to DB tables, using Eloquent
class Post extends Eloquent {

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}


	protected $fillable = array('title', 'subtitle','photo','content','category_id','user_id');



}	
