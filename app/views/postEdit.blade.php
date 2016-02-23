@extends('template')

@section('content')

		<div id="content" class="container">
				<section class="8u">
					
					<header>
						<h2>Edit Post</h2>
					</header>


					<!-- build form using laravel / blade -->
					<!-- RESTful - Put/edit resource -->
					<!-- force PUT emulation via hidden field-->
					<!-- Use sticky data - populate form based on the contents of Post model-->

					{{ Form::model($post,array('url' => 'posts/'.$post->id, 'method' => 'put', 'files' => 'true')) }}

						{{Form::label('title', 'Title')}}
						{{Form::text('title')}}
						{{$errors->first('title', '<p class="error">:message</p>')}}

						{{Form::label('subtitle', 'Subtitle')}}
						{{Form::text('subtitle')}}
						{{$errors->first('subtitle', '<p class="error">:message</p>')}}

						{{Form::label('photo', 'Photo')}}
						{{Form::file('photo')}}
						{{$errors->first('photo', '<p class="error">:message</p>')}}

						{{Form::label('content', 'Content')}}
						{{Form::textarea('content')}}
						{{$errors->first('content', '<p class="error">:message</p>')}}

						{{Form::label('category_id', 'Category')}}

						<?php 
							$aCategories = Category::lists('name','id');

						?>
						{{Form::select('category_id', $aCategories)}}
						

						{{Form::submit('Reset')}}
						{{Form::submit('Edit Post')}}
			
					{{ Form::close() }}

			</div>

@stop