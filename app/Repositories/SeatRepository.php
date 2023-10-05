<?php

namespace App\Repositories;

use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class SeatRepository implements SeatRepositoryInterface
{

    public function getAll()
    {
        return Seat::with('room:id,name')->orderBy('room_id')->paginate(config('app.items_per_page'));
    }

    public function getOne($model)
    {
        return $model->load(['room', 'tickets']);
    }

    public function insert($data)
    {
        if (checkExistSeatName('seats', $data['room_id'], $data['name'])) {
            return ['error' => trans('Existed Number Seat')];
        }

        Seat::create($data);

        return ['success' => trans('Successfully created')];
    }

    public function update($model, $data)
    {
        $model->price_ratio = $data['price_ratio'];
        $model->type = $data['type'];
        $model->save();

        return ['success' => trans('Successfully updated')];
    }

    public function delete($model)
    {
        DB::transaction(function () use ($model) {
            $model->tickets()->delete();
            $model->delete();
        }, config('app.transaction_request'));

        return ['success' => trans('Successfully deleted')];
    }

    public function searchByRoom($room)
    {
        $seats = Seat::where('room_id', $room->id)->orderBy('type')->get();

        return $seats;
    }
}
