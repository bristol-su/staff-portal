@extends('layout.master')

@section('content')
    <h2>Your Shortcuts:</h2><br/>
    <div class="table-responsive table-striped table-condensed">
        <table class="table">
            <thead>
                <tr>
                    <th>Link Name</th>
                    <th>Link Shortcut</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usershortcuts as $shortcut)
                    <tr>
                        <td scope="row">{{ $shortcut->name }}</td>
                        <td><a href="{{$shortcut->link}}">{{ $shortcut->link }}</a></td>
                        <td>{{ $shortcut->category }}</td>
                        <td>
                            <a name="view{{$shortcut->id}}" id="view{{$shortcut->id}}" class="btn btn-info" href="/shortcuts/{{$shortcut->id}}/view" role="button">View</a>
                            <a name="edit{{$shortcut->id}}" id="edit{{$shortcut->id}}" class="btn btn-info" href="/shortcuts/{{$shortcut->id}}/edit" role="button">Edit</a>
                            <form method="POST" action="/shortcuts/{{$shortcut->id}}/delete">
                                {{csrf_field()}}
                                <input type="submit" name="delete{{$shortcut->id}}" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2>Department Shortcuts:</h2><br/>
    <div class="table-responsive table-striped table-condensed">
        <table class="table">
            <thead>
            <tr>
                <th>Link Name</th>
                <th>Link Shortcut</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($departmentshortcuts as $name=>$shortcuts)
                <tr>
                    <td scope="row" colspan="4" class="full-table-width">{{$name}}</td>
                </tr>
                @foreach($shortcuts as $shortcut)
                    <tr>
                        <td scope="row">{{$shortcut->name}}</td>
                        <td><a href="{{$shortcut->link}}">{{ $shortcut->link }}</a></td>
                        <td>{{$shortcut->category}}</td>
                        <td>
                            <a name="view{{$shortcut->id}}" id="view{{$shortcut->id}}" class="btn btn-info" href="/shortcuts/department/{{$shortcut->id}}/view" role="button">View</a>
                            <a name="edit{{$shortcut->id}}" id="edit{{$shortcut->id}}" class="btn btn-info" href="/shortcuts/department/{{$shortcut->id}}/edit" role="button">Edit</a>
                            <form method="POST" action="/shortcuts/department/{{$shortcut->id}}/delete">
                                {{csrf_field()}}
                                <input type="submit" name="delete{{$shortcut->id}}" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

@endsection