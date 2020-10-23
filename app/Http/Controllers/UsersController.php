<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;
// use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Database;
use Session;



class UsersController extends Controller
{

    protected $db;
    public function __construct() {
        $this->db = app('firebase.firestore')->database();
	}

    public function index(){
        $id = Session::get('uid');
		// dd($id);
		$user = $this->db->collection('backend_users')->document($id)->snapshot();
		// dd($user->data()['profilePictureURL']);
	  // foreach($user as $u) {
        //     if($u->exists()){
        //         print_r('email = '.$u->id());
        //         print_r('location = '.$u->data()['firstName']);
        //         dd('url = '.$u->data()['lastName']);

        //   	  }
      // }

      $projects = $this->db->collection('ProjectDetail')->where('userId','==',$id)->documents();
    //   $projects
        $followings = $this->db->collection('Followers')->where('followedBy','==',$id)->documents();
        $followers = $this->db->collection('Followers')->where('following','==',$id)->documents();
        // dd($id);
        // dd($following);
        // dd($followings->size());
        
  
        // dd(sizeOf($followers));


        return view('dashboard.info')->with('user',$user)
                                     ->with('projects',$projects)
                                     ->with('followings',$followings)
                                     ->with('followers',$followers);
                                     
    }

    public function update(Request $request){

        // dd($request->all());
        // dd($request->image);

        // app('firebase.storage')->reference()->child('Project/')->put($request->image);
        // dd('upload');

        $image = $request->image; //base64 string from frontend
        $id = Session::get('uid');
        // dd($id);
        $user = app('firebase.firestore')->database()->collection('ProjectDetail')->document($id);
        // $firebase_storage_path = '';
        // $name = rand();
        $usr = $this->db->collection('backend_users')->document($id)->snapshot();
        // dd($usr->data()['profilePictureURL']);
        // dd($rand);
        $name = $user->id();
        $localfolder = public_path('firebase-temp-uploads') .'/';
        if ($image!=null) {
            $extension  = $image->getClientOriginalExtension();
            $file = $name. '.' . $extension;
            // $file = 'test.PNG';
            // app('firebase.storage')->getBucket()->upload($file, ['name' => $firebase_storage_path . $name]);
            // dd('sccusses');    
            if ($image->move($localfolder, $file)) {

                $uploadedfile = fopen($localfolder.$file, 'r');
                $uploadedObject = app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $file]);

                // app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);

                //will remove from local laravel folder
                unlink($localfolder . $file);

                // echo('success');
            } else {
                echo 'error';
            }
            $expiresAt = new \DateTime('3099-12-12');
            $imageLink = $uploadedObject->signedUrl($expiresAt).PHP_EOL;
        } else {
            $imageLink = $usr->data()['profilePictureURL'];
        }
        
        
            // dd($imageLink);
            // Direct access
            // dd(app('firebase.storage')->getBucket()->object("Project/test.PNG")->signedUrl($expiresAt));

        

        // dd($request->all());
        // $id = Session::get('uid');
        $user = $this->db->collection('backend_users')->document($id);

        $user->set([
                'firstName'=> $request->firstName,
                'lastName' => $request->lastName,
                'gender' => $request->gender,
                'bussinerHistory' => $request->history,
                'profilePictureURL'=>$imageLink,
                'nationality'=>$request->country,
                'userID'=>$id,
                'userName'=>$request->userName,
                'email'=>Session::get('uemail'),
            ]);
        
        Session::flash('success','you updated your profile');

        return redirect()->back();
    }

   // public function uploadImage(){

    //     $image = $request->image; //base64 string from frontend

    //         // $image = $request->file('image'); //image file from frontend

    //     $project = app('firebase.firestore')->database()->collection('ProjectDetail')->document('1YciQKxeXIfUMWmDAoYi');

    //     $firebase_storage_path = 'Project/';

    //     $name = $project->id();

    //     $localfolder = public_path('firebase-temp-uploads') .'/';

    //     $extension  = $image->getClientOriginalExtension();

    //     $file = $name. '.' . $extension;
        
    //     // app('firebase.storage')->getBucket()->upload($file, ['name' => $firebase_storage_path . $name]);
    //     // dd('sccusses');    
    //     if ($image->move($localfolder, $file)) {

    //             $uploadedfile = fopen($localfolder.$file, 'r');

    //             app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);

    //             //will remove from local laravel folder
    //             unlink($localfolder . $file);

    //             echo 'success';
    //         } else {
    //             echo 'error';
    //         }



    //     // $image = $request->file('image'); //image file from frontend

    //     // $project = app('firebase.firestore')->database()->collection('ProjectDetail')->document('1YciQKxeXIfUMWmDAoYi');

    //     // $firebase_storage_path = 'Project/';

    //     // $name = $project->id();

    //     // $localfolder = public_path('firebase-temp-uploads') .'/';

    //     // $extension  = $image->getClientOriginalExtension();

    //     // $file = $name. '.' . $extension;

    //     //     if ($image->move($localfolder, $file)) {

    //     //         $uploadedfile = fopen($localfolder.$file, 'r');

    //     //         app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);

    //     //         //will remove from local laravel folder
    //     //         unlink($localfolder . $file);

    //     //         echo 'success';
    //     //     } else {
    //     //         echo 'error';
    //     //     }


   // }

   public function followings(){
        $id = Session::get('uid');
        // dd($id);
        $followings = $this->db->collection('Followers')->where('followedBy','==',$id)->documents();
        $users = array();

			foreach($followings as $following) {
            	if($following->exists()){
                    // dd($following->data()['following']);
               		$usr = $this->db->collection('backend_users')->document($following->data()['following'])->snapshot();							
					// $user = $usr->toArray();
					array_push($users,$usr);
					
				}
			}
        // dd($users);
        return view('dashboard.following')->with('users',$users);
   }

   public function followers(){
        $id = Session::get('uid');
        $followers = $this->db->collection('Followers')->where('following','==',$id)->documents();
        // dd($followers);
        $users = array();

			foreach($followers as $follower) {
            	if($follower->exists()){
                    // dd($following->data()['following']);
               		$usr = $this->db->collection('backend_users')->document($follower->data()['followedBy'])->snapshot();							
					// $user = $usr->toArray();
					array_push($users,$usr);
					
				}
            }
            // dd($users);
        return view('dashboard.following')->with('users',$users);
   }

}
