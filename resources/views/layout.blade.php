<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>
    @hasSection('title')
    @yield('title') - {{ getEnv('APP_NAME')}}
    @else
    {{ getEnv('APP_NAME')}}
    @endif
  </title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/vinkas/visa.css" />
</head>
<body class="visa">
  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-xs-3">
          <h1 class="logo"><img src="/images/logo.png" /></h1>
        </div>
        <div class="col-xs-9 text-right">
          @hasSection ('header-right')
          @yield('header-right')
          @else
          @if (Auth::check())
          {{ Auth::user()->name }}
          @else
          <div class="btn-group" role="group" aria-label="account">
            <a href="{!! route('register') !!}" class="nav-btn btn btn-success">Create account</a>
            <a href="{!! route('login') !!}" class="nav-btn btn btn-primary">Sign in</a>
          </div>
          @endif
          @endif
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="page-header text-center">
      <h1 class="h2">
        @hasSection('title')
        @yield('title')
        @else
        {{ getEnv('APP_NAME')}}
        @endif
      </h1>
    </div>
  </div>
  @yield('content')
  <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.2.0/firebase-auth.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src='/modules/nprogress/nprogress.js'></script>
  <link rel='stylesheet' href='/modules/nprogress/nprogress.css'/>
  <script>
  var config = {
    apiKey: "{{ getEnv('FIREBASE_API_KEY')}}",
    authDomain: "{{ getEnv('FIREBASE_AUTH_DOMAIN')}}",
  };
  firebase.initializeApp(config);
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {

    } else {

    }
  });
  </script>
  @yield('firebase-script')
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
