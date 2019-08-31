@extends('layouts.auth-base')

@section('body')

    @if (session('warning'))
        <div class="alert alert-danger">
            {{ session('warning') }}
        </div>
    @endif

    <form class="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        @include('layouts.shared.landing-logo')

        <div class="form-group input-lg form-group-no-border">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                   placeholder="ایمیل" dir="rtl">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="password" type="password" class="form-control" name="password" placeholder="رمز عبور" dir="rtl">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <input id="checkbox1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="checkbox1">
                    مرا به خاطر بسپار
                </label>
            </div>
        </div>

        <div class="footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-block" formnovalidate>ورود</button>
        </div>

        <div class="pull-left">
            <h6>
                <a href="{{route('register')}}" class="link">ایجاد حساب</a>
            </h6>
        </div>

        <div class="pull-right">
            <h6>
                <a href="{{ route('password.request') }}" class="link">فراموشی رمز عبور</a>
            </h6>
        </div>
    </form>

@endsection
