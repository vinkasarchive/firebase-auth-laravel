<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{ getEnv('APP_NAME')}}</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
  <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
</head>
<body>
  <div class="mdl-layout mdl-js-layout">
    <div class="mdl-layout__header mdl-layout__header--waterfall">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">
          {{ getEnv('APP_NAME')}}
        </span>

        <div class="mdl-layout-spacer"></div>

        <div class="navigation-container">
          <nav class="mdl-navigation mdl-typography--text-uppercase">
            <a class="mdl-navigation__link" href="">Sign in</a>
            <script src="https://apis.google.com/js/platform.js" async defer></script>
          </nav>
        </div>

      </div>
    </div>
    <div class="mdl-layout__content">
      <a name="top"></a>
      @yield('content')
    </div>
  </div>
</div>
<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.2.0/firebase-auth.js"></script>
<script>
var config = {
  apiKey: "{{ getEnv('FIREBASE_API_KEY')}}",
  authDomain: "{{ getEnv('FIREBASE_AUTH_DOMAIN')}}",
};
firebase.initializeApp(config);
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

<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</body>
</html>
