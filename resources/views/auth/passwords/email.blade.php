@extends('layouts.auth-base')

@section('body')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="header header-primary text-center">
            <div class="logo-container">
                <img src="{{asset('app-assets/img/now-logo.png')}}" alt="">
            </div>
        </div>

        <div class="form-group input-lg form-group-no-border">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" dir="rtl"
                   placeholder="ایمیل خود را وارد کنید">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-round" formnovalidate>
                دریافت ایمیل ریست پسورد
            </button>
        </div>
    </form>
@endsection
