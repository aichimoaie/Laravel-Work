<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Notifications\SignupActivate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;



class AuthController extends Controller
{
    public function register(Request $request)
    {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:55',
    //         'email' => 'email|string|required|unique:users',
    //         'password' => 'required|string|confirmed'
    //     ]);

    //     $validatedData['password'] = bcrypt($request->password);

    //     $user = User::create($validatedData);

    //     $accessToken = $user->createToken('authToken')->accessToken;

    //     return response([ 'user' => $user, 'access_token' => $accessToken, 'message' => 'Register successfully'], 201);
    // 
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed'
    ]);

    $user = new User([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'activation_token' => Str::random(60)
    ]);
    $user->save();

    
   //$avatar = Avatar::create($user->name)->getImageObject()->encode('png');
  //  Storage::put('avatars/'.$user->id.'/avatar.png',(string) $avatar);
    //pentru moment 
  //  $user->notify(new SignupActivate($user));

    return response()->json([
        'message' => 'Successfully created user!'
    ], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);

        // if (!auth()->attempt($loginData)) {
        //     return response(['message' => 'Invalid Credentials']);
        // }

        // $accessToken = auth()->user()->createToken('authToken')->accessToken;

        // return response(['user' => auth()->user(), 'access_token' => $accessToken, 'message' => 'Login successfully'], 200);
        $credential = request(['email','password']);
        // $credential['active']=1;
        $credential['deleted_at']=null;

        if(!Auth::attempt($credential)){
            return response()->json([
                'message'=> 'Unauthorized'
            ], 401);
        }
        else{
            $user=$request->user();
            $tokenResult = $user->createToken('Personal Acces Token');
            $token = $tokenResult->token;
            if($request->remeber_me){
                $token->expires_at=Carbon::now()->addWeeks(1);
            }
            $token->save();
            return response()->json([
                'message' => 'Successfully logged in',
                'email' => $user->email,
                'access_token' => $tokenResult->accessToken,
                'role' => $user->getRoleNames()->implode('roles', ', '),
                'permisions' => explode(', ', $user->getAllPermissions()->implode('name', ', ')),
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at)->toDateTimeString()
                ], 200);
        }
    }

    public function signupActivate($token){
        $user = User::where('activation_token', $token)->first();

        if(!$user){
            return response()->json([
                'message' => 'This activation token is invalid. '
            ], 404);
        }

        $user->active=true;
        $user->activation_token = '';
        $user->email_verified_at=date("Y-m-d H:i:s");
        $user->save();
        return response()->json([
            'message' => 'Successfuly created user',
            'user' =>  $user        
        ], 201);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request){
        return response()->json($request->user());
    }
}
