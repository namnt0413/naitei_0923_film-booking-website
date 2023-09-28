<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('checkOverlapped')) {
    function checkOverlapped($table, $startTime, $endTime, $roomId, $id)
    {
        return DB::table($table)->where(function ($query) use ($startTime, $endTime, $roomId, $id) {
            $query->where('start_time', '<=', $endTime)
                ->where('end_time', '>=', $startTime)
                ->where('room_id', '!=', $roomId)
                ->where('id', '!=', $id);
        })->exists();
    }

    function checkExistNumberSeat($table, $room_id, $number)
    {
        return DB::table($table)->where('room_id', $room_id)->where('number', $number)->exists();
    }
}
