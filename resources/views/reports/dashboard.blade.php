@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Operacional</h2>

    <!-- Cards de Indicadores -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total de Chamados</h5>
                    <h2 class="text-center" id="totalCalls">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chamados Abertos</h5>
                    <h2 class="text-center" id="openCalls">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tempo Médio</h5>
                    <h2 class="text-center" id="avgTime">0min</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Taxa de Resolução</h5>
                    <h2 class="text-center" id="resolutionRate">0%</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chamados por Status</h5>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chamados por Tipo de Ação</h5>
                    <canvas id="actionTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Evolução de Chamados</h5>
                    <canvas id="callsEvolutionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Status
    new Chart(document.getElementById('statusChart'), {
        type: 'pie',
        data: {
            labels: ['Em Aberto', 'Em Andamento', 'Concluído', 'Cancelado'],
            datasets: [{
                data: [12, 19, 3, 5],
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#4BC0C0',
                    '#FF9F40'
                ]
            }]
        }
    });

    // Gráfico de Tipos de Ação
    new Chart(document.getElementById('actionTypeChart'), {
        type: 'bar',
        data: {
            labels: ['Suporte', 'Manutenção', 'Instalação', 'Configuração'],
            datasets: [{
                label: 'Quantidade',
                data: [65, 59, 80, 81],
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de Evolução
    new Chart(document.getElementById('callsEvolutionChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Chamados',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#4BC0C0',
                tension: 0.1
            }]
        }
    });
});
</script>
@endsection