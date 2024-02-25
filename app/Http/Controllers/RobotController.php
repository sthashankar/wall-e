<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Log;
use Lyka\Robot\DirectionService;
use Lyka\Robot\Grid;
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

        $directionService = new DirectionService();
        $directionList = $directionService->convertCommandSequenceToDirection($request->input('command_sequence'));

        $grid = new Grid();
        foreach ($directionList as $_direction) {
            $grid->move($_direction);
        }
        return response()->json([
            'input_sequence' => $request->input('command_sequence'),
            'robot_location' => $grid->getLocation()
        ]);
    }

}
