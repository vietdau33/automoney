@extends('auth.base')

@section('form-auth')
    <h2 class="text-center text-uppercase mb-1 font-weight-bold">Register</h2>
    <p class="text-center">Create New ICOX Account</p>
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf
        <input type="hidden" name="reflink" value="{{ $reflink }}">
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                placeholder="Username"
                autocomplete="off"
                value="{{ old('username') }}"
            />
            @if($errors->has('username'))
                <div class="error">{{ $errors->first('username') }}</div>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="fullname"
                id="fullname"
                placeholder="Fullname"
                value="{{ old('fullname') }}"
            />
            @if($errors->has('fullname'))
                <div class="error">{{ $errors->first('fullname') }}</div>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control number-only"
                name="phone"
                id="phone"
                placeholder="Phone"
                value="{{ old('phone') }}"
            />
            @if($errors->has('phone'))
                <div class="error">{{ $errors->first('phone') }}</div>
            @endif
        </div>
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="email"
                id="email"
                placeholder="Email Address"
                value="{{ old('email') }}"
            />
            @if($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            @if($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
            @if($errors->has('password_confirmation'))
                <div class="error">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-warning color-white font-weight-bold">Signup</button>
        </div>
        <div class="form-group text-right">
            Have an account? <a href="{{ route('auth.login') }}">Login</a>
        </div>
    </form>
@endsection
