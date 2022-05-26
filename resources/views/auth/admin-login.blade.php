@extends('layouts.admin-login')

@section('title', 'Admin Login')

@section('content')
	
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="card card-primary login_card">
							<div class="card-header">
								<h4><b>Lottery</b> Login</h4>
								<p class="login_msg">Sign in to start your session</p>
							</div>
							<div class="card-body">
								 {{ Form::open(array('url' => 'admin/login', 'name'=>'admin_login')) }}
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" placeholder="Email" name="email" value="{{ (Cookie::get('email') !='' && !old('email')) ? Cookie::get('email') : old('email')  }}" autocomplete="off" data-valid="required email">
										@if ($errors->has('email'))
											<div class="invalid-feedback">
												<strong>{{ $errors->first('email') }}</strong>
											</div>
										@endif
									</div>
									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password</label>
											<div class="float-right">
												<a href="auth-forgot-password.html" class="text-small">
												Forgot Password?
												</a>
											</div>
										</div>
										<input type="password" class="form-control" placeholder="Password" name="password" id="password" value="{{ (Cookie::get('password') !='' && !old('password')) ? Cookie::get('password') : old('password')  }}" autocomplete="off" data-valid="required">
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input name="remember" class="custom-control-input" type="checkbox" id="remember" @if(Cookie::get('email') != '' && Cookie::get('password') != '') checked  @endif> 
											<label class="custom-control-label" for="remember">Remember Me</label> 
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Sign In</button>
									</div>
								{{ Form::close() }}               
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	
@endsection