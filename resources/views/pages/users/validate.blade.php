@extends('layout.master')

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Forename</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td scope="row">{{ $user->forename }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="POST" action="/users/{{$user->id}}/validate">
                            {{csrf_field()}}
                            <input type="submit" name="validate{{$user->id}}" class="btn btn-success" value="Validate"/>
                        </form>
                        <a name="view{{$user->id}}" id="view{{$user->id}}" class="btn btn-info" href="/users/{{$user->id}}/view" role="button">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection