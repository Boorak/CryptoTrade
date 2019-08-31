@extends('layouts.auth-base')

@section('body')

    <form class="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <div class="header header-primary text-center">
            <div class="logo-container">
                <img src="{{asset('app-assets/img/now-logo.png')}}" alt="">
            </div>
        </div>

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group input-lg form-group-no-border">
            <input id="email" type="email" class="form-control" name="email"
                   value="{{ $email or old('email') }}" placeholder="ایمیل" dir="rtl">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="password" type="password" class="form-control" name="password" placeholder="رمز عبور جدید"
                   dir="rtl">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" placeholder="تکرار رمز عبور جدید" dir="rtl">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-round">
                تغییر رمز عبور
            </button>
        </div>
    </form>

@endsection
