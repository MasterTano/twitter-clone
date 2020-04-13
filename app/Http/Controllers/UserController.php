<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use App\Actions\CreateUserAction;

class UserController extends Controller
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
     * @param \App\Http\Requests\UserStoreRequest $request
     * @param CreateUserAction $createUserAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request, CreateUserAction $createUserAction)
    {
        $createUserAction->execute($request->all());
        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
