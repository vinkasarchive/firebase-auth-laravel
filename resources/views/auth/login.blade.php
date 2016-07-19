@extends('layout')

@section('title')
Sign in with your {{ getEnv('APP_NAME') }} account
@endsection

@section('header-right')
<a href="Register" class="nav-btn btn btn-success">Create account</a>
@endsection

@section('content')
<div class="login container">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-1">
      <div class="row">
        <div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
          <div class="panel">
            <div class="panel-body">
              <br />
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
            </div>
          </div>
        </div>
      </div>
      <div class="social">
        <div class="btn-group" role="group" aria-label="social">
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160512_mobilesdk/auth_service_google.svg" alt="Google" /> Sign in</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_facebook.svg" alt="Facebook" /> Sign in</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_twitter.svg" alt="Twitter" /> Sign in</a>
          <a class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_github.svg" alt="Github" /> Sign in</a>
        </div>
      </div>
      <hr />
      <h4>New user? <a>Create account</a></h4>
    </div>
  </div>
</div>
@endsection

@section('firebase-script')
<script>
function google() {
  var provider = new firebase.auth.GoogleAuthProvider();
  firebase.auth().signInWithRedirect(provider);
}
firebase.auth().getRedirectResult().then(function(result) {
  if (result.credential) {
    var token = result.credential.accessToken;
  }
  var user = result.user;
  alert(user.displayName);
}).catch(function(error) {
  var errorCode = error.code;
  var errorMessage = error.message;
  var email = error.email;
  var credential = error.credential;
});
</script>
@endsection
