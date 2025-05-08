@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Relatório de Ações</h2>
    <div class="card">
        <div class="card-body">
            <canvas id="actionsChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('actionsChart'), {
        type: 'bar',
        data: {
            labels: ['Suporte', 'Manutenção', 'Instalação', 'Configuração'],
            datasets: [{
                label: 'Quantidade de Ações',
                data: [65, 59, 80, 81],
                backgroundColor: '#36A2EB'
            }]
        }
    });
});
</script>
@endsection