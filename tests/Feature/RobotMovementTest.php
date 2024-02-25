<?php

namespace Feature;

use Tests\TestCase;

/*
 * Feature test creates the application and will have access to the post.
 * Testing Robot API response
 * */

class RobotMovementTest extends TestCase
{

    public function test_user_can_access_api()
    {
        $response = $this->post('api/robot/move', ['command_sequence' => 'N E S W']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'requested_command_sequence'
        ]);
    }

    /**
     * @dataProvider providerWrongCommandSequence
     * @return void
     */
    public function test_command_sequence_validation($sequence)
    {
//        $this->expectException(Exception::class);
//        $this->expectExceptionMessage('Validation Failed');
        $response = $this->post('api/robot/move', ['command_sequence' => $sequence]);
        $response->assertStatus(400);
        $response->assertJsonStructure([
            'error'
        ]);

    }

    /**
     * @dataProvider providerRightCommandSequence
     * @return void
     */
    public function test_command_sequence_move($sequence, $output)
    {
        $response = $this->post('api/robot/move', ['command_sequence' => $sequence]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'input_sequence',
            'robot_location'
        ]);
        $response_data = $response->getOriginalContent();
        $this->assertEquals($sequence, $response_data['input_sequence']);
        $this->assertEquals($output, $response_data['robot_location']);
    }

    /**
     * @return array[]
     */
    public static function providerWrongCommandSequence(): array
    {

        return [
            'command_sequences' => [
                'T E S T',
                'N E S  W',
            ]
        ];

    }

    /**
     * @return array[]
     */
    public static function providerRightCommandSequence(): array
    {

        return [
            ['N N N N E E E E', [5, 5]],
            ['N E N E N E N E', [5, 5]],
            ['N N N N E E E E W', [4, 5]],
            ['N N N N E E E E W', [4, 5]],
        ];

    }

}
