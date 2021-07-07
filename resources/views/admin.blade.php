
@extends('layouts.app')
 
@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Admin Panel</div>
                    <table class="table">
                        <thead>
                        <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Email Address</th>
                        <th scope="col">Status</th>
                        </tr>
                        </thead>

                        @foreach($users as $user)
                        <tbody>
                        <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        @if ($user->active == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif
                        </tr>

                        </tbody>
                        @endforeach

                    </table>
                        


 
</div>
 
</div>
 
</div>

</div>
 
@endsection