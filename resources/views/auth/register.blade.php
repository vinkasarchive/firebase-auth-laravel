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
          <form action="" id="signup" name="signup" class="form" method="post">
            <div class="form-group text-left">
              <input type="text" class="form-control" id="name" name="name" placeholder="Full name" required>
            </div>
            <div class="form-group text-left">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
            </div>
            <div class="form-group text-left">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group text-left">
              <input type="password" class="form-control" equalto="#password" id="cpassword" name="cpassword" placeholder="Confirm password">
            </div>
            <div class="form-group">
              <script src='https://www.google.com/recaptcha/api.js'></script>
              <div id="recaptcha" class="g-recaptcha" data-sitekey="{{ getenv('RECAPTCHA_SITE_KEY') }}"></div>
              <input type="hidden" class="hrecaptcha" id="hrecaptcha" name="hrecaptcha" />
            </div>
            <div class="form-group">
              <button id="submit" type="submit" class="btn btn-success btn-block">Create account</button>
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

@section('firebase-script')
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<script>
jQuery.validator.setDefaults({
  debug: {{ getEnv('APP_DEBUG') }},
  success: "valid",
  highlight: function(element) {
    $(element).closest('.form-group').addClass('has-error');
  },
  unhighlight: function(element) {
    $(element).closest('.form-group').removeClass('has-error');
  },
  errorElement: 'span',
  errorClass: 'help-block',
  errorPlacement: function(error, element) {
    if(element.parent('.input-group').length) {
      error.insertAfter(element.parent());
    } else {
      error.insertAfter(element);
    }
  }
});
$("#signup").validate({
  ignore: ".ignore",
  rules: {
    name: {
      required: true
    },
    email: {
      required: true,
      email: true
    },
    password: {
      required: true,
      minlength: 6
    },
    cpassword: {
      required: true,
      equalTo: "#password"
    },
    hrecaptcha: {
      required: function () {
        if (grecaptcha.getResponse() == '') {
          return true;
        } else {
          return false;
        }
      }
    }
  },
  submitHandler: function(form) {
    $("#submit").prop("disabled", true);
    $.ajax({
      url: '/validate/recaptcha',
      type: "post",
      data: {
        'g-recaptcha-response': function() {
          return grecaptcha.getResponse();
        }, "_token":"{{ csrf_token() }}"
      },
      success: function(data){
        if(data.success)
        register();
        else {
          alert(data.message);
          $("#submit").prop("disabled", false);
        }
      },
      error: function(xhr, textStatus, errorThrown){
        alert(textStatus);
        $("#submit").prop("disabled", false);
      }
    });
    return false;
  }
});
</script>
<script>
function register() {
  var email = $('#email').val();
  var password = $('#password').val();
  firebase.auth().createUserWithEmailAndPassword(email, password).then(function(user) {
    var name = $('#name').val();
    user.updateProfile({
      displayName: name
    }).then(function() {
      user.sendEmailVerification();
      alert("Verification email sent to your email. Please check your inbox.");
    }, function(error) {
      alert(error.message);
      user.sendEmailVerification();
      alert("Verification email sent to your email. Please check your inbox.");
    });
  }, function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    alert(error.message);
    $("#submit").prop("disabled", false);
  });
  return false;
}
</script>
@endsection
