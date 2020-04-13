<?php

namespace App\Http\Controllers;

use App\Actions\UnfollowUserAction;
use App\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param UnfollowUserAction $unfollowUserAction
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\UnfollowUserNotFoundException
     */
    public function destroy($id, UnfollowUserAction $unfollowUserAction)
    {
        $following = User::findOrFail($id);
        $unfollowUserAction->execute(\request()->user(), $following);
        return response()->json(['message' => 'success']);
    }
}
