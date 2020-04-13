<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class UnfollowUserNotFoundException extends Exception
{
    public function render()
    {
        return response(['message' => 'Cannot unfollow user you are not following.'], Response::HTTP_NOT_FOUND);
    }
}
