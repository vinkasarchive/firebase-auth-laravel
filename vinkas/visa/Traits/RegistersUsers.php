<?php

namespace Vinkas\Visa\Traits;

use App\User;
use Validator;

/**
 * Class RegistersUsers.
 */
trait RegistersUsers
{

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
      return Validator::make($data, [
          'id_token' => 'required',
          'remember' => 'boolean',
          'email' => 'email',
          'photo_url' => 'url',
      ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
  protected function create(array $data)
  {
      return User::create([
          'id' => $data['id'],
          'name' => $data['name'],
          'email' => $data['email'],
          'photo_url' => $data['photo_url'],
      ]);
  }

  protected function visaRegister($uid, $request) {
    $data['id'] = $uid;
    $data['name'] = $request->has('name') ? $request->input('name') : null;
    $data['email'] = $request->has('email') ? $request->input('email') : null;
    $data['photo_url'] = $request->has('photo_url') ? $request->input('photo_url') : null;
    $this->create($data);
  }

}
