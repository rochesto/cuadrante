<!DOCTYPE HTML>
<html>
    <head>
        
        <title>Cuadrante</title>
        
        @include('layouts.header')
        
        @yield('header')
        
    </head>
    <body class="skin-blue  pace-done" style="min-height: 1071px; cursor: auto;">
       {{--  <div class="pace  pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
                 <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity">
            </div>
        </div> --}}
        
        <header class="header">
            @include('layouts.title')
        </header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 555px;">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas" style="min-height: 1071px;">
                <section class="sidebar">
                    @include('layouts.sidebarLeft')
                </section>
            </aside>
            <aside class="right-side">
                @yield('content')      
            </aside>
            @section('footer')
            
            @show
        </div>

        <footer class="main-footer">
            <strong>Copyright © 2015</strong> Autor: <a href="https://aldrabon.wordpress.com/">Rochesto</a>
            <br> All rights reserved.
            <b id="version">Version</b> 0.2
        </footer>
        
        
    </body>
</html>