function auth(user, remember, token) {
  user.getToken(true).then(function(idToken) {
    NProgress.inc();
    $.ajax({
      url: '/auth',
      type: "post",
      data: {
        'id_token': idToken,
        'name': user.displayName,
        'email': user.email,
        'photo_url': user.photoURL,
        'remember': remember,
        '_token': token
      },
      success: function(data){
        if(data.success) {
          NProgress.set(0.9);
          window.location.replace(data.redirectTo);
        }
        else {
          onFail(data.message);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        onFail(textStatus);
      }
    });
  }).catch(function(error) {
    onFail(error);
  });
}
