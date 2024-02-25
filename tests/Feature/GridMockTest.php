<?php

namespace Tests\Feature;

use App;
use Lyka\Robot\Contracts\GridInterface;
use Mockery;
use Tests\TestCase;

class GridMockTest extends TestCase
{

    /**
     * @return void
     */
    public function test_grid_move()
    {
        //Arrange
        $mock = Mockery::mock(GridInterface::class);
        $mock->expects('getLocation')
            ->andReturn('01');

        //Act
        $this->instance(GridInterface::class, $mock);
        $grid = App::make(GridInterface::class);

        //Assert
        $this->assertEquals('01', $grid->getLocation());

    }

}
