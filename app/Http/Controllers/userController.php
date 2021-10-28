<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\studentModel ;

class userController extends Controller
{
    
   public function display(){
      $data =   studentModel::get();
      return view("display",['data' =>$data]);
  
   } 


 public function create(){
    return view("form");

 } 


 public function store( Request $request){
   echo 'post Data';

//   dd($request);
//   echo $request->name;
//   dd( $request->all());
//   dd( $request->except(['name']));
//   dd( $request->only(['name']));
//   dd( $request->has(['name']));
//   dd( $request->method());
 

$data = $this->validate($request,[
"name"    => "required",
"email"   => "required|email",
"password" => "required|min:6",
"linkedin" => "required|url",
"address"  => "required|min:10",
"gender"   => "required",
 ]);
//  dd('Valid Data');

$data['password'] = bcrypt($data['password']);
$op = studentModel::create($data); 
if ($op){
   $message =" Valid Data ";

}else{
   $message =" error try again";

}

session()->flash('message',$message );
return redirect(url('/create'));

 }


 public function edit($id){
    $data = studentModel::where('id' , $id)->get();
    return view ('edit',['data' => $data]);

}


public function update( Request $request){
$data = $this->validate($request,[
"name"    => " required",
"email"   => "required|email",
"password" => "required|min:6",
"linkedin" => "required|url",
"address"  => "required|min:10",
"gender"   => "required",
"id"       => "required",
 ]);

  $op = studentModel::where('id' , $id)->update($data);
 
if ($op){
   $message =" Valid update";

}else{
   $message =" error try again";

}

session()->flash('message',$message );
return redirect(url('/display'));

 }


 public function remove($id){

      studentModel::where('id' , $id)->delete();
      if ($op){
         $message =" Raw Remove";
      
      }else{
         $message =" Error Try Again !!";
      
      }

      session()->flash('message',$message );
      return redirect(url('/display'));
      
 }


 public function getLogin(){
   return view(" login");

} 

public function login(){
   $data = $this->validate($request,[
      "email"   => "required|email",
      "password" => "required|min:6",
      
       ]);

            
      if(auth()->attempt($data)){
         return redirect(url('/display'));

      }else{
         return redirect(url('/login'));



};

} 
public function logOut(){
   auth()->logOut();
   return redirect(url('/login'));

} 


}