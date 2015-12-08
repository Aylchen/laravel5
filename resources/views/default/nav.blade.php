<nav class="navbar" role="navigation">
        <!--向左对齐-->
        <ul class="nav navbar-nav navbar-left">
            <li><a href="/">Home</a></li>
            <li><a href="{{ url('articles') }}">Articles</a></li>
        </ul>
        <!--向右对齐-->
        <ul class="nav navbar-nav navbar-right">
            @if(is_null(Auth::user()))
                <li><a href="{{ url('auth', 'login') }}">Sign In</a></li>
                <li><a href="{{ url('auth', 'register') }}">Sign Up</a></li>
            @else
                <li>
                    <p class="navbar-text navbar-right">Welcome</p>
                </li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->username }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('user', 'profile') }}">My Profile</a></li>
                        <li><a href="{{ url('user', 'comments') }}">My Comments</a></li>
                        <li><a href="{{ url('user', 'articles') }}">My Articles</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('auth', 'logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>
</nav>