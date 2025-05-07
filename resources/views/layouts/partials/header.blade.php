<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <i class="bi bi-shield-check"></i> Auditoria
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('calls.*') ? 'active' : '' }}" href="{{ route('calls.index') }}">
                        <i class="bi bi-telephone"></i> Chamados
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('servers.*') ? 'active' : '' }}" href="{{ route('servers.index') }}">
                        <i class="bi bi-people"></i> Servidores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('problem_descriptions.*') ? 'active' : '' }}" href="{{ route('problem_descriptions.index') }}">
                        <i class="bi bi-file-text"></i> Catálogo de Problemas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('agents.*') ? 'active' : '' }}" href="{{ route('agents.index') }}">
                        <i class="bi bi-person-badge"></i> Agentes
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>