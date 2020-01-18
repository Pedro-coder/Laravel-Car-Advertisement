<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{

    public function followUser(Request $request)
    {
        $response = array();
        $userId = Auth::user()->id;
        $followableId = $request->get('followable_id');
        $status = $request->get('follow_status');
        $allInputs = $request->all();


        try {
            $validation = Validator::make($allInputs, [
                'followable_id' => 'required',
                'follow_status' => 'required',
            ]);

            if ($validation->fails()) {
                $response = (new ApiMessageController())->validatemessage($validation->errors()->first());
            } else {

                $isExist = (new Follow())->where('user_id', '=', $userId)->where('followable_id', '=', $followableId)->first();
                if ($isExist)
                {
                    $saveFollow = (new Follow())->where('user_id', '=', $userId)->where('followable_id', '=', $followableId)
                        ->update(['status' => $status]);
                }else{
                    $model = new Follow();
                    $model->user_id = $userId;
                    $model->followable_id = $followableId;
                    $model->status = $status;
                    $saveFollow = $model->save();
                }

                if ($saveFollow)
                {
                    $response = (new ApiMessageController())->saveresponse("Follow Status Updated Successfully!");
                }else{
                    $response = (new ApiMessageController())->failedresponse("Failed to Update Follow Status!");
                }

            }

        } catch (\Illuminate\Database\QueryException $ex) {
            $response = (new ApiMessageController())->queryexception($ex);

        }

        return $response;

    }
}
