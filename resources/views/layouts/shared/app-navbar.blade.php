<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand btn btn-neutral btn-lg" href="/trading">
                <p style="color: #303030;">بازار ارز</p>
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation"
             data-nav-image="{{asset('app-assets/img/blurred-image-1.jpg')}}">
            <ul class="navbar-nav" dir="rtl">
                @if (\Illuminate\Support\Facades\Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p>
                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                            </p>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-right"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                               style="cursor: pointer;">
                                <p>خروج</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <p>ورود</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <p>ثبت نام</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
