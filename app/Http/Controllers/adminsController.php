<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\adminsModel;

class adminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fetched_data = test::get();
        
        foreach ($fetched_data  as $d) {
            $d->start_date = date('d/m/y', $d->start_date) ;
            $d->end_date = date('d/m/y', $d->end_date);
        }
        $data = ["data"=>$fetched_data];
        return view('admins.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  $this->validate($req,[
            "title"       => "required|string",
            "description" => "required",
            "start_date"  => "required|date",
            "end_date"    => "required|date",
            "image"       => "required|mimes:jpeg,png,jpg",
            


           ]);
         # image 
         $img = $req->file('image');
         $new_name = rand().'.'.$img->getClientOriginalExtension();
         $img->move(public_path('images'),$new_name);
         $data['image'] = $new_name;  
         #date operation
         $data['start_date'] = strtotime($data['start_date']);
         $data['end_date'] = strtotime($data['end_date']);
         # Store Data   
          $op = test::create($data); 

         if($op){

            $message = "test Created";

         }else{

            $message = "Error Try Again";
        }
  
        # Set Message To Session .... 
        session()->flash('Message',$message);
        
        return redirect(url('/admins'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $op = users::where('id',$id)->delete();
    }
}
