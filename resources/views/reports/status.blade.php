@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Relatório de Status</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="statusDistributionChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="statusTrendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Distribuição de Status
    new Chart(document.getElementById('statusDistributionChart'), {
        type: 'pie',
        data: {
            labels: ['Em Aberto', 'Em Andamento', 'Concluído', 'Cancelado'],
            datasets: [{
                data: [12, 19, 3, 5],
                backgroundColor: ['#FF6384', '#36A2EB', '#4BC0C0', '#FF9F40']
            }]
        }
    });

    // Gráfico de Tendência de Status
    new Chart(document.getElementById('statusTrendChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Em Aberto',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#FF6384'
            }, {
                label: 'Concluído',
                data: [8, 15, 5, 7, 4, 6],
                borderColor: '#4BC0C0'
            }]
        }
    });
});
</script>
@endsection