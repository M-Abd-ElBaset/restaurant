<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\HttpResponses;

class UsersController extends Controller
{
    use HttpResponses;

    public function login(UserLoginRequest $request) : string{
        $request->validated($request->all());

        if(!Auth::attempt($request->only('email','password'))){
            return $this->error('', 401, "Invalid Credentials");
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('Token of '. $user->name);

        return $this->success([
            'user'=>$user,
            'token'=>$token->plainTextToken
        ]);
    }

    public function register(UserStoreRequest $request) : string{
        $request->validated($request->all());
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'birth_date'=>$request->birth_date,
            'phone_number'=>$request->phone_number,
            'password'=>Hash::make($request->password),
        ]);

        $token = $user->createToken('Token of '. $user->name);

        return $this->success([
            'user'=>$user,
            'token'=>$token->plainTextToken
        ]);
    }

    public function logout() : string{
        auth('sanctum')->user()->currentAccessToken()->delete();
        return $this->success('', 200, "You successfully logged out. Thank You");
    }


    public function index()
    {
        return UsersResource::collection(
            User::all()
        );
    }

    public function store(UserStoreRequest $request) : UsersResource
    {
        $request->validated($request->all());

        $data = $request->all();
        $user = User::create($data);

        return new UsersResource($user);
    }

    public function show(User $user) : UsersResource
    {
        return new UsersResource($user);
    }

    public function update(Request $request, User $user) : UsersResource
    {
        $user->update($request->all());
        return new UsersResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->success("", 200, "User has been deleted successfully");
    }
}
