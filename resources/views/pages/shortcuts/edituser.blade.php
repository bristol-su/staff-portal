@extends('layout.master')

@section('content')

    <form method="POST" action="/shortcuts/{{$shortcut->id}}/edit">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Link Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="name" aria-describedby="helpname" value="{{$shortcut->name}}">
            <small id="helpname" class="text-muted">Name of the link</small>
        </div>

        <div class="form-group">
            <label for="link">Link URL</label>
            <input type="text" name="link" id="link" class="form-control" placeholder="link" aria-describedby="helplink" value="{{$shortcut->link}}">
            <small id="helplink" class="text-muted">Where to link to</small>
        </div>

        <div class="form-group">
            <label for="description">Link Description</label>
            <textarea class="form-control" name="description" id="description" rows="5">{{$shortcut->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category" id="category" onchange="$('div#newcategory').toggle($(this).val()=='create_new_category')">
                <option value="create_new_category">Create New Category</option>
                @foreach($categories as $category)
                    <option value="{{$category}}" @if($category == $shortcut->category)selected @endif >{{$category}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="newcategory" style="display: none;">
            <label for="new_category">New Category Name</label>
            <input type="text" class="form-control" name="new_category" id="new_category" aria-describedby="helpnew_category" placeholder="Category Name">
            <small id="helpnew_category" class="form-text text-muted">New Category Name</small>
        </div>


        <button type="submit" class="btn btn-primary">Save Link</button>

    </form>
@endsection