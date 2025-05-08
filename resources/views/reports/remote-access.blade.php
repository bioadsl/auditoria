@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Relatório de Acesso Remoto</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="remoteAccessChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('remoteAccessChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Acessos Remotos',
                data: [65, 59, 80, 81, 56, 55],
                backgroundColor: '#36A2EB'
            }]
        }
    });
});
</script>
@endsection