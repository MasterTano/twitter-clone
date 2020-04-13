<?php

namespace App\Http\Controllers;

use App\Actions\FollowUserAction;
use App\Actions\GetFollowerAction;
use App\Follower;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GetFollowerAction $getFollowerAction)
    {
        return response()->json($getFollowerAction->execute(\request()->user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param FollowUserAction $followUserAction
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request, FollowUserAction $followUserAction)
    {
        $followUserAction->execute($request->user(), $request['id']);
        return  response()->json(['message'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Follower $follower
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Follower $follower)
    {
        return response()->json(['message' => 'success']);
    }
}
