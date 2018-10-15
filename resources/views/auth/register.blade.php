@extends('layout.master')

@section('content')
    <form method="POST" action="/register">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="forename">Forename</label>
            <input type="text" name="forename" id="forename" class="form-control" aria-describedby="forenameHelp" required>
            <small id="forenameHelp" class="text-muted">Type in your first name</small>
        </div>

        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname" class="form-control" aria-describedby="surnameHelp" required>
            <small id="surnameHelp" class="text-muted">Type in your last name</small>
        </div>


        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="text-muted">This will be used for logging in</small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" aria-describedby="passwordHelp">
            <small id="passwordHelp" class="text-muted">Make sure it's secure!</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" aria-describedby="password_confirmationHelp">
            <small id="password_confirmationHelp" class="text-muted">Make sure it's secure! It must be at least 6 characters long.</small>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

@endsection