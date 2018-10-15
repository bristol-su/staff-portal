@extends('layout.master')

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Department Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">{{ $user->forename }}</td>
                        <td>
                            <a name="view{{$user->id}}" id="view{{$user->id}}" class="btn btn-info" href="/users/{{$user->id}}/view" role="button">View</a>
                            <a name="edit{{$user->id}}" id="edit{{$user->id}}" class="btn btn-info" href="/users/{{$user->id}}/edit" role="button">Edit</a>
                            <form method="POST" action="/users/{{$user->id}}/delete">
                                {{csrf_field()}}
                                <input type="submit" name="delete{{$user->id}}" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection