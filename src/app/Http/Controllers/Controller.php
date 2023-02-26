<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ResponseWithSuccess($message='', $code=null, $data=null)
    {
        return response()->json([
            'success' => true,
            'message' => decode($message),
            'data'    => $data
        ],$code);
    }

    public function ResponseWithError($message='', $code=null,  $data=null)
    {
        return response()->json([
            'success' => false,
            'message' => decode($message),
            'data'    => $data
        ],$code);
    }
}
