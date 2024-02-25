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

}
