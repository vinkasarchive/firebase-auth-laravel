@extends('layout')

@section('content')
<div id="login">
  <div class="page-header">
    <h1>Sign in <small>with your {{ getEnv('APP_NAME') }} Account</small></h1>
  </div>
  <div class="container">
    <div class="col-md-6 col-lg-4 col-lg-offset-1">
      <img src="/images/1x/btn_google_signin_{{ getEnv('APP_UI') }}_normal_web.png" alt="Sign in with Google" />
    </div>
    <div class="col-md-6 col-lg-4 col-lg-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <form class="form">
            <div class="form-group">
              <input type="text" class="form-control" id="login" name="login" placeholder="Username or Email address">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Stay signed in
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @endsection
