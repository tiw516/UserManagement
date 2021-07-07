
@extends('layouts.app')
 
@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Welcome to Admin Panel</div>

                <div class="card-body">
                    @if(session()->get('message'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success: </strong>{{session()->get('message')}}
                        </div>
                    @endif

                </div>    

                    <table class="table " >
                        <thead>
                        <tr>
                        <th scope="col col-md-2">User Name</th>
                        <th scope="col col-md-2">Email Address</th>
                        <th scope="col col-md-2">Status</th>                       
                        </tr>
                        </thead>

                        @foreach($users as $user)
                        <tbody >
                        <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        @if ($user->active == 1)
                        <td>Active</td>
                        @else
                        <td>Inactive</td>
                        @endif
                        </tr>

                        <td >
                            <button type="button"  class="btn btn-danger dropdown-toggle btn-sm pull-right" data-toggle="dropdown">
                                <span class="caret"> Action</span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('disableOne', $user->id) }}">Change Status</a></li>
                                    
                                    <li><a href="{{ route('deleteOne', $user->id) }}">Delete</a></li>
                                </ul>
                        </td>

                        </tbody>
                        @endforeach

                    </table>
                        


 
</div>
 
</div>
 
</div>

</div>
 
@endsection