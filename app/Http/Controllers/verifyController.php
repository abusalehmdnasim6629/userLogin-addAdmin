<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\SendCode;
use Nexmo;
use Session;
session_start();
class verifyController extends Controller
{
    public function userReg(){
        return view('user_register');
    }
   public function saveUser(Request $request){
         if($request->name != null && $request->email!= null && $request->phone != null && $request->password != null ){
         $user = array();
         $user['user_name'] = $request->name;
         $user['user_email'] = $request->email;
         $user['user_phone'] = $request->phone;
         $user['user_password'] = $request->password;
         $result = DB::table('tbl_user')
                 ->where('user_email',$request->email)
                 ->where('user_phone',$request->phone)
                 ->count();
         
        if($result<1){
        DB::table('tbl_user')->insert($user);
        Session::put('saveu','successfully added');
        return Redirect::to('/');
     
        }else{
            Session::put('unsaveu','Already added');
            return Redirect::to('/user-registration');

        }
    }else{
      Session::put('saveuser','please all the blanks properly');
      return Redirect::to('/user-registration');

    }
        

   }




    public function getVerify(){
        return view('user_login');
    }


    public function verification(Request $request){
         
        $match = DB::table('tbl_user')
                ->where('user_phone',$request->phone)
                ->where('user_password',$request->password)
                ->select('tbl_user.*')
                ->first();
       if($match)
        {
            Session::put('user_name',$match->user_name);
            Session::put('user_id',$match->user_id);
            Session::put('user_phone',$match->user_phone);
            Session::put('user_email',$match->user_email);
            return Redirect::to('/user-profile');
            

        }
        else{
            Session::put('invalidlogin','Invalid login !!!!!');
            return Redirect::to('/');

        }
    }

    public function adminReg(){
        return view('admin_register');
    }



    public function saveAdmin(Request $request){
      

        if($request->name != null && $request->email!= null && $request->phone != null && $request->password != null ){
        $admin = array();
        $admin['admin_name'] = $request->name;
        $admin['admin_email'] = $request->email;
        $admin['admin_phone'] = $request->phone;
        $admin['admin_password'] = $request->password;
        $result = DB::table('tbl_admin')
                ->where('admin_email',$request->email)
                ->where('admin_phone',$request->phone)
                ->count();
        
       if($result<1){
            DB::table('tbl_admin')->insert($admin);
            Session::put('savesuccess','Add successfully');
            return Redirect::to('/admin-login');
    
       }else{
           Session::put('saveunsuccess','Already added!!');
           return Redirect::to('/admin-registration');

       }
    }else{
        Session::put('ns','please fill all the blanks');
        return Redirect::to('/admin-registration');
    }
       

  }
  public function adminLogin()
  {
    return view('admin_login');
  }


  
  public function addAdmin($admin_id,$user_id){
    
    $row = DB::table('tbl_add')
    ->where('admin_id',$admin_id)
    ->where('user_id',$user_id)
    ->count();

    if($row<1){

    

     $add = array();
     $add['admin_id']= $admin_id;
     $add['user_id'] = $user_id;

     $result = DB::table('tbl_add')
             ->where('admin_id',$admin_id)
             ->count();
     $add['serial_no'] = $result+1;        
    
     DB::table('tbl_add')
     ->insert($add);

     Session::put('success','Add successfully');
     return Redirect::to('/user-profile');
    }else{
        Session::put('unsuccess','Already added before');
        return Redirect::to('/user-profile');

    }
}
public function adminprofile(){
    return view('admin_profile');
}
public function adminVerification(Request $request){

    if($request->phone!=null && $request->password!=null){

    $match = DB::table('tbl_admin')
    ->where('admin_phone',$request->phone)
    ->where('admin_password',$request->password)
    ->select('tbl_admin.*')
    ->first();
   if($match)
    {
        Session::put('admin_name',$match->admin_name);
        Session::put('admin_id',$match->admin_id);
        Session::put('admin_phone',$match->admin_phone);
        Session::put('admin_email',$match->admin_email);
        return Redirect::to('/admin-profile');
        

    }
    else{
        Session::put('uadlog','phone or password not match, please try again');
        return Redirect::to('/admin-login');
    }
    }else{
        Session::put('adlog','please fill all the blanks properly');
        return Redirect::to('/admin-login');

    }



}

 public function userLogout(){


    Session::flush();
    return Redirect::to('/');

 }
 public function adminLogout(){


    Session::flush();
    return Redirect::to('/admin-login');

 }

    public function userprofile(){
        return view('user_profile');
    }
    // public function postVerify(Request $request){
           
    //        $phone= '01959031119';
    //        $verification = Nexmo::verify()->start([
    //                 'number' => $phone,
    //                 'brand'  => 'phone Verification',

    //        ]);
    //        if($verification){
    //              $code= SendCode::sendCode($phone);
    //            echo $code;
    //        }
    // }
}
