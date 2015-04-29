<ul id="sidebar-mobile">
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