<?php

namespace Vinkas\Visa;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
  AuthenticatableContract,
  AuthorizableContract
{
  use Authenticatable, Authorizable {
    getAuthPassword as legacyPassword;
  }

  public $incrementing = false;

  public function getAuthPassword() {
    return null;
  }

}
