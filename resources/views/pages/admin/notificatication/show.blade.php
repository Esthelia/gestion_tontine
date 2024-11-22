@extends('layout.master')

@section('content')




@foreach (auth()->user()->unreadNotifications as $notification)
    <div>
        <p>{{ $notification->data['message'] }}</p>
        <p><a href="{{ url('/') }}">Voir plus</a></p>
    </div>
@endforeach




@endsection