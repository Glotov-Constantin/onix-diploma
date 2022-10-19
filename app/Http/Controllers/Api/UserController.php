<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(Request $request)
    {
        $query = User::query()->select([
            'users.id',
            'users.name',
            'users.email',
            'role',
            'users.created_at',
            'users.updated_at'
        ]);

        return UserResource::collection($query
            ->groupBy('users.id')
            ->paginate(10));
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->role=$request->role;
        $user->save();
        if ($user){
            return response()->json('User created', 200);
        }
        else{
            return response()->json('Created user has been failed');
        }
    }

    public function update(Request $request, User $user)
    {
       $user->name=$request->name;
       $user->email=$request->email;
        $user->password=$request->password;
        $user->role=$request->role;
        $user->save();
        if ($user){
            return response()->json('User updated', 200);
        }
        else{
            return response()->json('Update has been failed');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('The user was deleted', 200);
    }
}
