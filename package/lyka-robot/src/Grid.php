<?php

namespace Lyka\Robot;

use Exception;
use Lyka\Robot\Contracts\DirectionInterface;
use Lyka\Robot\Contracts\GridInterface;
use Lyka\Robot\Enums\Direction;
use Throwable;

class Grid implements GridInterface, DirectionInterface
{
    private int $xaxis;
    private int $yaxis;
    private array $grid = [];
    private array $current_location = [];

    /**
     * @param int $xaxis
     * @param int $yaxis
     */
    public function __construct(int $xaxis = 10, int $yaxis = 10)
    {
        $this->xaxis = $xaxis;
        $this->yaxis = $yaxis;
        for ($x = 0; $x < $xaxis; $x++) {
            for ($y = 0; $y < $yaxis; $y++) {
                $this->grid[$x][$y] = [$x, $y];
            }
        }
        $this->current_location = $this->grid[1][1];
    }

    /**
     * @param int $x
     * @param int $y
     * @return $this
     * @throws Throwable Unable to set current location.
     */
    public function setCurrentLocation(int $x, int $y): static
    {
        throw_if(
            $x >= $this->xaxis || $x <= 0 || $y >= $this->yaxis || $y <= 0,
            new Exception('Unable to set current location on border or outside of grid')
        );
        $this->current_location = $this->grid[$x][$y];
        return $this;
    }

    /**
     * @param Direction $direction
     * @return $this
     * @throws Throwable Unable to move in boundary.
     */
    public function move(Direction $direction): static
    {
        switch ($direction) {
            case Direction::EAST:
                $coordinate = $this->getEast(...$this->current_location);
                break;
            case Direction::WEST:
                $coordinate = $this->getWest(...$this->current_location);
                break;
            case Direction::NORTH:
                $coordinate = $this->getNorth(...$this->current_location);
                break;
            case Direction::SOUTH:
                $coordinate = $this->getSouth(...$this->current_location);
                break;
        }
        throw_if(
            $coordinate[0] >= $this->xaxis || $coordinate[0] <= 0 || $coordinate[1] >= $this->yaxis || $coordinate[1] <= 0,
            new Exception('Close by/Out of boundary')
        );
        $this->current_location = $this->grid[$coordinate[0]][$coordinate[1]];
        return $this;
    }

    /**
     * @return array
     */
    public function getLocation(): array
    {
        return $this->current_location;
    }

    /**
     * @param int $x
     * @param int $y
     * @return int[]
     */
    public function getEast(int $x, int $y)
    {
        return [$x + 1, $y];
    }

    /**
     * @param int $x
     * @param int $y
     * @return int[]
     */
    public function getWest(int $x, int $y)
    {
        return [$x - 1, $y];
    }

    /**
     * @param int $x
     * @param int $y
     * @return int[]
     */
    public function getNorth(int $x, int $y)
    {
        return [$x, $y + 1];
    }

    /**
     * @param int $x
     * @param int $y
     * @return int[]
     */
    public function getSouth(int $x, int $y)
    {
        return [$x, $y - 1];
    }
}
