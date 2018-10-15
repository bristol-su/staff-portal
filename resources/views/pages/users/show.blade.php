@extends('layout.master')

@section('content')
    <a href="/users/{{$user->id}}/edit" class="btn btn-info">Edit</a><br/>
    Forename: {{ $user->forename }}<br/>
    Surname: {{ $user->surname }}<br/>
    Email: {{ $user->email }}<br/>
    Departments:
        <ul>
            <li>
                {!! implode('</li><li>', $user->departments()->get()->pluck('name')->toArray()) !!}
            </li>
        </ul>

@endsection