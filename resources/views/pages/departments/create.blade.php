@extends('layout.master')

@section('content')

    <form method="POST" action="/departments/create">

        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Department Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="name" aria-describedby="helpname">
            <small id="helpname" class="text-muted">Name of the department</small>
        </div>

        <button type="submit" class="btn btn-primary">Create Department</button>

    </form>


</form>
@endsection