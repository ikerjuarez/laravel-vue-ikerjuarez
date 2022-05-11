@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin == true)
    <div class="container">
        <joc></joc>
    </div>
    @else
        <div class="container" style="width: 100%; height: 100%;">
            <div class="d-flex justify-content-center">
                <h1>Only user Admin can access this page</h1>
            </div>
        </div>
    @endif
@endsection
