@extends('layouts.auth-base')

@section('body')

    <form class="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        @include('layouts.shared.landing-logo')

        <div class="form-group input-lg form-group-no-border">
            <input id="name" type="text" class="form-control" name="name"
                   value="{{ old('name') }}" placeholder="نام کاربری" dir="rtl">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="email" type="email" class="form-control" name="email"
                   value="{{ old('email') }}" placeholder="ایمیل" dir="rtl">
            @if ($errors->has('email'))
                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="password" type="password" class="form-control" name="password" dir="rtl" placeholder="رمز عبور">
            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" dir="rtl" placeholder="تکرار رمز عبور">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-round">
                ثبت نام
            </button>
        </div>
    </form>

@endsection
