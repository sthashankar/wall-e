<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class RobotController extends Controller
{

    public function moveAction(Request $request)
    {
        return response()->json(['requested_command_sequence' => $request->input('command_sequence')]);
    }

}
