@extends('auth.base')

@section('form-auth')
    <h2 class="text-center text-uppercase mb-1 font-weight-bold">Sign in</h2>
    <p class="text-center">with your ICO Account</p>
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                placeholder="Username"
                value="{{ old('username') }}"
            />
            @if($errors->has('username'))
                <div class="error">{{ $errors->first('username') }}</div>
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            @if($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="form-group text-right">
            <a href="#">Forgot password?</a>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-warning color-white font-weight-bold">Login</button>
        </div>
    </form>
@endsection
