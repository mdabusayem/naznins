<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Image;
use App\User;
use App\Customer;

use App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //$customer=DB::table('customers')->orderBy('id','DESC')->get();
     // $token = JWTAuth::getToken();
        $customer= $this->jwt->User();
        return response()->json($customer);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
             'name' => 'required|max:255',
             'address' => 'required',
             'phone' => 'required|unique:customers',
         ]);
        //$user = User::first();
        //$token = JWTAuth::fromUser($user);
        //$customer->userid  = $token->id;
     /*    try {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json(['token_expired'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent'], $e->getStatusCode());
    }

    $userId = $user->id;
    */
    $user = Auth::guard('api')->user();

            if($request->photo){
                   $position = strpos($request->photo, ';');
                   $sub=substr($request->photo, 0 ,$position);
                   $ext=explode('/', $sub)[1];
                   $name=time().".".$ext;
                   $img=Image::make($request->photo)->resize(240,200);
                   $upload_path='backend/customer/';
                   $image_url=$upload_path.$name;
                   $img->save($image_url);

                   $customer = new Customer;
                   $customer->name = $request->name;
                   $customer->email = $request->email;
                   $customer->phone = $request->phone;
                   $customer->address = $request->address;
                   $customer->photo =  $image_url;
                   $customer->userid  = $user->name;
                   $customer->save();
            }else{
                   $customer = new Customer;
                   $customer->name = $request->name;
                   $customer->email = $request->email;
                   $customer->phone = $request->phone;
                   $customer->address = $request->address;
                   $customer->userid  = $user;
                   $customer->save();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer=DB::table('customers')->where('id',$id)->first();
        return response()->json($customer);
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
        $validatedData = $request->validate([
             'name' => 'required|max:255',
             'address' => 'required',
             'phone' => 'required',
        ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $image=$request->newphoto;
      if ($image) {
           $position = strpos($image, ';');
           $sub=substr($image, 0 ,$position);
           $ext=explode('/', $sub)[1];
           $name=time().".".$ext;
           $img=Image::make($image)->resize(240,200);
           $upload_path='backend/customer/';
           $image_url=$upload_path.$name;
           $success=$img->save($image_url);
       if  ($success) {
             $data['photo']=$image_url;
             $img=DB::table('customers')->where('id',$id)->first();
             $image_path = $img->photo;
             $done=unlink($image_path);
             $user=DB::table('customers')->where('id',$id)->update($data); 
           }
       }else{
           $oldlogo=$request->photo;       
           $data['photo']=$oldlogo;  
           DB::table('customers')->where('id',$id)->update($data); 
        
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $customer=DB::table('customers')->where('id',$id)->first();
       $photo=$customer->photo;
       if ($photo) {
          unlink($photo);
          DB::table('customers')->where('id',$id)->delete();
       }else{
          DB::table('customers')->where('id',$id)->delete();
       }
    }
}
