@extends('layout.master')

@section('content')

    <form method="POST" action="/shortcuts/create">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Link Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="name" aria-describedby="helpname">
            <small id="helpname" class="text-muted">Name of the link</small>
        </div>

        <div class="form-group">
            <label for="link">Link URL</label>
            <input type="text" name="link" id="link" class="form-control" placeholder="link" aria-describedby="helplink">
            <small id="helplink" class="text-muted">Where to link to</small>
        </div>

        <div class="form-group">
            <label for="description">Link Description</label>
            <textarea class="form-control" name="description" id="description" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category" id="category" onchange="$('div#newcategory').toggle($(this).val()=='create_new_category')">
                <option value="create_new_category">Create New Category</option>
                @foreach($categories as $category)
                    <option value="{{$category}}" >{{$category}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="newcategory">
            <label for="new_category">New Category Name</label>
            <input type="text" class="form-control" name="new_category" id="new_category" aria-describedby="helpnew_category" placeholder="Category Name">
            <small id="helpnew_category" class="form-text text-muted">New Category Name</small>
        </div>

        <div class="form-group">
            Link Sharing<br/>
            <label class="radio-inline"><input type="radio" name="privacy" value="private" onclick="$('.department_list').hide();" checked>Just for me</label>
            <label class="radio-inline"><input type="radio" name="privacy" value="department" onclick="$('.department_list').show();">Share with department</label>
            <br/><small id="helpId" class="text-muted">Help text</small>
        </div>

        <div class="department_list" style="display:none;">
            @foreach(Auth::user()->departments()->get() as $department)
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="department[]" id="" value="{{$department->id}}">
                            {{$department->name}}
                        </label>
                    </div>
                </div>
            @endforeach

        </div>

        <button type="submit" class="btn btn-primary">Create Link</button>

    </form>


</form>
@endsection