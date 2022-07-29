@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection
@section('contents')
    <div class="profile">
        <div class="profile-are">
            <h2>CHANGER PASSWORD</h2>
            <form class="profile-form" action="">
                @csrf
                <div class="profile-form-input">
                    <label>Old password</label>
                    <input class="form-control" type="password">
                </div>
                <div class="profile-form-input">
                    <label>New password</label>
                    <input class="form-control" type="password">
                </div>
                <div class="profile-form-input">
                    <label>Confirm New password</label>
                    <input class="form-control" type="password">
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
