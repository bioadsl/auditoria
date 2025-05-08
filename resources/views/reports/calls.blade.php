@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Relatório de Chamados</h2>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ticket</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dados serão carregados via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection