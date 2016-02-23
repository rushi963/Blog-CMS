<?php

class Post extends Eloquent {

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}

}	
