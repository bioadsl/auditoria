@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
@endsection

@section('content')
<div class="container">
    <div class="bg-white p-3">
        <form action="{{ route('calls.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Cliente</label>
                    <select name="client_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Agente</label>
                    <select name="agent_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Servidor</label>
                    <div class="input-group">
                        <input type="text" id="server_input" name="server_name" class="form-control" placeholder="Selecione um servidor..." readonly>
                        <input type="hidden" id="server_id" name="server_id">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchServerModal">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Número do Ticket</label>
                    <input type="text" name="ticket_number" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Tipo de Ação</label>
                    <select name="action_type_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($actionTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Status Final</label>
                    <select name="final_status_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($finalStatuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Resultado</label>
                    <select name="call_result_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($callResults as $result)
                            <option value="{{ $result->id }}">{{ $result->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Data e Hora do Chamado</label>
                    <input type="text" name="call_date" class="form-control datetimepicker" required placeholder="dd/mm/aaaa hh:mm:ss">
                </div>

                <div class="col-md-4">
                    <label>Acesso Remoto</label>
                    <div class="form-check form-switch mt-2">
                        <input type="checkbox" name="remote_access" class="form-check-input" role="switch" value="1">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label>Descrição Detalhada do Problema</label>
                    <textarea type="text" name="problem_description" class="form-control" placeholder="Digite os detalhes específicos do problema..."></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label>Observações</label>
                    <textarea name="observation" class="form-control" rows="3" placeholder="Digite suas observações..."></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('calls.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Busca de Servidores -->
<div class="modal fade" id="searchServerModal" tabindex="-1" aria-labelledby="searchServerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchServerModalLabel">Buscar Servidor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" id="serverSearchInput" class="form-control" placeholder="Digite o nome do servidor...">
                        <button type="button" id="searchServerButton" class="btn btn-primary">
                            Pesquisar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="serversTable">
                        <thead>
                            <tr>
                                <th>Nome do Servidor</th>
                                <th>Cliente</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script>
$(document).ready(function() {
    $('.datetimepicker').datetimepicker({
        format: 'd/m/Y H:i:s',
        step: 1,
        lang: 'pt-BR',
        defaultTime: new Date().getHours() + ':' + new Date().getMinutes(),
        defaultDate: new Date()
    });

    // Função para buscar servidores
    function searchServers(query = '') {
        $.ajax({
            url: '/servers/search', // Corrigindo a URL da rota
            type: 'GET',
            data: { query: query },
            success: function(response) {
                let tbody = $('#serversTable tbody');
                tbody.empty();
                
                if (response.servers && response.servers.length > 0) {
                    response.servers.forEach(function(server) {
                        let row = `
                            <tr>
                                <td>${server.name}</td>
                                <td>${server.client_name || '-'}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary select-server" 
                                            data-server-id="${server.id}"
                                            data-server-name="${server.name}">
                                        Selecionar
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="3" class="text-center">Nenhum servidor encontrado</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro na busca:', error);
                $('#serversTable tbody').html('<tr><td colspan="3" class="text-center text-danger">Erro ao buscar servidores</td></tr>');
            }
        });
    }

    // Pesquisa ao clicar no botão
    $('#searchServerButton').click(function(e) {
        e.preventDefault();
        searchServers($('#serverSearchInput').val());
    });

    // Pesquisa ao pressionar Enter no campo de busca
    $('#serverSearchInput').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            searchServers($(this).val());
        }
    });

    // Carregar servidores ao abrir modal
    $('#searchServerModal').on('shown.bs.modal', function() {
        $('#serverSearchInput').val('');
        searchServers();
    });

    // Selecionar servidor
    $(document).on('click', '.select-server', function() {
        let serverName = $(this).data('server-name');
        $('#server_name').val(serverName);
        $('#searchServerModal').modal('hide');
    });
});
</script>
@endsection