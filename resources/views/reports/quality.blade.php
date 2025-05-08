@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Relatório de Qualidade</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Taxa de Resolução</h5>
                    <canvas id="resolutionChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tempo Médio de Atendimento</h5>
                    <canvas id="avgTimeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Taxa de Resolução
    new Chart(document.getElementById('resolutionChart'), {
        type: 'doughnut',
        data: {
            labels: ['Resolvidos', 'Pendentes'],
            datasets: [{
                data: [85, 15],
                backgroundColor: ['#4BC0C0', '#FF6384']
            }]
        }
    });

    // Gráfico de Tempo Médio
    new Chart(document.getElementById('avgTimeChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Tempo Médio (minutos)',
                data: [30, 25, 35, 20, 28, 22],
                borderColor: '#36A2EB',
                tension: 0.1
            }]
        }
    });
});
</script>
@endsection