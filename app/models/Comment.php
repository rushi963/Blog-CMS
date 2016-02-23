<?php

//ORM / Object Relational Mapping - Models to DB tables, using Eloquent
class Comment extends Eloquent {

	public function post()
	{
		return $this->belongsTo('Post');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	protected $fillable = array('content', 'user_id','post_id');

	 use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	

}