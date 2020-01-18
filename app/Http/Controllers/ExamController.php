<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
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

    public function exams() {
       	$Examinations = \App\Examination::orderBy('id','desc')->paginate(10);
        $formUrl = route('exam.store');
        $ExaminationImg = asset('no-image.jpg');
        return view('pages.exam.list', compact('Examinations','formUrl','ExaminationImg'));
    }

    public function examuser() {
        $Examinations = \App\Examination::orderBy('id','desc')->paginate(10);
        if(!empty($Examinations)){
              foreach($Examinations as $key => $value) {
                if(!empty($value->youtube_link)){
                  $str = $value->youtube_link;
                  $url = explode("v=",$str);
                  $value['youlink'] = "https://www.youtube.com/embed/". $url[1];
                }       
              };
        }

        return view('pages.exam.examuser', compact('Examinations'));
    }
    
    public function store() {
         
         $validator = \Validator::make($this->req->all(), [
            'question' => 'required',
            'answer' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ExaminationData = [    
            'question' => $this->req->get('question'),
            'answer' => $this->req->get('answer'),
            'youtube_link' => $this->req->get('youtube_link') 
        ];

        if ($this->req->hasFile('image')) {
            $destinationPath = 'uploads/Examination';
            $file =$this->req->image;
            $filename = str_slug(time().'.'.$file->getClientOriginalExtension());
            $upload = $file->move($destinationPath, $filename);
            $ExaminationData['image'] = $filename;
        }
        $Examination = \App\Examination::create($ExaminationData);
        return redirect('/examsetup')->with('success', 'Examination save successfully');
    }

 public function checkExam() {
         
         $validator = \Validator::make($this->req->all(), [
            'question' => 'required',
            'answer' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ExaminationData = [    
            'question' => $this->req->get('question'),
            'answer' => $this->req->get('answer'),
        ];

$matchThese = ['question' => $this->req->get('question'), 'answer' => $this->req->get('answer')];

print_r($matchThese);
      
        $Examination = \App\Examination::where($matchThese);
                if (!empty($Examination->image)) {

        return redirect('/examuser')->with('success', 'Correct Answer');
    }
    else
    {
                return redirect('/examuser')->with('fail', 'Wrong Answer');

    }
    }

    public function editExam($id) {
        $Examinations = \App\Examination::orderBy('id','desc')->paginate(10);
        $Examination = \App\Examination::find($id);
        $formUrl = route('exam.update', $id);
        if (!empty($Examination->image)) {
            $ExaminationImg = asset('uploads/Examination/'.$Examination->image);
        } else {
            $ExaminationImg = asset('no-image.jpg');
        }
        return view('pages.exam.list', compact('Examination','formUrl','Examinations','ExaminationImg'));
    }

    public function updateExam($id) {  
        $validator = \Validator::make($this->req->all(), [
            'question' => 'required',
            'answer' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ExaminationData = [    
            'question' => $this->req->get('question'),
            'answer' => $this->req->get('answer'),
            'youtube_link' => $this->req->get('youtube_link') 
        ];

        if ($this->req->hasFile('image')) {
            $destinationPath = 'uploads/Examination';
            $file =$this->req->image;
            $filename = str_slug(time().'.'.$file->getClientOriginalExtension());
            $upload = $file->move($destinationPath, $filename);
            $ExaminationData['image'] = $filename;
        }
        $user = \App\Examination::where('id', $id)->update($ExaminationData);
        return redirect('/examsetup')->with('success', 'Examination updated successfully.');
    }
    
    public function deleteExam($id) {
        $users = \App\Examination::find($id)->delete();
        return redirect('/examsetup')->with('success', 'Examination deleted successfully.');
    }
}
