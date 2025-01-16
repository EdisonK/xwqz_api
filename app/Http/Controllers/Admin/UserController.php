<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UserController extends BaseController
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
//        $users = User::all();
//        return $this->response->collection($users, new UserTransformer());
        $name = $request->input('name');
        $email = $request->input('email');

        $users = User::when($name,function ($query) use ($name){
            $query->where('name','like',"%$name%");
        })->when($email,function ($query) use ($email){
            $query->where('email',$email);
        })->paginate(2);
//        return $this->response->paginator($users, new UserTransformer());
        return $this->successWithData($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
//        return $this->response->item($user, new UserTransformer());
        return $this->successWithData($user);
    }


    public function lock(User $user)
    {
        $user->is_locked = $user->is_locked == 0 ? 1 : 0;
        $user->save();
        return $this->successWithData($user);



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
