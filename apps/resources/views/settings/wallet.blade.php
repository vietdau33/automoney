@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection
@section('contents')
    <div class="profile">
        <div class="profile-are">
            <h2>WALLET</h2>
            <form class="profile-form" action="">
                @csrf
                <div class="profile-form-input">
                    <label>USDT Token Address</label>
                    <input class="form-control" type="text">
                </div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
