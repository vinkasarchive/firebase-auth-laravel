@extends('layout')

@section('content')
<div class="login container">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-1">
      <div class="row">
        <div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
          <div class="panel">
            <div class="panel-body">
              <h1 class="h4">Sign in with your {{ getEnv('APP_NAME') }} account</h1>
              <hr />
              <form class="form">
                <div class="form-group text-left">
                  <input type="text" class="form-control" id="login" name="login" placeholder="Username or Email address">
                </div>
                <div class="form-group text-left">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group checkbox text-left">
                  <label>
                    <input type="checkbox"> Stay signed in
                  </label>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
                <div class="text-right">
                  <a class="text-danger">Need help?</a>
                </div>
              </form>
              <hr />
              <h4>New user? <a>Create account</a></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-group" role="group" aria-label="social">
        <a class="btn"><img src="images/svg/google.svg" alt="Google" /> Sign in</a>
        <a class="btn"><img src="images/svg/facebook.svg" alt="Facebook" /> Sign in</a>
        <a class="btn"><img src="images/svg/twitter.svg" alt="Twitter" /> Sign in</a>
        <a class="btn"><img src="images/svg/github.svg" alt="Github" /> Sign in</a>
      </div>
    </div>
  </div>
</div>
@endsection
