<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('checkOverlapped')) {
    function checkOverlapped($table, $startTime, $endTime, $id)
    {
        return DB::table($table)->where(function ($query) use ($startTime, $endTime, $id) {
            $query->where('start_time', '<=', $endTime)
                ->where('end_time', '>=', $startTime)
                ->where('id', '!=', $id);
        })->exists();
    }

    function checkExistNumberSeat($table, $room_id, $number)
    {
        return DB::table($table)->where('room_id', $room_id)->where('number', $number)->exists();
    }
}
