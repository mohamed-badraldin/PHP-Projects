<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\traits\generalTrait;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use generalTrait;
    public function register(Request $request)
    {
        // validate
        $rules = [
            'name' => ['required', 'string', 'min:2'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            'gender' => ['required', 'string', 'max:1']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        // insert data in DB
        $data = $request->except('password');
        $data['password'] = Hash::make($request->password);
        // return $data;
        User::create($data);

        //generate token using JWT
        $credentials = $request->only('email', 'password');
        $token = 'bearer '.auth('api')->attempt($credentials);
        $user = auth('api')->user();
        return $this->returnUserWithToken($user, $token);
    }

    public function sendCode(Request $request)
    {
        // user data
        $user = auth('api')->user();
        //generate code
        $code = rand(10000,99999);
        // save code in db
        $userDB = User::find($user->id);
        $userDB->code = $code;
        $userDB->save();
        // send mail

        //return response
        $token = $request->header('Authorization') ;
        return $this->returnUserWithToken($userDB, $token);

    }

    public function verifyCode(Request $request)
    {
        // validate on code
        $rules = [
            'code' => ['required','integer', 'digits:5', 'exists:users'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        // get user from token
        $user = auth('api')->user();
        // query to check on code
        $userDB = User::where([['id','=',$user->id],['code','=',$request->code]])->first();
        if($userDB){
            // if code == correct => update email_verified_at
            $userDB->email_verified_at = date('Y-m-d H:i:s');
            $userDB->save();

            // response user data with token
            $token = $request->header('Authorization');
            return $this->returnUserWithToken($userDB, $token);

        }else{
            // else return response with error
           return  $this->returnErrorMessage(null,"Wrong Verifcation Code",403);
        }
    }

    public function userProfile(Request $request)
    {
        $user = auth('api')->user();
        $userDB = User::find($user->id);
        $token = $request->header('Authorization');
        return $this->returnUserWithToken($userDB, $token);
    }
    // updateProfile
    public function updateProfile(Request $request)
    {
        // validate
        $rules = [
            'name' => ['required', 'string', 'min:2'],
            'phone' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'image' => ['nullable', 'image','mimes:png,jpg,jpeg','max:1000'],
            'gender' => ['required', 'string', 'max:1']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        //get user from token
        $user = auth('api')->user();
        $data = $request->except('image');
        //upload photo
        if($request->has('image')){
            $fileName = $this->uploadPhoto($request->image,'users');
            $data['image'] = $fileName;
        }

        //update data
        $check = User::where('id',$user->id)->update($data);
        $userDB = User::find($user->id);
        $token = $request->header('Authorization');

        if($check)
            return $this->returnUserWithToken($userDB, $token);
        else
            return $this->returnErrorMessage(null,"SomeThing Went Wrong",500);

    }

    // login
    public function login(Request $request)
    {
        // validate
        $rules = [
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        // check if not username or password is correct
        if (! $token = auth('api')->attempt($request->all())) {
            return $this->returnErrorMessage(null,"Unauthorized User",401);
        }

        $user = auth('api')->user();
        // check on user verfication
        if(!$user->email_verified_at)
            return $this->returnUserWithToken($user,'bearer '.$token,"User Not Verifed",401);
        return $this->returnUserWithToken($user,'bearer '.$token);
        // return response with req data

    }

    // logout
    public function logout()
    {
        auth('api')->logout();
        return $this->returnSuccessMessage("You Have Logged Out Successfully");
    }

}
