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
                @foreach($departments as $department)
                    <tr>
                        <td scope="row">{{ $department->name }}</td>
                        <td>
                            <a name="view{{$department->id}}" id="view{{$department->id}}" class="btn btn-info" href="/departments/{{$department->id}}/view" role="button">View</a>
                            <a name="edit{{$department->id}}" id="edit{{$department->id}}" class="btn btn-info" href="/departments/{{$department->id}}/edit" role="button">Edit</a>
                            <a name="edit{{$department->id}}" id="edit{{$department->id}}" class="btn btn-info" href="/departments/{{$department->id}}/users" role="button">Add Users</a>
                            <form method="POST" action="/departments/{{$department->id}}/delete">
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