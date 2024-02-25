<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Log;
use Validator;

class RobotController extends Controller
{

    public function moveAction(Request $request)
    {
        $validate = Validator::make($request->toArray(), [
            'command_sequence' => ['required', 'string', 'regex:/^[NESW\s]+$/u']
        ]);
        if ($validate->fails()) {
            $message = json_decode($validate->messages(), true);
            Log::info('Validator Failed for move action', $message);
            return response()->json(['error' => $message], 400);
        }
        return response()->json(['requested_command_sequence' => $request->input('command_sequence')]);
    }

}
