@extends('layout')

@section('title')
Create {{ getEnv('APP_NAME') }} Account
@endsection

@section('header-right')
<a href="/Login" class="nav-btn btn btn-primary">Sign in</a>
@endsection

@section('content')
<div class="register container">
  <div class="row">
    <div class="col-md-5 col-sm-6 col-md-offset-1">
      <div class="social">
        <div class="hidden-xs">
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160512_mobilesdk/auth_service_google.svg" alt="Google" /> Sign in with Google</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_facebook.svg" alt="Facebook" /> Sign in with Facebook</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_twitter.svg" alt="Twitter" /> Sign in with Twitter</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_github.svg" alt="Github" /> Sign in with Github</a>
        </div>
        <div class="visible-xs-block">
        <div class="btn-group" role="group" aria-label="social">
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160512_mobilesdk/auth_service_google.svg" alt="Google" /> Sign in</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_facebook.svg" alt="Facebook" /> Sign in</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_twitter.svg" alt="Twitter" /> Sign in</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_github.svg" alt="Github" /> Sign in</a>
        </div>
      </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-5 col-sm-6 col-lg-offset-1">
      <div class="panel">
        <div class="panel-body">
          <form class="form">
            <div class="form-group text-left">
              <input type="text" class="form-control" id="name" name="name" placeholder="Full name">
            </div>
            <div class="form-group text-left">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
            </div>
            <div class="form-group text-left">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <div class="form-group text-left">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group text-left">
              <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm password">
            </div>
            <div class="form-group">
              <script src='https://www.google.com/recaptcha/api.js'></script>
              <div class="g-recaptcha" data-sitekey="6LeimiQTAAAAAJ1n_sPnYZW05VAgXiwVbvBUx2oe"></div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-block">Create account</button>
            </div>
            <div>
              <span class="text-muted">By clicking Create account, you agree to our Terms and that you have read our Data Policy, including our Cookie Use.</span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
