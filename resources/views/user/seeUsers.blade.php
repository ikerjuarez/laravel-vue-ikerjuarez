@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <h1>User's List</h1>
        </div>
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>
                        <a href="/user/{{$user->id}}/update" class="btn btn-primary">Modify</a>
                    </td>
                    <td>
                        <a href="/user/{{$user->id}}/delete" class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
