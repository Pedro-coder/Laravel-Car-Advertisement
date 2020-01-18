<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiMessageController extends Controller
{
  public function queryexception($ex)
  {
  	return \Response::json(array(
            'Exception' => $ex,
            'status' => 400,
            'error' => true,
            'message' => "Querry Exception"
        ));

  }
  public function failedresponse($message)
  {
  		return \Response::json(array(
            'Exception' => "",
            'status' => 400,
            'error' => true,
            'message' => $message,
            'data' => []
          ));
  }



   public function validatemessage($message = "Please fill all the fields")
    {
        return \Response::json(array(
            'Exception' => "",
            'status' => 400,
            'error' => true,
            'message' => $message,
        ));
    }

    public function saveresponse($message)
    {
        return \Response::json(array(
            'Exception' => "",
            'status' => 200,
            'error' => false,
            'message' => $message
        ));
    }



    public function successResponse($data, $message)
    {
        return \Response::json(array(
            'Exception' => "",
            'status' => 200,
            'error' => false,
            'message' => $message,
            'data' => $data

        ));
    }
}
