<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
/**
 * 
 */
class languagesController extends Controller
{
	
	public function list(){
		$languages=['PHP','C#','ASP.Net','C++','jQuery'];
		return view('language',['lang'=>$languages]);
	}
}