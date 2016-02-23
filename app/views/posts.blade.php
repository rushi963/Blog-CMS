@extends("template")
@section("content")
		<div id="content" class="container">
			
			@foreach($posts as $post)
					<section class="8u">
						<a href="{{URL::to('posts/' .$post->id)}}">{{HTML::image('postphotos/'.$post->photo)}}</a>
						<header>
							<a href="{{URL::to('posts/' .$post->id)}}"><h2>{{$post->title}}</h2>
						</header>
						<p>{{$post->content}}</p>
					</section>	
			@endforeach()

			{{$posts->links()}}
							
			</div>
@stop