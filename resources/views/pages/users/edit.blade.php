@extends('layout.master')

@section('content')

    <form method="POST" action="/users/{{$user->id}}/edit">

        {{ csrf_field() }}
        <table border="0">
            <tr>
                <td>Forename</td>
                <td><input type="text" name="forename" id="forename" class="form-control" placeholder="forename" value="{{$user->forename}}"></td>
            </tr>
            <tr>
                <td>Surname</td>
                <td><input type="text" name="surname" id="surname" class="form-control" placeholder="surname" value="{{$user->surname}}"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" id="email" class="form-control" placeholder="email" value="{{$user->email}}"></td>
            </tr>
            <tr>
                <td>Departments</td>
                <td>

                    <select name="departments[]" multiple>
                        @php $departments = $user->departments()->get()->pluck('id')->toArray(); @endphp
                        @foreach(\App\Department::all() as $department)
                            <option value="{{$department->id}}" @if(in_array($department->id,$departments )) selected @endif>{{$department->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            @can('change-password', $user)
                <tr>
                    <td>Change Password</td>
                    <td>
                        Password: <input type="password" name="password" id="password" class="form-control">
                        Password Confirmation: <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </td>
                </tr>
            @endcan

            @can('admin-only', Auth::user())
                <tr>
                    <td>Administrator?</td>
                    <td>
                        <label class="checkbox-inline">
                            <input type="radio" name="admin" id="admin" value="0" @cannot('admin-only', $user) checked @endcannot >No
                            <input type="radio" name="admin" id="admin" value="1" @can('admin-only', $user) checked @endcan>Yes
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Validated?</td>
                    <td>
                        <label class="checkbox-inline">
                            <input type="radio" name="validated" id="validated" value="0"  @if(!$user->validated) checked @endif >No
                            <input type="radio" name="validated" id="validated" value="1" @if($user->validated) checked @endif >Yes
                        </label>
                    </td>
                </tr>
            @endcan
        </table>


        <button type="submit" class="btn btn-primary">Update User</button>

    </form>


    </form>
@endsection