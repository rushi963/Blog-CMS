@extends('template')

@section('content')

		<div id="content" class="container">
			<section class="8u">
				<header>
					<h2>Create an Account</h2>
				</header>

				{{ Form::open(array('url' => 'users')) }}


						{{Form::label('firstname', 'First Name')}}
						{{Form::text('firstname')}}
						{{$errors->first('firstname', '<p class="error">:message</p>')}}

						{{Form::label('lastname', 'Last Name')}}
						{{Form::text('lastname')}}
						{{$errors->first('lastname', '<p class="error">:message</p>')}}

						{{Form::label('email', 'Email')}}
						{{Form::text('email')}}
						{{$errors->first('email', '<p class="error">:message</p>')}}

						{{Form::label('password', 'Password')}}
						{{Form::text('password')}}
						{{$errors->first('password', '<p class="error">:message</p>')}}

						{{Form::label('password_confirmation', 'Confirm Password')}}
						{{Form::text('password_confirmation')}}
						{{$errors->first('password_confirmation', '<p class="error">:message</p>')}}

						{{Form::submit('Reset')}}
						{{Form::submit('Register')}}
				
				{{ Form::close() }}


			</section>
		</div>
@stop