<?php

namespace Lyka\Robot\Contracts;

use Lyka\Robot\Enums\Direction;

interface GridInterface
{
    /**
     * @param int $x
     * @param int $y
     * @return $this
     */
    public function setCurrentLocation(int $x, int $y): static;

    /**
     * @param Direction $direction
     * @return $this
     */
    public function move(Direction $direction): static;

    /**
     * @return array
     */
    public function getLocation(): array;

}
