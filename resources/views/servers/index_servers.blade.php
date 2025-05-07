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
                            <a href="{{ route('servers.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Novo Servidor
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover" 
                               id="serversTable"
                               data-pagination="true"
                               data-page-size="10"
                               data-search="true"
                               data-show-refresh="true"
                               data-show-toggle="true"
                               data-show-columns="true"
                               data-show-pagination-switch="true"
                               data-page-list="[10, 25, 50, 100, all]"
                               data-search-highlight="true"
                               data-search-align="left"
                               data-toolbar="#toolbar"
                               data-toolbar-align="right"
                               data-buttons-align="right"
                               data-search-accent-neutralise="true">
                            <thead>
                                <tr>
                                    <th data-sortable="true" data-field="name">Nome do Servidor</th>
                                    <th data-sortable="true" data-field="department">Departamento</th>
                                    <th data-sortable="true" data-field="client">Cliente</th>
                                    <th data-field="actions" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($servers as $server)
                                    <tr>
                                        <td>{{ $server->name }}</td>
                                        <td>{{ $server->department }}</td>
                                        <td>{{ $server->client->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('servers.show', $server->id) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('servers.edit', $server->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('servers.destroy', $server->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este servidor?')">
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
    $('#serversTable').bootstrapTable({
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

function deleteServer(id) {
    if (confirm('Tem certeza que deseja excluir este servidor?')) {
        $.ajax({
            url: `/servers/${id}`,
            type: 'DELETE',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#serversTable').bootstrapTable('refresh');
                    alert('Servidor excluído com sucesso!');
                } else {
                    alert('Erro ao excluir o servidor.');
                }
            },
            error: function(xhr) {
                alert('Erro ao excluir o servidor. Por favor, tente novamente.');
                console.error(xhr);
            }
        });
    }
}
</script>
@endsection