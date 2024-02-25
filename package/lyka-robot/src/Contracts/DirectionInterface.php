<?php

namespace Lyka\Robot\Contracts;

interface DirectionInterface
{

    public function getEast(int $x, int $y);

    public function getWest(int $x, int $y);

    public function getNorth(int $x, int $y);

    public function getSouth(int $x, int $y);

}
