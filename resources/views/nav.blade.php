<nav class="navbar" role="navigation">
        <!--向左对齐-->
        <ul class="nav navbar-nav navbar-left">
            <li><a href="/">Home</a></li>
            <li><a href="/articles">Articles</a></li>
        </ul>
        <!--向右对齐-->
        <ul class="nav navbar-nav navbar-right">
            @if(is_null(\Illuminate\Support\Facades\Auth::user()))
                <li><a href="/auth/login">Sign In</a></li>
                <li><a href="/auth/register">Sign Up</a></li>
            @else
                <li>
                    <p class="navbar-text navbar-right">
                        Welcome, {{ \Illuminate\Support\Facades\Auth::user()->username }}
                    </p>
                </li><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li><a href="/auth/logout">Logout</a></li>
            @endif
        </ul>
</nav>