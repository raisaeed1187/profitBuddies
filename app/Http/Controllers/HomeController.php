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
Use Alert;



class HomeController extends Controller
{
	
	protected $db;
    public function __construct() {
        $this->db = app('firebase.firestore')->database();
	}
	
	//-----------------------SignIn----------
	public function signIn(Request $request){

		// dd($request->all());

        try {
            $email = $request->email;
            $password = $request->password;
            // $user = app('firebase.auth')->verifyPassword($email,$password);
            $auth=app('firebase.auth');
            $user= $auth->signInWithEmailAndPassword($email,$password);
            // $user=$auth->onAuthStateChanged();
            // dd($user->data()['email']);
            if($user) {
					 echo 'login success';
					//  dd($user)
					 \Session::put('uid', $user->data()['localId']);
					 Session::put('uemail',$user->data()['email']);
					 
					return redirect('/');
            } else {
                    echo 'email verification pending';
            }
            } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
                echo 'Invalid password';
            }
    
    }


	//-----------------------SignUp-------

	public function signUp(Request $request){
		// dd($request->all());
		try {
			$email = $request->email;
			$password = $request->password;
			$authRef = app('firebase.auth')->createUser([
				'email' => $email,
				'password' => $password
			]);
			// dd();
		$actionCodeSettings = [
				'continueUrl' => 'http://localhost:8000/'
		];
	
		app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);
	
		// dd($authRef); //This is unique id of inserted user.
		$user =$this->db->collection('backend_users')->newDocument();
		$user->set([
			'email'=>$authRef->email,
			'firstName'=>$request->firstName,
			'lastName'=>$request->lastName,
			'nationality'=>$request->country,
			'gender'=>'',
			'userID'=>$authRef->uid,
			'userName'=>$request->userName,
			'bussinerHistory'=>$request->history,
			'picUrl'=>'',

		]);
		


		return redirect('/signInForm');
	} 
	catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
	echo 'email already exists';
	}
}

	//=----------------logout---------------

	public function signOut(){
        // dd('sign out');
        app('firebase.auth')->signOut();
        // app('firebase.auth')->unAuth();

    }


	//--------------Index------------
	public function index(Request $request){

		// $student = app('firebase.firestore')->database()->collection('Student')->document('defT5uT7SDu9K5RFtIdl')->snapshot();

		$projects = $this->db->collection('ProjectDetail')->documents();
		$users = array();

			foreach($projects as $project) {
            	if($project->exists()){
               		$usr = $this->db->collection('backend_users')->document($project->data()['userId'])->snapshot();							
					// $user = $usr->toString();
					array_push($users,$usr);
					
				}
			}
		// $data=$country->data();
		// dd($data['name']);

            // print_r('Total records: '.$projects->size());

            // foreach($projects as $project) {
            // if($project->exists()){
            //     print_r('email = '.$project->id());
            //     print_r('location = '.$project->data()['location']);
            //     dd('url = '.$project->data()['picUrl']);

          	//   }
        	// }

		return view('welcome')->with('projects',$projects)
							  ->with('users',$users); 
	}


	//-----------------project details-----------------
	public function projectDetails($id){

		// $date= new \Google\Cloud\Core\Timestamp(new \DateTime(date('Y-m-d H:i:s')));
		// new \Google\Cloud\Core\Timestamp(new \DateTime('2020-04-04 23:03'));

		// dd($date);
		$project = $this->db->collection('ProjectDetail')->document($id)->snapshot();
		// dd(Session::get('uid'));
		// dd($project->id());

		$comments = $this->db->collection('comments')->where('postId','==',$project->id())->documents();

		// $user = $this->db->collection('backend_users')->where('userID','==',$comments->data()['commentFrom'])->documents();
		// dd($user);
		// dd($comments);

			$users = array();

			foreach($comments as $comment) {
            	if($comment->exists()){
               		$usr = $this->db->collection('backend_users')->document($comment->data()['commentFrom'])->snapshot();							
					// $user = $usr->toArray();
					array_push($users,$usr);
					
				}
			}
			
			// dd($users);

			// foreach($users as $user) {
			// 	// print_r($user);
            //     dd($user[0]);
          	  
        	// }


		

		
		return view('project')->with('project',$project)
							  ->with('comments',$comments)
							  ->with('users',$users);
	} 

	//--------------------comment-------------
	public function comment(Request $request){

		// print_r($request->all());

		$comment =$this->db->collection('comments')->newDocument();
		$comment->set([
			'comment'=>$request->comment,
			'postId'=>$request->postId,
			'commentFrom'=>Session::get('uid'),
			'timestamp'=>'',
		]);

		// return \Response::json(array('success'=>true));

		return redirect()->back();


	}

	//---------------------all projects---------------
	public function projects(){
		$projects = $this->db->collection('ProjectDetail')->documents();
		// dd(count((array)$projects));
		// dd($projects);
		$users = array();

			foreach($projects as $project) {
            	if($project->exists()){
               		$usr = $this->db->collection('backend_users')->document($project->data()['userId'])->snapshot();							
					// $user = $usr->toString();
					array_push($users,$usr);
					
				}
			}
		$followers = $this->db->collection('Followers')->documents();	

		$id = Session::get('uid');

		// dd($followers);

		// foreach ($users as  $user) {
		// 	foreach ($followers as $follower) {
		// 		if ($follower->data()['following'] == $user->id() && $follower->data()['followedBy'] == $id) {
		// 			dd('matched');
		// 		}
		// 	}
		// }

		return view('projects')->with('projects',$projects)
							   ->with('users',$users)
							   ->with('followers',$followers);

	}

	public function storeProject(Request $request){
		
		// dd($request->all());
		$imageLink =array();
		$images= $request->image;
		$id = Session::get('uid');
        $projct = app('firebase.firestore')->database()->collection('ProjectDetail')->document($id);
		
		if (!empty($images)) {
			foreach ($images as  $image) {
				$name = rand();
				// $firebase_storage_path = '';
				$localfolder = public_path('firebase-temp-uploads') .'/';
				$extension  = $image->getClientOriginalExtension();
				$file = $name. '.' . $extension;  
				if ($image->move($localfolder, $file)) {
					$uploadedfile = fopen($localfolder.$file, 'r');
					$uploadedObject = app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $file]);
						//will remove from local laravel folder
					unlink($localfolder . $file);
						// echo('success');
				} else {
						echo 'error';
				}
				$expiresAt = new \DateTime('2099-12-12');
				$imageLnk = $uploadedObject->signedUrl($expiresAt).PHP_EOL;
				array_push($imageLink,$imageLnk);
			}
		}
		
		 $date = new \Google\Cloud\Core\Timestamp(new \DateTime('now'));
		// dd($date);
		// dd($request->all());

		$project =$this->db->collection('ProjectDetail')->newDocument();
		$project->set([
			'contact'=>$request->email,
			'currency'=>$request->currency,
			'location'=>$request->country,
			'picUrl'=>$imageLink,
			'postId'=>"",
			'projectdes'=>$request->description,
			'projectstatus'=>"active",
			'projecttype'=>$request->title,
			'remainbudget'=>$request->remainingbudget,
			'totalbudget'=>$request->totalbudget,
			'userId'=>$id,
			'timestamp'=>$date,

		]);

		Session::flash('success','New Project Added');

		return redirect()->back();

	}

	//-------------------following-----------
	public function following(){

		$projects = $this->db->collection('followingPostData')->documents();
		// $projects = $this->db->collection('followingPostData')->document('2jIBLiJPs5Wq486ufxHYZu86HKy1')->collection('2jIBLiJPs5Wq486ufxHYZu86HKy1')->documents();
		// ->collection()->documents()
		
		// dd($projects);
		return view('following');
	}
	
	//----------------------add project------------
	public function addProject(){
		return view('addProject');
	}


	public function followProject($id){
		
	}
	public function followUser($id){
		$follow =$this->db->collection('Followers')->newDocument();
		$follow->set([
			'followedBy'=>Session::get('uid'),
			'following'=>$id,
		]);

		Session::flash('success','your are follow this User');
		return redirect()->back();
	}

	

	//-------------------dashboard section-------------

	


}