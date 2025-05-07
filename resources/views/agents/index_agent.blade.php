@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-3">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ route('agents.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Novo Agente
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" 
                               id="agentsTable"
                               data-pagination="true"
                               data-page-size="10"
                               data-search="true"
                               data-show-refresh="true"
                               data-show-columns="true">
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="code">Código</th>
                                    <th data-sortable="true" data-field="name">Nome</th>
                                    <th data-sortable="true" data-field="active">Status</th>
                                    <th data-field="actions" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($agents as $agent)
                            <tr>
                                <td>{{ $agent->code }}</td>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->active ? 'Ativo' : 'Inativo' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este agente?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
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
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.js"></script>
<script>
$(document).ready(function() {
    $('#agentsTable').bootstrapTable({
        locale: 'pt-BR',
        search: true,
        searchAlign: 'left',
        pagination: true,
        pageSize: 10,
        pageList: [10, 25, 50, 100, 'Todos'],
        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Mostrando ' + pageFrom + ' até ' + pageTo + ' de ' + totalRows + ' registros';
        },
        formatRecordsPerPage: function (pageNumber) {
            return pageNumber + ' registros por página';
        },
        formatSearch: function () {
            return 'Pesquisar';
        },
        formatNoMatches: function () {
            return 'Nenhum registro encontrado';
        }
    });
});
</script>
@endsection