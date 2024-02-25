<?php

namespace Lyka\Robot;

use Lyka\Robot\Enums\Direction;

class DirectionService
{

    /**
     * @param string $command_sequence
     * @return array
     */
    public function convertCommandSequenceToDirection(string $command_sequence): array
    {
        $input_array = explode(' ', $command_sequence);
        $output_array = [];
        foreach ($input_array as $_input) {
            switch ($_input) {
                case Direction::NORTH->value:
                    $output_array[] = Direction::NORTH;
                    break;
                case Direction::EAST->value:
                    $output_array[] = Direction::EAST;
                    break;
                case Direction::WEST->value:
                    $output_array[] = Direction::WEST;
                    break;
                case Direction::SOUTH->value:
                    $output_array[] = Direction::SOUTH;
                    break;
            }
        }
        return $output_array;
    }

}
