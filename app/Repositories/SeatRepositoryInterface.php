<?php

namespace App\Repositories;

interface SeatRepositoryInterface extends BaseRepository
{
    public function searchByRoom($room);
}
