<?php

namespace App\Http\Controllers;

use App\PostBid;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function reviewUser(Request $request)
    {
        $response = array();
        $userId = Auth::user()->id;
        $reviewableId = $request->get('reviewable_id');
        $reviewNumber = $request->get('review_number');
        $bidId = $request->get('bid_id');
        $allInputs = $request->all();


        try {
            $validation = Validator::make($allInputs, [
                'reviewable_id' => 'required',
                'review_number' => 'required',
            ]);

            if ($validation->fails()) {
                $response = (new ApiMessageController())->validatemessage($validation->errors()->first());
            } else {
                if($bidId){
                    $isExist = (new Review())->where('user_id', '=', $userId)->where('reviewable_id', '=', $reviewableId)->where('bid_id', '=', $bidId)->first();
                }else{
                $isExist = (new Review())->where('user_id', '=', $userId)->where('reviewable_id', '=', $reviewableId)->first();
                }
                if ($isExist) {
                    $saveReview = (new Review())->where('user_id', '=', $userId)->where('reviewable_id', '=', $reviewableId)
                        ->update(['review_number' => $reviewNumber]);
                } else {
                    $model = new Review();
                    $model->user_id = $userId;
                    $model->reviewable_id = $reviewableId;
                    $model->review_number = $reviewNumber;
                    if($bidId){
                        $model->bid_id = $bidId;
                        if($request->status=='closed'){
                            $bid=PostBid::find($bidId);
                            $bid->status='closed';
                            $bid->save();
                        }
                    }

                    $saveReview = $model->save();
                }

                if ($saveReview) {
                    $response = (new ApiMessageController())->saveresponse("Review Saved Successfully!");
                } else {
                    $response = (new ApiMessageController())->failedresponse("Failed to Save Review!");
                }

            }

        } catch (\Illuminate\Database\QueryException $ex) {
            $response = (new ApiMessageController())->queryexception($ex);

        }

        return $response;

    }

    public function getAverageTotalReview(Request $request)
    {

        $response = array();
        $dataArray = array();
        $reviewableId = $request->get('user_id');
        $allInputs = $request->all();

        try {
            $validation = Validator::make($allInputs, [
                'user_id' => 'required',
            ]);

            if ($validation->fails()) {
                $response = (new ApiMessageController())->validatemessage($validation->errors()->first());
            } else {

                $averageReview = (new Review())->where('reviewable_id', $reviewableId)->avg('review_number');
                $myReview = (new Review())->where('reviewable_id', $reviewableId)->where('user_id', Auth::id())->value('review_number');
                $totalReview = (new Review())->where('reviewable_id', $reviewableId)->count();
                
                $dataArray = array(
                    'my_review' => number_format($myReview, 1),
                    'average_review' => number_format($averageReview, 1),
                    'total_review' => $totalReview
                );

                $response = (new ApiMessageController())->successResponse($dataArray,"My, Average and Total Review Fetched Successfully!");

            }

        } catch (\Illuminate\Database\QueryException $ex) {
            $response = (new ApiMessageController())->queryexception($ex);

        }

        return $response;

    }
}
