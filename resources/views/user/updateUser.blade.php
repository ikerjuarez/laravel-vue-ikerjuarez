@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <h1>Update form</h1>
        </div>
            <form method="post" action="/updateUser" class="row">
                @csrf
                <input type="hidden" name="id" value="{{$userToUpdate->id}}">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" readonly id="inputEmail" aria-describedby="emailHelp" value="{{$userToUpdate->email}}">
                </div>
                <div class="col-sm-6">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="col-sm-6">
                    <label for="inputName" class="form-label">Name</label>
                    <input type="tel" name="name" class="form-control" id="inputName" value="{{$userToUpdate->name}}">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="col-sm-2 mt-2 btn btn-primary">Submit</button>
                    <a class="col-sm-2 mt-2 btn btn-danger" href="/main" style="margin-left: 10px">Cancel</a>
                </div>
            </form>
    </div>
@endsection
