<?php

namespace App\Http\Controllers;

use App\Actions\GetUserTweetAction;
use App\User;
use Illuminate\Http\Request;

class UserTweetController extends Controller
{
    /**
     * @param int $id
     * @param GetUserTweetAction $getUserTweetAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(int $id, GetUserTweetAction $getUserTweetAction)
    {
        return response()->json($getUserTweetAction->execute($id));
    }
}
