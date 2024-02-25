<?php

namespace Tests\Unit;

use Exception;
use Lyka\Robot\Enums\Direction;
use Lyka\Robot\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function test_move_east()
    {
        $grid = new Grid();
        $grid = $grid->setCurrentLocation(7, 5)->move(Direction::EAST);
        $this->assertEquals([8, 5], $grid->getLocation());
    }

    public function test_move_west()
    {
        $grid = new Grid();
        $grid->setCurrentLocation(5, 5);
        $grid->move(Direction::WEST);
        $this->assertEquals([4, 5], $grid->getLocation());
    }

    public function test_move_north()
    {
        $grid = new Grid();
        $grid->setCurrentLocation(7, 5);
        $grid->move(Direction::NORTH);
        $this->assertEquals([7, 6], $grid->getLocation());
    }

    public function test_move_south()
    {
        $grid = new Grid();
        $grid->setCurrentLocation(3, 8);
        $grid->move(Direction::SOUTH);
        $this->assertEquals([3, 7], $grid->getLocation());
    }

    public function test_move_N_E_S_W()
    {
        $grid = new Grid();
        $grid->setCurrentLocation(3, 8);
        $grid->move(Direction::NORTH);
        $grid->move(Direction::EAST);
        $grid->move(Direction::SOUTH);
        $grid->move(Direction::WEST);
        $this->assertEquals([3, 8], $grid->getLocation());
    }

    public function test_move_N_E_N_E_N_E_N_E()
    {
        $grid = new Grid();
        $grid->move(Direction::NORTH);
        $grid->move(Direction::EAST);
        $grid->move(Direction::NORTH);
        $grid->move(Direction::EAST);
        $grid->move(Direction::NORTH);
        $grid->move(Direction::EAST);
        $grid->move(Direction::NORTH);
        $grid->move(Direction::EAST);
        $this->assertEquals([5, 5], $grid->getLocation());
    }

    public function test_out_of_border()
    {
        $grid = new Grid();
        $this->expectException(Exception::class);
        $grid->setCurrentLocation(0, 0);
        $grid->move(Direction::WEST);
    }

    /*
     * set as provider
     * */
    /*public function getDirectionDataSet()
    {

    }*/
}
