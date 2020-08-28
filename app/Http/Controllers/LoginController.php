<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
class LoginController extends Controller
{

    public function __construct(Request $request){
        $log      = new Log;
        $log->ip  = $request->ip();
        $log->url = url()->full();
        $log->data= json_encode($request->all());      
        $log->save();
    }

    public function index(){
        return view('login/index');
        
    }

    public function loginCheck(Request $request){  
        

        $input      = (object)$request->all();
        $email      = $input->email;
        $password   = $input->password;

        if($email == ''){
            return response()->json(['status'=>false, 'message'=>'* Please email enter...', 'class'=>'error']);
        }

        if($password == ''){
            return response()->json(['status'=>false, 'message'=>'* Please password enter...', 'class'=>'error']);
        }

        $result     = User::where([['email', '=', $email],['password', '=', sha1($password)]])->first();

        if(empty($result)){
            return response()->json(['status'=>false, 'message'=>'* Email or/and password wrong...', 'class'=>'error']);
        }

        return response()->json(['status'=>true, 'message'=>'OK', 'class' => 'success']);
    }
}
