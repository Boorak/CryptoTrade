@extends('layouts.auth-base')
@section('body')

    @include('layouts.shared.landing-logo')

    <div class="alert alert-success" role="alert">
        <p dir="rtl">
            حساب شما با موفقیت فعال شد.
        </p>
        <a href="{{route('login')}}">
            <span class="btn btn-sm btn-default">
                ورود
            </span>
        </a>
    </div>
@endsection