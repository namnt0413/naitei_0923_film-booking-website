<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('checkOverlapped')) {
    function checkOverlapped($table, $startTime, $endTime)
    {
        return DB::table($table)->where(function ($query) use ($startTime, $endTime) {
            $query->where('start_time', '<=', $endTime)
                ->where('end_time', '>=', $startTime);
        })->exists();
    }
}
