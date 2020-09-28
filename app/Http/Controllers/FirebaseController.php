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
use Mail;
class FirebaseController extends Controller
{
    // protected $db;
    // protected $name;
    // public function __construct(){
    //      $this->db=new FirestoreClient([
    //          'projectId'=>'test-project-7115d'
    //          ]);   
    //       $this->name="country";   
    // }
    // public function getDocument(){
    //     return $this->db->collection($this->name)->document("pakistan")->snapshot()->data();
    // }
    //: if false
    protected $db;
    public function __construct() {
        $this->db = app('firebase.firestore')->database();
    }
    public function test(Request $request){

        // $doc=$this->db->collection('country');
        // $query=$doc;
        // if(isset($request->search))
        //     $query = $doc->where('name', '=', $request->search);

        // $documents = $query->documents();
        // foreach ($documents as $document) {
        //     if ($document->exists()) {
        //         printf('Document data for document %s:' . PHP_EOL, $document->id());
        //         echo implode(" ",$document->data());
        //         printf(PHP_EOL);
        //     } else {
        //         printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
        //     }
        // }

       $ref= $this->db->collection('country')->newDocument();
        $ref->set([
            'name'=>'firebase test',
            'email'=>'firebase@gmail.com'
        ]);
        print('data added');
        // $ref= $this->db->collection('country')->document('currency');
        // $ref->set([
        //     'rate'=>'162.5',
        //     'code'=>'pkr'
        // ]);    

    }
    public function getData(){
        $country = $this->db->collection('country')->documents();

            print_r('Total records: '.$country->size());

            foreach($country as $cunt) {
            if($cunt->exists()){
                print_r('email = '.$cunt->id());
                print_r('name = '.$cunt->data()['name']);
                print_r('email = '.$cunt->data()['email']);

            }
            
        }
    }
    public function signUp(){
                try {
                    $email = 'raisaeedanwar1187@gmail.com';
                    $password = 'saeed123';
                    $authRef = app('firebase.auth')->createUser([
                        'email' => $email,
                        'password' => $password
                ]);
            
                $actionCodeSettings = [
                        'continueUrl' => 'http://localhost:8000/'
                ];
            
                app('firebase.auth')->sendEmailVerificationLink($email, $actionCodeSettings);
            
                echo $authRef->uid; //This is unique id of inserted user.
            
                // $userData=$this->db->collection('userDetail')->newDocument();
                // $userData->set([
                //     'uid'=>$authRef->uid,
                //     'name'=>'Humair Anwar',
                //     'address'=>'sargodha'
                // ]);

                // echo 'data added';

            } 
            catch (\Kreait\Firebase\Exception\Auth\EmailExists $ex) {
            echo 'email already exists';
            }
    }

    public function signIn(){
        try {
            $email = 'raisaeedanwar1187@gmail.com';
            $password = 'saeed123';
            // $user = app('firebase.auth')->verifyPassword($email,$password);
            $auth=app('firebase.auth');
            $user= $auth->signInWithEmailAndPassword($email,$password);
            // $user=$auth->onAuthStateChanged();
            // dd($user->data()['localId']);
            if($user) {
                     echo 'login success';
                     \Session::put('uid', $user->data()['localId']);
            } else {
                    echo 'email verification pending';
            }
            } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $ex) {
                echo 'Invalid password';
            }
    
    }
    public function signOut(){
        // dd('sign out');
        app('firebase.auth')->signOut();
        // app('firebase.auth')->unAuth();

    }

    public function varifyEmail(Request $request){

         return view('admin.varifyEmail');
        dd($request->all());
        

            // return view('admin.varifyEmail');
       // dd('varifyEmail');
    }
    public function varifyForm(Request $request){
        // dd($request->all());
        $link = app('firebase.auth')->getEmailVerificationLink($request->email);

        $data['link'] = $link;
        Mail::send('email-verification', compact('data'),
                    function ($m) {
                $m->to('raisaeedanwar1187@gmail.com', 'Saeed Anwar')
                        ->subject('Email Verification');
            });
            return view('admin.varifyEmail');
    }

    public function index(){

       $country= 'pakistan';
        $currency='pakistani Rupee';
        $flag='pakistani';
        $symbol='Rs';
        $code='PKR';
        $selling='157.3';
        $buying ='156.4';

        $firebase = (new Factory())
    ->withDatabaseUri('https://test-project-7115d.firebaseio.com')->createDatabase();

    $ref= $firebase->getReference('Currency')
    ->push([
        'country'=>$country,
        'currency'=>$currency,
        'flag'=>$flag,
        'symbol'=>$symbol,
        'code'=>$code,
        'selling rate'=>$selling,
        'buying rate'=>$buying
    ]);

    Session::flash('success','Data Store Successfully');
    return redirect()->route('profile');
    }


}
