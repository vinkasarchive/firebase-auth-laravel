@extends('layout')

@section('title')
Sign in with your {{ getEnv('APP_NAME') }} account
@endsection

@section('header-right')
<a href="{!! route('register') !!}" class="nav-btn btn btn-success">Create account</a>
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
              <form class="form" method="post">
                <div class="form-group text-left">
                  <input type="text" class="form-control" id="login" name="login" placeholder="Username or Email address">
                </div>
                <div class="form-group text-left">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group checkbox text-left">
                  <label>
                    <input id="remember" name="remember" type="checkbox"> Stay signed in
                  </label>
                </div>
                <div class="form-group">
                  <button onclick="return signin();" type="submit" class="btn btn-primary btn-block">Sign in</button>
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
          <a title="Sign in with Google" onclick="return signInWith('google')" class="btn"><img src="https://www.gstatic.com/mobilesdk/160512_mobilesdk/auth_service_google.svg" alt="Google" /> Sign in</a>
          <a title="Sign in with Facebook" onclick="return signInWith('facebook')" class="btn"><img src="https://www.gstatic.com/mobilesdk/160409_mobilesdk/images/auth_service_facebook.svg" alt="Facebook" /> Sign in</a>
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
function signInWith(providerName) {
  NProgress.start();
  var provider;
  switch (providerName) {
    case 'google':
    provider = new firebase.auth.GoogleAuthProvider();
    break;
    case 'facebook':
    provider = new firebase.auth.FacebookAuthProvider();
    break;
    default:
    break;
  }
  firebase.auth().signInWithRedirect(provider);
  return false;
}
firebase.auth().getRedirectResult().then(function(result) {
  var user = result.user;
  if(user) {
    if (result.credential) {
      var accessToken = result.credential.accessToken;
    }
    NProgress.start();
    auth(user, 0, token);
  }
}).catch(function(error) {
  var errorCode = error.code;
  var errorMessage = error.message;
  onFail(error.message);
});
function signin() {
  NProgress.start();
  var email = $("#login").val();
  var password = $("#password").val();
  var remember = function () {
    if($("#remember").is(":checked"))
    return 1;
    else
    return 0;
  };
  firebase.auth().signInWithEmailAndPassword(email, password).then(function(user) {
    NProgress.inc();
    if(user.emailVerified) {
      auth(user, remember, token);
    } else {
      onFail("{!! trans('visa.warning_verify_email') !!}");
    }
  }).catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    onFail(errorMessage);
  });
  return false;
}
function onFail(message) {
  $("#submit").prop("disabled", false);
  NProgress.done();
  $("#noticeboard").html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> ' + message + '</div>');
}
</script>
@endsection
