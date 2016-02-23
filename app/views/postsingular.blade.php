@extends("template")
@section("content")
	<div class="container">
				<div class="row">

					<!-- Content -->
					<div id="content" class="8u skel-cell-important">
						<section>
							<header>
								<h2>{{$post->title}}</h2>
									@if((Auth::user()->id == $post->user_id))
									<!-- display the delete button -->
									<!-- simulated DELETE method -->
										{{Form::open(array("url"=>"posts/".$post->id, "method" =>"delete"))}}
											<input type="submit" value="Delete Post" />
										{{Form::close()}}
									@endif
								<span class="byline">{{$post->subtitle}}</span>
							</header>
							{{HTML::image('postphotos/'.$post->photo)}}
							<p>{{$post->content}}</p>
							
						</section>
					</div>

					<!-- Sidebar -->
					<div id="sidebar" class="4u">
	
						<section>
							<header>
								<h2>Comments</h2>
							</header>
							<ul class="style">
							@foreach($post->comments as $comment)
								<li>
									
									<p class="posted">{{$comment->created_at}}</p>
									<p><a href="#">{{$comment->content}}</a></p>
								<!-- if any user is logged in -->	
								@if(Auth::check())
								
									<!-- if the current user id is equal to the user id of the comment, OR if the current user is equal to the blog post's author--> 
									@if((Auth::user()->id == $comment->user->id)||(Auth::user()->author == 1))
									<!-- display the delete button -->
									<!-- simulated DELETE method -->
										{{Form::open(array("url"=>"comments/".$comment->id, "method" =>"delete"))}}
											<input type="submit" value="Delete" />
										{{Form::close()}}
									@endif
								@endif

								</li>
							@endforeach
								<li class="share-your-thought">
									<p class="posted">Share your thought</p>
									{{Form::open(array("url"=>"comments"))}}
										{{Form::textarea("content")}}
										{{Form::hidden("post_id",$post->id)}}
										<input type="submit" value="Share" />
									{{Form::close()}}
								</li>
							</ul>
						</section>
					</div>
					
				</div>
			</div>
@stop