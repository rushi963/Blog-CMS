@extends('template')

@section('content')

			<div id="content" class="container">
				<section class="8u">
					<header>
						<h2>Login</h2>
					</header>

					{{ Form::open(array('url' => 'login')) }}


							{{Form::label('email', 'Email')}}
							{{Form::text('email')}}

							{{Form::label('password', 'Password')}}
							{{Form::text('password')}}

							{{Form::submit('Reset')}}
							{{Form::submit('Login')}}
					
					{{ Form::close() }}
					{{Session::get("error")}}

				</section>
		</div>



@stop