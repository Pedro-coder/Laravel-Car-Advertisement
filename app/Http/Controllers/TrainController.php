<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrainController extends Controller
{
    //
    //
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->req = $request;
    }

    public function trains() {
       	$Trainees = \App\Training::orderBy('id','desc')->paginate(10);
        $formUrl = route('train.store');
        $TraineeImg = asset('no-image.jpg');
        return view('pages.train.list', compact('Trainees','formUrl','TraineeImg'));
    }

    public function trainuser() {
        $Trainees = \App\Training::orderBy('id','desc')->paginate(10);

        if(!empty($Trainees)){
              foreach($Trainees as $key => $value) {
                if(!empty($value->youtube_link)){
                  $str = $value->youtube_link;
                  $url = explode("v=",$str);
                  $value['youlink'] = "https://www.youtube.com/embed/". $url[1];
                }       
              };
        }

        return view('pages.train.trainuser', compact('Trainees'));
    }
    
    public function store() {
         
         $validator = \Validator::make($this->req->all(), [
            'title' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $TraineeData = [    
            'title' => $this->req->get('title'),
            'youtube_link' => $this->req->get('youtube_link') 
        ];

        if ($this->req->hasFile('image')) {
            $destinationPath = 'uploads/Training';
            $file =$this->req->image;
            $filename = str_slug(time().'.'.$file->getClientOriginalExtension());
            $upload = $file->move($destinationPath, $filename);
            $TraineeData['image'] = $filename;
        }
        $Trainee = \App\Training::create($TraineeData);

        return redirect('/trainsetup')->with('success', 'Trainee save successfully');
    }

    public function editTrain($id)
     {
        $Trainees = \App\Training::orderBy('id','desc')->paginate(10);
        $Trainee = \App\Training::find($id);
        $formUrl = route('train.update', $id);
        if (!empty($Trainee->image)) {
            $TraineeImg = asset('uploads/Training/'.$Trainee->image);
        } else {
            $TraineeImg = asset('no-image.jpg');
        }
        return view('pages.train.list', compact('Trainee','formUrl','Trainees','TraineeImg'));
    }

    public function updateTrain($id) {  
        $validator = \Validator::make($this->req->all(), [
            'title' => 'required'        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $TraineeData = [    
            'title' => $this->req->get('title'),
            'youtube_link' => $this->req->get('youtube_link') 
        ];

        if ($this->req->hasFile('image')) {
            $destinationPath = 'uploads/Training';
            $file =$this->req->image;
            $filename = str_slug(time().'.'.$file->getClientOriginalExtension());
            $upload = $file->move($destinationPath, $filename);
            $TraineeData['image'] = $filename;
        }
        $user = \App\Training::where('id', $id)->update($TraineeData);
        return redirect('/trainsetup')->with('success', 'Trainee updated successfully.');
    }
    
    public function deleteTrain($id) {
        $users = \App\Training::find($id)->delete();
        return redirect('/trainsetup')->with('success', 'Trainee deleted successfully.');
    }
}
