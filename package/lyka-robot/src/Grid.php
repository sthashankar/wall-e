<?php

namespace Lyka\Robot;

use Lyka\Robot\Contracts\GridInterface;
use Lyka\Robot\Enums\Direction;

class Grid implements GridInterface
{
    private int $xaxis;
    private int $yaxis;
    private array $grid = [];
    private ?string $current_location = null;

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
                $this->grid[$x][$y] = "$x$y";
            }
        }
        $this->current_location = $this->grid[0][0];
    }

    /**
     * @param int $x
     * @param int $y
     * @return $this
     */
    public function setCurrentLocation(int $x, int $y): static
    {
        return $this;
    }

    public function move(Direction $direction): static
    {
        return $this;
    }

    public function getLocation(): string
    {
        return $this->current_location;
    }
}
