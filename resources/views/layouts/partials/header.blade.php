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
            </ul>
        </div>
    </div>
</nav>