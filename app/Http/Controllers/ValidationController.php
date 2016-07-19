<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValidationController extends Controller
{

  public function validateRecaptcha(Request $request) {
    $validator = Validator::make($request->all(), [
      'g-recaptcha-response' => 'required|recaptcha',
    ]);
    if($request->ajax()){
      if ($validator->fails()) {
        return response()->json(array(
          'success' => false,
          'message' => $validator->getMessageBag()->first()
        ));
      } else {
        return response()->json(array(
          'success' => true
        ));
      }
    }
  }

}
