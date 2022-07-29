@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection
@section('contents')
    <div class="profile">
        <div class="profile-are">
            <h2>PROFILE</h2>
            <form class="profile-form" action="">
                @csrf
                <div class="profile-form-input">
                    <label>Full name</label>
                    <input class="form-control" type="text" placeholder="Nguyen van A">
                </div>
                <div class="profile-form-input">
                    <label>Phone Number</label>
                    <input class="form-control" type="text" placeholder="090000000">
                </div>
                <div class="profile-form-input">
                    <label>Email</label>
                    <input class="form-control" type="text" placeholder="abc@gmail.com">
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
