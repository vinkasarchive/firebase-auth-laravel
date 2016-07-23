<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller {

  public function getVerification(Request $request) {
    return view('handlers.email');
  }

}
