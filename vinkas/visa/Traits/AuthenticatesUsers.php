<?php

namespace Vinkas\Visa\Traits;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Auth;
use App\User;

/**
* Class AuthenticatesUsers.
*/
trait AuthenticatesUsers
{

  public function ajaxLogin(Request $request) {
    $data = $request->all();
    $validator = $this->validator($data);
    if ($validator->fails())
    return $this->onFail($validator->errors()->first() . " " . $request->input('remember'));

    JWT::$leeway = 8;
    $content = file_get_contents("https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com");
    $kids = json_decode($content, true);
    $jwt = JWT::decode($request->input('id_token'), $kids, array('RS256'));
    $fbpid = config('firebase.project_id');
    $issuer = 'https://securetoken.google.com/' . $fbpid;
    if($jwt->aud != $fbpid)
    return $this->onFail('Invalid audience');
    elseif($jwt->iss != $issuer)
    return $this->onFail('Invalid issuer');
    elseif(empty($jwt->sub))
    return $this->onFail('Invalid user');
    else {
      $uid = $jwt->sub;
      $this->visaLogin($uid, $request);
      return response()->json(['success' => true]);
    }
  }

  protected function onFail($message) {
    return response()->json(['success' => false, 'message' => $message]);
  }

  protected function visaLogin($uid, $request) {
    $remember = false;
    if($request->has('remember'))
    $remember = $request->input('remember');

    $user = User::where('id', $uid)->first();
    if($user == null) {
      $data['id'] = $uid;
      $data['name'] = null;
      $data['email'] = null;
      $data['photo_url'] = null;
      if($request->has('name'))
      $data['name'] = $request->input('name');
      if($request->has('email'))
      $data['email'] = $request->input('email');
      if($request->has('photo_url'))
      $data['photo_url'] = $request->input('photo_url');
      $this->create($data);
    }
    Auth::loginUsingId($uid, $remember);
  }

}
