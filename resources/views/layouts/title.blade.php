
<a href="{{ URL::to('/?month='.date('m').'&year='.date('Y')) }}" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    Cuadrante.es
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>-->
    <div class="navbar-right">
        <ul class="nav navbar-nav user user-menu">

            <i class="glyphicon glyphicon-user"></i>
            <span>
            @if (Auth::guest())
                <button class="login"><a href="/auth/login">Login</a></button>
                <button class="login"><a href="/auth/register">Register</a></button>
            @else
                <button class="login"><a href="perfil">{{ Auth::user()->name }} </a></button>
                <button class="login"><a href="/auth/logout">Salir</a></button>
            @endif
            </span>
        </ul>
    </div>
</nav>