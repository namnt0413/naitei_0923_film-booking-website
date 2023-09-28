<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __("Mail notification") }}</title>
</head>
<body>
        <h2>{{ __("Film booking website") }}</h2> 
        <h3>{{ __("Thank :user for booking", ['user' => Auth::user()->getFullNameAttribute()]) }}</h3>

        @foreach ($tickets as $key => $ticket)
            <h3>{{ __("Ticket number :num", ['num' => $key + 1]) }}</h3>
            @component('mail::table')
                | &nbsp;                  | &nbsp;                                                                      |
                | :---------------------- | --------------------------------------------------------------------------: |
                |  {{ __("Film") }}       | {{ $ticket->film->title }}                                                  |
                |  {{ __("Room") }}       | {{ $ticket->room->name }}                                                   |
                |  {{ __("Seat") }}       | {{ $ticket->seat->name }}                                                 |
                |  {{ __("Screening") }}  | {{ $ticket->screening->start_time }} - {{ $ticket->screening->end_time }}   |
                |  {{ __("Price") }}      | {{ $ticket->price }}                                                        |
            @endcomponent
        @endforeach
</body>
</html>
