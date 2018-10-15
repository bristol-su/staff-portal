@extends('layout.master')

@section('content')
    <form method="POST" action="/login">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="text-muted"></small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" aria-describedby="passwordHelp">
            <small id="passwordHelp" class="text-muted"></small>
        </div>

        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="remember" id="remember" value="checkedValue" checked>
                Remember Me
            </label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

@endsection