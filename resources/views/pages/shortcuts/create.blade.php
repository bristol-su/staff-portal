@extends('layout.master')

@section('content')

    <form method="POST" action="/shortcuts/create">
        {{ csrf_field() }}
        <h3>New Shortcut Details</h3>
        <div class="form-group">
            <label for="name">Link Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Shortcut Name" aria-describedby="helpname">
            <small id="helpname" class="text-muted">A short name to describe this shortcut.</small>
        </div>

        <div class="form-group">
            <label for="link">Link URL</label>
            <input type="text" name="link" id="link" class="form-control" placeholder="URL" aria-describedby="helplink">
            <small id="helplink" class="text-muted">Where should the shortcut redirect to?</small>
        </div>

        <div class="form-group">
            <label for="description">Link Description</label>
            <textarea class="form-control" name="description" id="description" rows="5" placeholder="Describe what this link can be used for!"></textarea>
        </div>
        <br/><br/>
        <hr/>
        <h3>Categorise your shortcut</h3>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category" id="category" onchange="$('div#newcategory').toggle($(this).val()=='create_new_category')">
                <option value="create_new_category">Create New Category</option>
                @foreach($categories as $category)
                    <option value="{{$category}}" >{{$category}}</option>
                @endforeach
            </select>
            <small id="helpnew_category" class="form-text text-muted">Choose the category for this shortcut, or 'Create New Category' to create a new category</small>
        </div>

        <div class="form-group" id="newcategory">
            <label for="new_category">New Category Name</label>
            <input type="text" class="form-control" name="new_category" id="new_category" aria-describedby="helpnew_category" placeholder="Category Name">
            <small id="helpnew_category" class="form-text text-muted">Choose a name for your category</small>
        </div>

        <br/><br/>
        <hr/>
        <h3>Shortcut Sharing</h3>
        <div class="form-group">
            Link Sharing<br/>
            <label class="radio-inline"><input type="radio" name="privacy" value="private" onclick="$('.department_list').hide();" checked>Just for me</label>
            <label class="radio-inline"><input type="radio" name="privacy" value="department" onclick="$('.department_list').show();">Share with department</label>
            <br/><small id="helpId" class="text-muted">'Just for me' will only let you see this shortcut. 'Share with department' will let you choose departments to share this link with.</small>
        </div>

        <div class="department_list" style="display:none;">
            @foreach(auth()->user()->departments()->get() as $department)
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="department[]" id="" value="{{$department->id}}">
                            {{$department->name}}
                        </label>
                    </div>
                </div>
            @endforeach
            <br/><small id="helpId" class="text-muted">Choose departments to share this shortcut with</small>

        </div>

        <button type="submit" class="btn btn-primary">Create Link</button>

    </form>


</form>
@endsection