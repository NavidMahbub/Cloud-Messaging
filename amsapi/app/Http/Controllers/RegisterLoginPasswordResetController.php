<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Contact;
use Sentinel;
use Activation;
use Mail;
use Reminder;
use Auth;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException; 
use DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Passport;
use Cartalyst\Sentinel\Reminders\EloquentReminder;

class RegisterLoginPasswordResetController extends Controller
{
    public function register(Request $request)
    {
    	try{
    		$request->validate([
	            'name' => ['required', 'string', 'max:255'],
	            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	            'password' => ['required', 'string', 'min:6'],
	        ]);

	    	$user = Sentinel::register($request->all()+['type' => 5]);

            $role = Sentinel::findRoleById(2);
            $role->users()->attach($user);

            $contact = new Contact;
            $contact -> user_id = $user->id;
            // $contact -> district_id = 1;
            // $contact -> subdistrict_id = 1;
            $contact -> created_by = $user->id;
            $contact -> updated_by = $user->id;
            $contact->save();
	        $activation = Activation::create($user);
	        $this->sendConfirmationEmail($user,$activation->code);
	        return response()->json(['success'=>'Please Verify Your Email'],200);
    	}
    	catch (ValidationException $e) {
         	return response()->json(['error'=>"The Email is Already Used"],400);
     	}
    	catch (QueryException $e) {
         	return response()->json(['error'=>'The Email is Already Used'],400);
     	}
    	
    }

    private function sendConfirmationEmail($user,$code){
        Mail::send('Email.activation',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Activate your account");
        });
    }

    public function activateAccount($email,$activationCode)
    {

        $user = User::whereEmail($email)->first();
        $sentineluser = Sentinel::findById($user->id);
        if(Activation::complete($sentineluser,$activationCode)){
            return redirect('http://admin.rubelgroup.com.bd/login');
        }else
        {
            return "Woops! Something went wrong";
        }
    }

    public function login(Request $request)
    {
     
        try{
            if (preg_match('/^[0-9]{11}+$/', $request->email)) {
                $user = User::where('mobile_number',$request->email)->first();
                if(\Hash::check($request['password'],$user->password)){
                    $tokenResult = $user->createToken('Password Access Token');
                    $token = $tokenResult->token;
                    $token->save();
                    return response()->json([
                        'access_token' => $tokenResult->accessToken,
                        'expires_at'   =>  $tokenResult->token->expires_at,
                        'token_type'   => 'Bearer',
                        'user'      => $user,
                        'userinfo' =>$user->userinfo,
                    ]);
                }
                else{
                    return response()->json(['error'=>'Credential Not Match'],400);
                }
            }else{
                if(Sentinel::authenticate(array(
                    'email'    => $request->email,
                    'password' => $request->password,
                ))){
                    $user = User::whereEmail($request->email)->first();
                    $tokenResult = $user->createToken('Password Access Token');
                    $token = $tokenResult->token;
                    $token->save();
                    // $role_user = DB::table('role_users')->where('user_id',$user->id)->get();
                    // $role = DB::table('roles')->where('id',$role_user[0]->role_id)->get();
                    return response()->json([
                        'access_token' => $tokenResult->accessToken,
                        'expires_at'   =>  $tokenResult->token->expires_at,
                        'token_type'   => 'Bearer',
                        'user'      => $user,
                        'userinfo' =>$user->userinfo,
                        //'permission'   => json_decode($role[0]->permissions2)
                    ]);
                }
                else{
                    return response()->json(['error'=>'Credential Not Match'],400);
                }
            }
            
        }
        catch(ThrottlingException $e){
            $delay = $e->getDelay();
            return response()->json(['error'=>"You Are Suspend for $delay Second"],400);
        }
        catch(NotActivatedException $e){
            return response()->json(['error'=>'Your Account Is Not Activated'],400);
        }
    }

    public function forgotPassword(Request $request)
    {
        try{
            if (preg_match('/^[0-9]{11}+$/', $request->email)) {
                
                $user = User::where('mobile_number', $request->email)->first();
                if($user) {
                   
                    $sentineluser = Sentinel::findById($user->id); 
                    //if (Reminder::exists($sentineluser)) {
                        $reminder = new EloquentReminder;
                        $reminder->code = rand(100000,999999);
                        $reminder->completed = false;
                        $reminder->user_id = $user->id;
                        $reminder->save();
                        $code = $this->sendResetCode($user,$reminder->code);
                        // return "ss";
                        return response()->json(['success'=>'Code sent to your mobile', 'user_mobile_no' => $user->mobile_number],200);
                   //}
                    return response()->json(['success'=>'Please Reset Your Password'],200);
                } else {
                    return response()->json(['error'=>'No user found'],400);
                }
            }
            else {

                $request->validate([
                    'email' => ['required', 'string', 'email', 'max:255'],
                ]);

                $user = User::whereEmail($request->email)->first();
                if($user) {
                    $sentineluser = Sentinel::findById($user->id);
                    $reminder = Reminder::exists($sentineluser) ? : Reminder::create($sentineluser);
                    $this->sendResetEmail($user,$reminder->code);
                    return response()->json(['success'=>'Please Reset Your Password'],200);
                } else {
                    return response()->json(['error'=>'No user found'],400);
                }
            } 
            
        }
        catch (ValidationException $e) {
            return response()->json(['error'=>"The email is not valid"],400);
        }
        catch (QueryException $e) {
            return response()->json(['error'=>'The email is not valid'],400);
        }
    }

    private function sendResetEmail($user,$code){
        Mail::send('Email.forgot_password',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Reset your account");
        });
    }

    private function sendResetCode($user,$code) {
        $message = urlencode("Password Reset Code: " . $code);
        $sms_info = "http://api.bulksms.icombd.com/api/v3/sendsms/plain?user=beman-tech&password=Bemantech2019&sender=RUBELG&SMSText=" . $message . "&GSM=88" . $user->mobile_number;
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL,$sms_info);
        // Execute
        $result=curl_exec($ch);
        // Closing
        curl_close($ch);

        $send_code = json_decode($result, true);
        return $send_code;
    }

    public function postResetPassword(Request $request,$email,$code)
    {
        //return $request;
        if (preg_match('/^[0-9]{11}+$/', $request->email)) {
            $user = User::where('mobile_number',$request->email)->first();
        }else{
            $user = User::whereEmail($email)->first();
        }
       
        $sentineluser = Sentinel::findById($user->id);

        if($reminder = Reminder::exists($sentineluser)){
            if($code == $reminder->code){
                Reminder::complete($sentineluser,$code,$request->password);
                return response()->json(['success'=>'Password Change Successfully'],200);
            }
            else
            {
                return response()->json(['error'=>'Sorry! The request is not valid'],400);
            }
        }
        else
        {
            return response()->json(['error'=>'Sorry! The request is not valid'],400);
        }
    }

    

    public function checkSMSCode(Request $request) 
    {
        $number = $request->mobile;
        $code = $request->code;
        $user = User::where('mobile_number',$request->mobile)->first();
        
        $exist_user = Reminder::where('user_id',$user->id)->where('code',$code)->first();
        if($exist_user) {
            return response()->json([
                // 'url' => "http://admin.rubelgroup.com.bd/reset-password/$number/$code"
                'url' => "http://localhost:8080/reset-password/$number/$code"
            ]);
        }
        else{
            return response()->json([
                'url' => "Wrong Code"
            ]);
        }
    }
}
