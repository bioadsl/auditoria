@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ route('calls.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Nova Análise
                            </a>
                        </div>
                    </div>

                    <table id="table" 
                           data-toolbar="#toolbar"
                           data-search="true"
                           data-show-refresh="true"
                           data-show-toggle="true"
                           data-show-fullscreen="true"
                           data-show-columns="true"
                           data-show-columns-toggle-all="true"
                           data-detail-view="true"
                           data-show-export="true"
                           data-click-to-select="true"
                           data-minimum-count-columns="2"
                           data-show-pagination-switch="true"
                           data-pagination="true"
                           data-id-field="id"
                           data-page-list="[10, 25, 50, 100, all]"
                           data-show-footer="true"
                           class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th data-field="ticket" data-sortable="true">Ticket</th>
                                <th data-field="agent" data-sortable="true">Agente</th>
                                <th data-field="client" data-sortable="true">Cliente</th>
                                <th data-field="date" data-sortable="true">Data</th>
                                <th data-field="server" data-sortable="true">Servidor</th>
                                <th data-field="description" data-sortable="true">Descrição</th>
                                <th data-field="action" data-sortable="true">Ação</th>
                                <th data-field="status" data-sortable="true">Status</th>
                                <th data-field="result" data-sortable="true">Resultado</th>
                                <th data-field="observation">Observação</th>
                                <th data-field="time" data-sortable="true">Tempo</th>
                                <th data-field="remote">Remoto</th>
                                <th data-field="actions">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calls as $call)
                            <tr>
                                <td>{{ $call->ticket_number }}</td>
                                <td>{{ $call->agent->name }}</td>
                                <td>{{ $call->client->name }}</td>
                                <td>{{ $call->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $call->server ? $call->server->name : '-' }}</td>
                                <td>{{ $call->problemDescription ? $call->problemDescription->description : '-' }}</td>
                                <td>{{ $call->actionType ? $call->actionType->name : '-' }}</td>
                                <td>{{ $call->finalStatus ? $call->finalStatus->name : '-' }}</td>
                                <td>{{ $call->callResult ? $call->callResult->name : '-' }}</td>
                                <td>{{ $call->observation ?: '-' }}</td>
                                <td>{{ $call->wait_time }}</td>
                                <td class="text-center">
                                    @if($call->remote_access)
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @else
                                        <i class="bi bi-x-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('calls.show', $call) }}" class="btn btn-info" title="Visualizar">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('calls.edit', $call) }}" class="btn btn-warning" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" title="Excluir" 
                                                onclick="if(confirm('Confirma exclusão?')) document.getElementById('form-delete-{{ $call->id }}').submit()">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                    <form id="form-delete-{{ $call->id }}" action="{{ route('calls.destroy', $call) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Export dependencies -->
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>

<!-- Bootstrap Table -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/locale/bootstrap-table-pt-BR.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/extensions/export/bootstrap-table-export.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('js/calls.js') }}"></script>
<style>
.table {
    font-size: 0.75rem;
    width: 100%;
}
.table td {
    padding: 0.25rem 0.5rem;
    white-space: normal;
    word-break: break-word;
}
.table th {
    padding: 0.5rem;
    white-space: nowrap;
}
.card-body {
    padding: 0.75rem;
}
.btn-group-sm > .btn {
    padding: 0.1rem 0.3rem;
    font-size: 0.75rem;
}
.fixed-table-container {
    border: none;
}
</style>
@endsection