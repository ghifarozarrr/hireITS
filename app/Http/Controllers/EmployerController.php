<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Job;
use App\Employer;
use App\Freelancer;
use App\HarusBisaSkill;
use App\ProfileFiles;
use App\WonBy;
use App\Messages;
use App\User;
use App\JobFiles;
use App\Bid;
use App\Review;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
  public function index(){
    if (Auth::check())
      $id = Auth::user()->id;
    else $id=9;

    $reviews = Review::where('to_id', Auth::user()->id)->get();
    $employer = Employer::find($id);
    $pf = ProfileFiles::where('user_id', $id)->where('role', 'dp')->get();
    $cover=ProfileFiles::where('user_id', $id)->where('role', 'cover')->get();

  	return view('employer.profile')->with('employer', $employer)->with('pf', $pf)->with('cover', $cover)->with('reviews', $reviews);
  }

  public function viewEmployer($username){
    $id = User::where('username', $username)->first();
    if ($id === null) return "No employer found with the given username: ". $username;
    $employer = Employer::find($id);



    $reviews = Review::where('to_id', $employer[0]->employer_id)->get();

    $pf = ProfileFiles::where('user_id',$id->id)->where('role', 'dp')->get();
    $cover=ProfileFiles::where('user_id', $id->id)->where('role', 'cover')->get();
    return view('employer.view-employer')->with('employer', $employer)->with('pf', $pf)->with('reviews', $reviews)->with('cover', $cover);
  }

  public function postProject(Request $request){
    return view('employer.post-project');
  }
  public function storeProject(Request $request){

    $this->validate($request, [
    'name' => 'required',
    'photos'=>'required',
    'description' => 'required',
    'min_price' => 'required',
    'max_price' => 'required',
    'date' => 'required',
    ]);

    $allowedfileExtension=['png','jpg','jpeg'];

    if ($request->hasFile('photos')){
      foreach ($request->photos as $photo) {
        $extension = $photo->getClientOriginalExtension();
        $check=in_array($extension,$allowedfileExtension);

        if (!$check){
          return redirect()->back()->withInput()->with('error', 'File has to be png or jpeg');
        }
      }
    }

    $job=new Job;
    $job->name = $request->name;
    $job->description = $request->description;
    $job->employer_id = Auth::user()->id;
    $job->price_min = $request->min_price;
    $job->price_max = $request->max_price;
    $job->active = 1;
    $job->deadline = date_format(date_create($request->date), 'Y-m-d');
    $job->slug = str_replace(' ', '-', strtolower($request->name))."-".time();

  //  return $request->search_skills;

    if ($job->save()){
      for ($i=0; $i <count($request->search_skills) ; $i++) {
        $harus_bisa = new HarusBisaSkill;
        $harus_bisa->job_id = $job->job_id;
        $harus_bisa->skills_id = $request->search_skills[$i];
        $harus_bisa->save();
      }
      foreach ($request->photos as $photo) {
        $image = new JobFiles;
        $image->job_id = $job->job_id;
        $filename = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $contents = $photo->openFile()->fread($photo->getSize());
        $image->name = $contents;
        $image->type ="image/".$extension;
        $image->save();
      }
      return redirect()->route('view.project', $job->slug)->with('success', 'Project uploaded!');
    }
    else redirect()->back()->with('error', 'Project failed to upload!');
  }

  public function empget(){
  	return view('employer.egetdata');
  }

  public function getData(Request $request){
  	 $id = Auth::user()->id;
  	 $emp = Employer::find($id);
  	 $emp->name = $request->input('nama');
  	 $emp->title = $request->input('special');
  	 $emp->description = $request->input('details');
  	 $emp->address = $request->input('address');
  	 $emp->price = $request->input('number');
  	 $user = Auth::user();

     $user->hassetprofile = 1;

     if($emp->save() && $user->save()){
     	return redirect()->route('view.employer.profile');
     }
  }

  public function getProfile(Request $request){
    if (Auth::check())
      $id = Auth::user()->id;
    else $id=9;
    $employer = Employer::find($id);
    return response()->json($employer);
  }
  public function updateProfile(Request $request){
    $employer = Employer::find($request->input('id'));
    $employer->name = $request->input('name');
    $employer->title = $request->input('title');
    $employer->description = $request->input('description');
    $employer->price = $request->input('price');
    $employer->address = $request->input('address');
    $user = Auth::user();
    $user->hassetprofile = 1;

    if ($employer->save() && $user->save())
      return response()->json(["success"=>1]);
    else return response()->json(["success"=>0]);

  }

  public function getJobDetails(Request $request){
    $job = Job::find($request->job_id);
    return $job;
  }

  public function hireFreelancer(Request $request){
    $job = Job::find($request->job_id);
    $job->active = 0;
    $wonby = new WonBy;
    $wonby->won_by_id = $request->won_by_id;
    $wonby->job_id = $request->job_id;
    if ($wonby->save() && $job->save()) return redirect()->back()->with('success', 'You successfully hired a freelancer. Check your dashboard for progress');
  }

  public function dashboard(){
    $my_projects = Job::where('active', 1)->where('complete', 0)->get();

    $ongoing_projects = DB::table('won_by')
          ->join('job', 'won_by.job_id', '=', 'job.job_id')
          ->select('*')->where('complete',0)->where('job.employer_id', Auth::user()->id)->distinct()
          ->get();

    $finished_projects = DB::table('won_by')
          ->join('job', 'won_by.job_id', '=', 'job.job_id')
          ->join('bid', 'job.job_id', '=', 'bid.job_id')
          ->select('*')->where('complete',1)->where('job.employer_id', Auth::user()->id)->groupBy('job.job_id')
          ->get();

     return view('employer.dashboard')->with('projects', $ongoing_projects)->with('finished_projects', $finished_projects)
            ->with('my_projects', $my_projects);
   }

   public function getMessages(Request $request){
     $messages = Messages::where('job_id', $request->job_id)->select('msg_id','job_id', 'from_id', 'to_id','msg_text','progress', 'file_type', 'sent_at')->get();
     if($messages->isEmpty()) return "No message";
     if(User::find($messages[0]->to_id)->role === "freelancer"){
       $name['freelancer_name']= User::find($messages[0]->to_id)->username;
       $name['freelancer_id']= User::find($messages[0]->to_id)->id;
       $name['employer_name'] = User::find($messages[0]->from_id)->username;
       $name['employer_id'] = User::find($messages[0]->from_id)->id;
     }else{
       $name['employer_name']= User::find($messages[0]->to_id)->username;
       $name['employer_id']= User::find($messages[0]->to_id)->id;
       $name['freelancer_name'] = User::find($messages[0]->from_id)->username;
       $name['freelancer_id'] = User::find($messages[0]->from_id)->id;
     }


     return response()->json([$messages, $name]);
   }

   public function sendProgress(Request $request){
     $message = new Messages;
     $message->from_id = $request->from_id;
     $message->to_id = (WonBy::where('job_id',$request->job_id)->get())[0]->won_by_id;
     $message->job_id = $request->job_id;
     $message->msg_text = $request->msg_text;

     if ($request->hasFile('progress_file')) {
       $file = $request->file('progress_file');
       $contents = $file->openFile()->fread($file->getSize());
       $extension = $file->getClientOriginalExtension();
       $message->file = $contents;
       $message->file_type = $extension;
     }

     if ($message->save())
       return redirect()->back()->with('success', 'Feedback sent to freelancer.');
     return redirect()->back()->with('error', 'Failed sending progress.');
   }

   public function storeProfilePic(Request $request){
     $file = $request->file('image');
     $contents = $file->openFile()->fread($file->getSize());
     $extension = "image/".$request->file('image')->extension();
     $pf=ProfileFiles::where('user_id',Auth::user()->id)->where('role','dp')->get();
     if ($pf->isEmpty()){
       $pf = new ProfileFiles;
       $pf->user_id = Auth::user()->id;
       $pf->name = $contents;
       $pf->img_type = $extension;
       $pf->role = "dp";
       if ($pf->save()){
         return redirect()->route('view.employer.profile');
       }
     }else{
       $pf=ProfileFiles::where('user_id',Auth::user()->id)->where('role','dp')->update([
         'name'=>$contents,
         'img_type'=>$extension
       ]);
         return redirect()->route('view.employer.profile');
     }
   }

   public function getPaymentDetails(Request $request){
     $price = Bid::where('job_id', $request->job_id)->where('freelancer_id', $request->freelancer_id)->first();
     $paypal_set=0;
     if (!User::find($price->freelancer_id)['paypal']=="")
      $paypal_set = 1;
     return response()->json([number_format($price['price'], 2), $paypal_set]);
   }

   public function rateFreelancer(Request $request){
     $review = new Review;
     $review->from_id = Auth::user()->id;
     $review->job_id = $request->rate_job_id;
     $review->to_id = $request->rate_to_id;
     $review->comment = $request->comment;
     $review->rating = $request->stars;
     $job=Job::find($request->rate_job_id);
     $job->has_review=$job->has_review+1;

     $freelancer = Freelancer::find($request->rate_to_id);

     $rating = $freelancer->rating + $request->stars;
     $reviews = $freelancer->review + 1;

     $freelancer->rating = $rating;
     $freelancer->review =$reviews;

     $freelancer->jobs_completed+=1;

     if ($review->save() && $job->save() && $freelancer->save())
      return redirect()->back()->with('success', 'Freelancer rated!');

   }

   public function deleteProject(Request $request){
     $job = Job::find($request->job_id);
     if ($job->delete())
      return redirect()->route('view.employer.dashboard')->with('success', 'Project deleted!');
   }

}
