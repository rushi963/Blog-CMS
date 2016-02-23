<?php

//ORM / Object Relational Mapping - Models to DB tables, using Eloquent
class Category extends Eloquent {

	public function posts()
	{
		return $this->hasMany('Post');
	}

}
