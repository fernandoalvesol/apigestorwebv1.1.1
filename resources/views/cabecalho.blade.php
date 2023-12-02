<div class="topo d-flex text-end">
    @php
        $imgPerfil = Auth::user()->foto ?? '';
    @endphp

    <a href="" class="mobmenu alt"><i class="fas fa-bars"></i></a>
    <ul class="menu-topo">
        <li class="sub">
            @if ($imgPerfil)
                <img src="{{ url($imgPerfil) }}" class="img-user">
            @else
                <img src="{{ asset('assets/img/logo-brasil.png') }}" class="img-user">
            @endif
            <span class="text-branco"><a href="{{ route('logout') }}">SAIR</a>
            </span>
            
        </li>
    </ul>
</div>
