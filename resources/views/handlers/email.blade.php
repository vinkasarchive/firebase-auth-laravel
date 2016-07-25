@extends('layout')

@section('title')
Sign in with your {{ getEnv('APP_NAME') }} account
@endsection

@section('content')
@endsection

@section('firebase-script')
<script>
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

document.addEventListener('DOMContentLoaded', function() {
  var mode = getParameterByName('mode');
  var actionCode = getParameterByName('oobCode');
  var apiKey = getParameterByName('apiKey');

  var auth = firebase.auth();

  switch (mode) {
    case 'resetPassword':
    handleResetPassword(auth, actionCode);
    break;
    case 'recoverEmail':
    handleRecoverEmail(auth, actionCode);
    break;
    case 'verifyEmail':
    handleVerifyEmail(auth, actionCode);
    break;
    default:
  }
}, false);

function handleResetPassword(auth, actionCode) {
  var accountEmail;
  auth.verifyPasswordResetCode(actionCode).then(function(email) {
    var accountEmail = email;
    auth.confirmPasswordReset(actionCode, newPassword).then(function(resp) {

    }).catch(function(error) {
      // Error occurred during confirmation. The code might have expired or the
      // password is too weak.
    });
  }).catch(function(error) {
    // Invalid or expired action code. Ask user to try to reset the password
    // again.
  });
}

function handleRecoverEmail(auth, actionCode) {
  var restoredEmail = null;
  auth.checkActionCode(actionCode).then(function(info) {
    restoredEmail = info['data']['email'];
    return auth.applyActionCode(actionCode);
  }).then(function() {

    auth.sendPasswordResetEmail(restoredEmail).then(function() {
      // Password reset confirmation sent. Ask user to check their email.
    }).catch(function(error) {
      // Error encountered while sending password reset code.
    });
  }).catch(function(error) {
    // Invalid code.
  });
}

function handleVerifyEmail(auth, actionCode) {
  auth.applyActionCode(actionCode).then(function(resp) {
    window.location.replace("{!! route('login') !!}?success=Your+email+address+verified+successfully");
  }).catch(function(error) {
    alert(error.message);
  });
}
</script>
@endsection
