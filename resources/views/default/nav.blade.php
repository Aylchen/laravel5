<nav class="navbar" role="navigation">
    <!--向左对齐-->
    <ul class="am-nav am-nav-pills navbar-left">
        @if(!isset($highlight)) <li class="am-active"> @else <li> @endif
            <a href="/">Home</a></li>
        @if(isset($highlight) && $highlight) <li class="am-active"> @else <li>  @endif
        <a href="{{ url('articles') }}">Articles</a></li>
        <li><a href="/admin">Admin</a></li>
    </ul>

    <!--向右对齐-->
    <ul class="am-nav am-nav-pills navbar-right" style="margin-top: 0;">
        @if(is_null(Auth::user()))
            <li><a href="{{ url('auth', 'login') }}">Sign In</a></li>
            <li><a href="{{ url('auth', 'register') }}">Sign Up</a></li>
        @else
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    {{ Auth::user()->username }} <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="{{ url('user', 'profile') }}">1.My Profile</a></li>
                    <li><a href="{{ url('user', 'comments') }}">2.My Comments</a></li>
                    <li><a href="{{ url('user', 'articles') }}">3.My Articles</a></li>
                    <li class="am-divider"></li>
                    <li><a href="{{ url('auth', 'logout') }}">Logout</a></li>
                </ul>
            </li>
        @endif
    </ul>
</nav>