<?php

namespace App\Http\Controllers;


use Exception;
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

        try {
            $grid = new Grid();
            foreach ($directionList as $_direction) {
                $grid->move($_direction);
            }
        } catch (Exception $exception) {
            Log::debug($exception->getMessage(), ['request' => $request->toArray()]);
            return response()->json([
                'error' => 'Unable to move to boundary or beyond',
                'input_sequence' => $request->input('command_sequence'),
                'robot_location' => $grid->getLocation()
            ], 400);
        }

        return response()->json([
            'input_sequence' => $request->input('command_sequence'),
            'robot_location' => $grid->getLocation()
        ]);
    }

}
