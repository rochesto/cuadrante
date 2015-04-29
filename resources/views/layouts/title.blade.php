
<a href="{{ URL::to('/') }}" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    Cuadrante.es
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">

    <button type="button" class="btn btn-warning" id="beta">Beta</button>
    <a href="" class="sidebar-toggle" role="button" id="menuMobile">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-right">
        <ul class="nav navbar-nav user user-menu">

            {{-- <i class="glyphicon glyphicon-user"></i> --}}
            <span>
            @if (Auth::guest())
                <button class="btn btn-default btn-xs"><a href="/auth/login">Login</a></button>
                <button class="btn btn-default btn-xs"><a href="/auth/register">Register</a></button>
            @else
                <button class="btn btn-default btn-xs"><a href="perfil">{{ Auth::user()->name }} </a></button>
                <button class="btn btn-default btn-xs"><a href="/auth/logout">Salir</a></button>
            @endif
            </span>
        </ul>
    </div>
</nav>