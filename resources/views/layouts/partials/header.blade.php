<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <div class="w-20">
            <a class="navbar-brand" href="/">
                <i class="bi bi-shield-check"></i> Auditoria
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center w-60" id="navbarNav">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-graph-up"></i> Relatórios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('reports.dashboard') }}">Dashboard Geral</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.calls') }}">Chamadas</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.actions') }}">Ações</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.status') }}">Status</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.remote-access') }}">Acesso Remoto</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.monthly') }}">Relatório Mensal</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.quality') }}">Qualidade</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('reports.import.index') }}">Importar CSV</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Botão de logout à direita -->
        <div class="w-20">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>