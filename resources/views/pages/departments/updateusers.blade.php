@extends('layout.master')

@section('content')
    Users for {{ $department->name }}:<br/>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Add User</legend>
            @if(count($users) > 0)
                <form method="POST" action="/departments/{{$department->id}}/users/add">
                    {{csrf_field()}}
                    <select name="user">
                        @foreach($users as $user)

                            <option value="{{$user->id}}">{{$user->forename}} {{$user->surname}} - {{$user->email}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success">Add User</button>
                </form>
            @endif
    </fieldset>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Forename</th>
                <th>Surname</th>
                <th>Email</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach($department->users()->orderBy('forename', 'ASC')->get() as $user)
                    <tr>
                        <td scope="row">{{$user->forename}}</td>
                        <td>{{$user->surname}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <form method="POST" action="/departments/{{$department->id}}/users/{{$user->id}}/delete">
                                {{csrf_field()}}
                                <input type="submit" name="delete{{$department->id}}" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection