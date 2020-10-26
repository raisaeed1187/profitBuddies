<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Algolia\AlgoliaSearch\SearchClient;
use Kreait\Firebase;
// use Kreait\Firebase\Factory;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\ServiceAccount;
// use Kreait\Firebase\Database;
use Session;
Use Alert;
use Laravel\Scout\Searchable;


class HomeController extends Controller
{
	
	

	protected $db;
	protected $index;
    public function __construct() {
		$this->db = app('firebase.firestore')->database();
		$client = SearchClient::create(
			'C4QIEL27O7',
			'97870631eaee16c95aebecee54ea3746'
		  );
		  
		  $this->index = $client->initIndex('posts');
	}
	
	public function searchPosts(Request $request){
		// $res = $index->search('query string');
		// with search parameters
		
		// dd($request->search);
		$users = array();
		if ($request->search != null) {
		
		$res = $this->index->search($request->search, [
		'attributesToRetrieve' => [
			'projecttype',
		],
		'hitsPerPage' => 50
		]);
		// dd($res['hits']);
		// dd($res['hits'][0]['_highlightResult']['picUrl']['value']);

		foreach ($res['hits'] as $hit) {
			# code...
			$usr = $this->db->collection('backend_users')->document($hit['_highlightResult']['userId']['value'])->snapshot();							
					
			array_push($users,$usr);
		}
		$projects = $res['hits'];
		return view('search-result')->with('projects',$projects)
							   ->with('users',$users);

		
		} else {
				return redirect()->back();
			}
	}
	
	//-----------------------SignIn----------
	public function signIn(Request $request){

        try {
            $email = $request->email;
            $password = $request->password;
			$auth=app('firebase.auth');
            $user= $auth->signInWithEmailAndPassword($email,$password);
            // $user=$auth->onAuthStateChanged();
            // dd($user->data()['email']);
            if($user) {
					//  echo 'login success';
					//  dd($user)
					 \Session::put('uid', $user->data()['localId']);
					 Session::put('uemail',$user->data()['email']);
					 
					return redirect('/');
            } else {
                    echo 'email verification pending';
            	}
            } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
				$message = $e->getMessage();
				// Session::flash('success', $message);
				Session::put('message', $message);
				return redirect('signInForm');
			} catch (\Kreait\Firebase\Exception\InvalidArgumentException $e) {
				$message = $e->getMessage();
				Session::put('message', $message);
				return redirect('signInForm');
			} catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
				$message = $e->getMessage();
				// Session::flash('success', $message);
				Session::put('message', $message);
				return redirect('signInForm');
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
		$blockedBy = array();
		// dd($authRef); //This is unique id of inserted user.
		$user =$this->db->collection('backend_users')->newDocument();
		$user->set([
			'email'=>$authRef->email,
			'firstName'=>$request->firstName,
			'lastName'=>$request->lastName,
			'nationality'=>$request->country,
			'gender'=>'',
			'blockedBy'=>$blockedBy,
			'userID'=>$authRef->uid,
			'userName'=>$request->userName,
			'bussinerHistory'=>$request->history,
			'profilePictureURL'=>'',

		]);
		


		return redirect('/signInForm');
	} 
	catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
		Session::put('registerMsg','email already exists');
		return redirect('signUpForm');
	}
}

	//=----------------logout---------------

	public function signOut(){
		// dd('sign out');
		// Session::flush();
		// Session::forget('message');
        app('firebase.auth')->signOut();
        // app('firebase.auth')->unAuth();

    }


	//--------------Index------------
	public function index(Request $request){
		// dd(Session::get('uid'));
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
			// 	// dd($project);
            //     print_r('email = '.$project->id());
            //     // dd('location = '.$project->data()['location']);
            //     dd('url = '.$project->data()['picUrl'][0]);

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
		
		// $followers = $this->db->collection('Followers')->where('followedBy','==',Session::get('uid'))->documents();	
        // $followingPosts = array();

		// foreach ($followers as  $follow) {
		// 	if($follow->exists()){
		// 		// dd($follow->data()['following']);
		// 		$following = $follow->data()['following'];
		// 		$followingPost =$this->db->collection('followingPostData')->document($follow->data()['following'])->collection($follow->data()['following'])->where('postForm','==',$follow->data()['following'])->documents();
		// 		array_push($followingPosts,$followingPost);

		// 	}
		// }
		// dd(Session::get('uid'));
		// dd($following);
		// $projects = array();
		// foreach ($followingPosts[0] as $followingPost) {
			
		// 	$project = $this->db->collection('ProjectDetail')->document($followingPost->data()['postId'])->snapshot();
			
		// 	array_push($projects,$project);
			
		// }
		// dd($projects);
		$users = array();
		$projects = $this->db->collection('ProjectDetail')->orderBy('timestamp','desc')->documents();
		
			foreach($projects as $project) {
            	if($project->exists()){
               		$usr = $this->db->collection('backend_users')->document($project->data()['userId'])->snapshot();							
					
					array_push($users,$usr);
					
				}
			}
			
		return view('projects')->with('projects',$projects)
							   ->with('users',$users);
							   

	}

	public function storeProject(Request $request){
		$timestamp = (int) round(now()->format('Uu') / pow(10, 6 - 3));
		// dd($timestamp);
		// dd($request->all());
		$imageLink =array();
		$reportedBy = array();
		$images= $request->image;
		// dd($images);
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
		//  dd($date->formatAsString()); 
		// dd($request->all());

		$projct =$this->db->collection('ProjectDetail')->newDocument();
		$projct->set([
			'contact'=>$request->email,
			'currency'=>$request->currency,
			'location'=>$request->country,
			'picUrl'=>$imageLink,
			'postId'=>$timestamp,
			'projectdes'=>$request->description,
			'projectstatus'=>"active",
			'projecttype'=>$request->title,
			'remainbudget'=>$request->remainingbudget,
			'reportedBy'=>$reportedBy,
			'totalbudget'=>$request->totalbudget,
			'userId'=>$id,
			'timestamp'=>$date,

		]);
		$project = $this->db->collection('ProjectDetail')->document($projct->id())->snapshot();
		// dd($project->id());
		$this->index->saveObject(
			[
				'objectID' => $project->id(),
				'contact'=>$project->data()['contact'],
				'currency'=>$project->data()['currency'],
				'location'=>$project->data()['location'],
				'picUrl'=>$project->data()['picUrl'],
				'postId'=>$project->data()['postId'],
				'projectdes'=>$project->data()['projectdes'],
				'projectstatus'=>$project->data()['projectstatus'],
				'projecttype'=>$project->data()['projecttype'],
				'remainbudget'=>$project->data()['remainbudget'],
				'reportedBy'=>$project->data()['reportedBy'],
				'totalbudget'=>$project->data()['totalbudget'],
				'userId'=>$project->data()['userId'],
				'timestamp'=>$project->data()['timestamp'],
			  ],
			);
	  //	// $this->index->saveObjects(
		// 	  [
		// 		'objectID' => $project->id(),
		// 		'contact'=>$request->email,
		// 		'currency'=>$request->currency,
		// 		'location'=>$request->country,
		// 		'picUrl'=>$imageLink,
		// 		'postId'=>$timestamp,
		// 		'projectdes'=>$request->description,
		// 		'projectstatus'=>"active",
		// 		'projecttype'=>$request->title,
		// 		'remainbudget'=>$request->remainingbudget,
		// 		'reportedBy'=>$reportedBy,
		// 		'totalbudget'=>$request->totalbudget,
		// 		'userId'=>$id,
		// 		'timestamp'=>$date->formatAsString(),
		// 	  ],
		// 	  [
		// 		'autoGenerateObjectIDIfNotExist' => true,
		// 	  ]
	  //	// 	);

		Session::flash('success','New Project Added');

		return redirect()->back();

	}

	//-------------------following-----------
	public function following(){

		$followers = $this->db->collection('Followers')->where('followedBy','==',Session::get('uid'))->documents();	
        $followingPosts = array();

		foreach ($followers as  $follow) {
			if($follow->exists()){
				// dd($follow->data()['following']);
				$following = $follow->data()['following'];
				$followingPost =$this->db->collection('followingPostData')->document($follow->data()['following'])->collection($follow->data()['following'])->orderBy('timestamp','desc')->where('postForm','==',$follow->data()['following'])->documents();
				array_push($followingPosts,$followingPost);

			}
		}
		$projects = array();
		foreach ($followingPosts[0] as $followingPost) {
			
			$project = $this->db->collection('ProjectDetail')->document($followingPost->data()['postId'])->snapshot();
			array_push($projects,$project);
			
		}
		$users = array();

			foreach($projects as $project) {
            	if($project->exists()){
               		$usr = $this->db->collection('backend_users')->document($project->data()['userId'])->snapshot();							
					
					array_push($users,$usr);
					
				}
			}
		
		// dd($projects);
		return view('following')->with('projects',$projects)
								->with('users',$users);
	}
	
	//----------------------add project------------
	public function addProject(){
		return view('addProject');
	}


	public function followUser($id){
		$timestamp = (int) round(now()->format('Uu') / pow(10, 6 - 3));
		// dd($timestamp);
		// dd($id);
		//follow user
		$follow =$this->db->collection('Followers')->newDocument();
		$follow->set([
			'followedBy'=>Session::get('uid'),
			'following'=>$id,
		]);
		//get user posts
		$projects = $this->db->collection('ProjectDetail')->where('userId','==',$id)->documents();
		// dd($projects);
		foreach ($projects as  $project) {
			if($project->exists()){
				// dd($project->data()['userId']);
				$followingPost =$this->db->collection('followingPostData')->document($id)->collection($id)->newDocument();
				$followingPost->set([
					'postForm'=>$project->data()['userId'],
					'postId'=>$project->id(),
					'timestamp'=>$project->data()['timestamp']
				]);

			}
		}
		
		Session::flash('success','your are follow this User');
		return redirect()->back();


	}
	// public function followUser($id){
	// 	$follow =$this->db->collection('Followers')->newDocument();
	// 	$follow->set([
	// 		'followedBy'=>Session::get('uid'),
	// 		'following'=>$id,
	// 	]);

	// 	Session::flash('success','your are follow this User');
	// 	return redirect()->back();
	// }

	
	// public function search(Request $request){
	// 	$users = array();
	// 	$projects = $this->db->collection('ProjectDetail')->orderBy('projecttype')->startAt($request->search)->endAt($request->search+'\uf8ff')->documents();
		
	// 		foreach($projects as $project) {
    //         	if($project->exists()){
    //            		$usr = $this->db->collection('backend_users')->document($project->data()['userId'])->snapshot();							
					
	// 				array_push($users,$usr);
					
	// 			}
	// 		}
			
	// 	return view('Projects')->with('projects',$projects)
	// 						   ->with('users',$users);
	// }

	

	public function addIndex(){
		$projects = $this->db->collection('ProjectDetail')->documents();
		// dd($projects);
		// print_r('Total records: '.$projects->size());

            foreach($projects as $project) {
            if($project->exists()){
				// dd($project);
                // print_r('email = '.$project->id());
                // // dd('location = '.$project->data()['location']);
				// dd('url = '.$project->data()['picUrl'][0]);
				
				$this->index->saveObject(
					[
						'objectID' => $project->id(),
						'contact'=>$project->data()['contact'],
						'currency'=>$project->data()['currency'],
						'location'=>$project->data()['location'],
						'picUrl'=>$project->data()['picUrl'],
						'postId'=>$project->data()['postId'],
						'projectdes'=>$project->data()['projectdes'],
						'projectstatus'=>$project->data()['projectstatus'],
						'projecttype'=>$project->data()['projecttype'],
						'remainbudget'=>$project->data()['remainbudget'],
						'reportedBy'=>$project->data()['reportedBy'],
						'totalbudget'=>$project->data()['totalbudget'],
						'userId'=>$project->data()['userId'],
						'timestamp'=>$project->data()['timestamp'],
					  ],
				  );

          	  }
        	}
		  

		  print_r('data added');
	}


	//-------------------dashboard section-------------


	public function save_image(Request $request) {
		$user = new User;   
	   if ($request->hasFile('picture')) {
		   $completeFileName = $request->file('picture')->getClientOriginalName();
		   $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
		   $extension = $request->file('picture')->getClientOriginalExtension();
		   $compPic = str_replace(' ', '_', $fileNameOnly).'-'. rand() .'_'.time().'.'.$extension;
		   $path = $request->file('picture')->storeAs('public/users', $compPic);
		   $user->picture = 'users/'.$compPic;
	   }
	   if($user->save()){
		   echo 200;
	   }else{
		   echo 700;
	   }
   }

	


}