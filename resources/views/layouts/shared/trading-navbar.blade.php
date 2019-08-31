<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/">
            <img src="{{asset('trading-assets/images/bitfinex.svg')}}" alt="">
        </a>
        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li>
                <a data-toggle="collapse" data-target="#navbar-mobile">
                    <i class="icon-tree5"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <deposit></deposit>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="dropdown dropdown-user">
                    <a href="#">
                        <img src="{{asset('trading-assets/images/man.png')}}" alt="">
                        <span>{{auth()->user()->name}}</span>
                    </a>
                </li>
                <li>
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="icon-exit"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
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