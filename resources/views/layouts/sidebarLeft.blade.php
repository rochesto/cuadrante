<!-- search form -->
<!--
<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="seach" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>
-->
<!-- /.search form -->



<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
    <li class="active">
        <a href="{{ URL::to('calendario?month='.date('m').'&year='.date('Y')) }}">
            <i class="fa fa-calendar"></i> <span>Cuadrante</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ URL::to('perfil') }}">
            <i class="fa fa-edit"></i> <span>Perfil</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ URL::to('about') }}">
            <i class="fa fa-question"></i> <span>Sobre</span>
        </a>
    </li>
    
</ul>