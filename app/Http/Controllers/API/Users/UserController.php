<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Resources\USERResource;
use App\Http\Resources\RolesResource;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $this->authorize('view_users_content', User::class);
        $users = User::all();
        return response([ 'users' => USERResource::collection($users), 'message' => 'Retrieved successfully'], 200);
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('create user', User::class);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'roles' => 'required|string'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => 0,
            'active' => 1
        ]);
        $role = Role::findByName($request->roles ,'web');
        $user->assignRole($role);
        $user->save();

        
    //    $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
    //     Storage::put('avatars/'.$user->id.'/avatar.png',(string) $avatar);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);

       // return response([ 'offices' => new BirouResource($offices), 'message' => 'Created successfully'], 200);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BIROU  $bIROU
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      
            return response([ 'User' => new USERResource($user), 'message' => 'Retrieved successfully'], 200); 
    
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $bIROU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        $user->syncRoles($request->roles);

        return response([ 'user' => new USERResource($user), 'message' => 'Retrieved successfully'], 200);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BIROU  $bIROU
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(['message' => 'Deleted']);
    }


    public function roles()
    {
        $all_roles_in_database = Role::all();//->pluck('id','name');
            return response([ 'Roles' => RolesResource::collection($all_roles_in_database), 'message' => 'RolesList retrieved successfully'], 200); 
    }
}
