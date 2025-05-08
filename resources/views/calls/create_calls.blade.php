@extends('layouts.app')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<style>
.modal-dialog {
    max-width: 800px;
}

.form-control, .form-select {
    height: 38px;
    padding: 0.375rem 0.75rem;
}

.select2-container .select2-selection--single {
    height: 38px;
    line-height: 38px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
}

.btn {
    padding: 0.375rem 0.75rem;
}

.form-switch .form-check-input {
    width: 40px;
    height: 20px;
}

.table td {
    vertical-align: middle;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Novo Chamado</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('calls.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Cliente</label>
                        <select name="client_id" class="form-select select2" required>
                            <option value="">Selecione...</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Agente</label>
                        <select name="agent_id" class="form-select select2" required>
                            <option value="">Selecione...</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('agent_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Servidor</label>
                        <div class="input-group">
                            <input type="text" id="server_input" name="server_name" class="form-control" 
                                   placeholder="Selecione um servidor..." readonly 
                                   value="{{ old('server_name') }}">
                            <input type="hidden" id="server_id" name="server_id" value="{{ old('server_id') }}">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchServerModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        @error('server_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Número do Ticket</label>
                        <input type="text" name="ticket_number" class="form-control" value="{{ old('ticket_number') }}">
                        @error('ticket_number')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tipo de Ação</label>
                        <select name="action_type_id" class="form-select select2" required>
                            <option value="">Selecione...</option>
                            @foreach($actionTypes as $type)
                                <option value="{{ $type->id }}" {{ old('action_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('action_type_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status Final</label>
                        <select name="final_status_id" class="form-select select2" required>
                            <option value="">Selecione...</option>
                            @foreach($finalStatuses as $status)
                                <option value="{{ $status->id }}" {{ old('final_status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('final_status_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Resultado</label>
                        <select name="call_result_id" class="form-select select2" required>
                            <option value="">Selecione...</option>
                            @foreach($callResults as $result)
                                <option value="{{ $result->id }}" {{ old('call_result_id') == $result->id ? 'selected' : '' }}>
                                    {{ $result->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('call_result_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Data e Hora do Chamado</label>
                        <input type="text" name="call_date" class="form-control datetimepicker" 
                               required placeholder="dd/mm/aaaa hh:mm:ss"
                               value="{{ old('call_date') }}">
                        @error('call_date')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Acesso Remoto</label>
                        <div class="form-check form-switch mt-2">
                            <input type="checkbox" name="remote_access" class="form-check-input" 
                                   role="switch" value="1" {{ old('remote_access') ? 'checked' : '' }}>
                        </div>
                        @error('remote_access')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Descrição Detalhada</label>
                        <div class="input-group">
                            <input type="text" id="description_input" name="description_name" 
                                   class="form-control" placeholder="Selecione uma descrição..." 
                                   readonly value="{{ old('description_name') }}">
                            <input type="hidden" id="problem_description_id" 
                                   name="problem_description_id" value="{{ old('problem_description_id') }}">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                    data-bs-target="#searchDescriptionModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        @error('problem_description_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Observações</label>
                        <textarea name="observation" class="form-control" rows="3" 
                                  placeholder="Digite suas observações...">{{ old('observation') }}</textarea>
                        @error('observation')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Salvar
                    </button>
                    <a href="{{ route('calls.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Busca de Servidores -->
<div class="modal fade" id="searchServerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar Servidor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" id="serverSearchInput" class="form-control" 
                               placeholder="Digite o nome do servidor...">
                        <button type="button" id="searchServerButton" class="btn btn-primary">
                            <i class="bi bi-search"></i> Pesquisar
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
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Busca de Descrição -->
<div class="modal fade" id="searchDescriptionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar Descrição</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" id="searchDescription" class="form-control" 
                               placeholder="Digite para pesquisar...">
                        <button type="button" id="searchDescriptionButton" class="btn btn-primary">
                            <i class="bi bi-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="descriptionsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
    // Inicialização do Select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // Configuração do DateTimePicker
    $('.datetimepicker').datetimepicker({
        format: 'd/m/Y H:i:s',
        step: 1,
        lang: 'pt-BR',
        defaultTime: new Date().getHours() + ':' + new Date().getMinutes(),
        defaultDate: new Date(),
        validateOnBlur: true
    });

    // Função para buscar servidores
     // Função para buscar servidores
     function searchServers(query = '') {
        $.ajax({
            url: '{{ route("servers.search") }}',
            type: 'GET',
            data: { query: query },
            beforeSend: function() {
                $('#serversTable tbody').html('<tr><td colspan="3" class="text-center">Carregando...</td></tr>');
            },
            success: function(response) {
                let tbody = $('#serversTable tbody');
                tbody.empty();
                
                if (response.data && response.data.length > 0) {
                    response.data.forEach(function(server) {
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
                            </tr>`;
                        tbody.append(row);
                    });
                } else {
                    tbody.html('<tr><td colspan="3" class="text-center">Nenhum servidor encontrado</td></tr>');
                }
            },
            error: function() {
                $('#serversTable tbody').html('<tr><td colspan="3" class="text-center">Erro ao buscar servidores</td></tr>');
            }
        });
    }

    // Função para buscar descrições
    function searchDescriptions(query = '') {
        $.ajax({
            url: '{{ route("problem-descriptions.search") }}',
            method: 'GET',
            data: { query: query },
            beforeSend: function() {
                $('#descriptionsTable tbody').html('<tr><td colspan="3" class="text-center">Carregando...</td></tr>');
            },
            success: function(response) {
                let tbody = $('#descriptionsTable tbody');
                tbody.empty();
                
                if (response.descriptions && response.descriptions.length > 0) {
                    response.descriptions.forEach(function(description) {
                        let row = `
                            <tr>
                                <td>${description.id}</td>
                                <td>${description.description}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary select-description" 
                                            data-description-id="${description.id}"
                                            data-description-text="${description.description}">
                                        <i class="bi bi-check-lg"></i> Selecionar
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                } else {
                    tbody.append('<tr><td colspan="3" class="text-center">Nenhuma descrição encontrada</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro na busca:', error);
                $('#descriptionsTable tbody').html('<tr><td colspan="3" class="text-center text-danger">Erro ao buscar descrições</td></tr>');
            }
        });
    }

    // Eventos de busca
    $('#searchDescription').on('keyup', function() {
        let query = $(this).val();
        searchDescriptions(query);
    });

    $('#searchServerButton').on('click', function() {
        let query = $('#serverSearchInput').val();
        searchServers(query);
    });

    $('#serverSearchInput').on('keyup', function(e) {
        if (e.key === 'Enter') {
            let query = $(this).val();
            searchServers(query);
        }
    });

    // Eventos de modal
    $('#searchServerModal').on('shown.bs.modal', function() {
        $('#serverSearchInput').val('').focus();
        searchServers();
    });

    $('#searchDescriptionModal').on('shown.bs.modal', function() {
        $('#searchDescription').val('').focus();
        searchDescriptions();
    });

    // Eventos de seleção
    $(document).on('click', '.select-server', function() {
        let serverId = $(this).data('server-id');
        let serverName = $(this).data('server-name');
        $('#server_id').val(serverId);
        $('#server_input').val(serverName);
        $('#searchServerModal').modal('hide');
    });

    $(document).on('click', '.select-description', function() {
        let descriptionId = $(this).data('description-id');
        let descriptionText = $(this).data('description-text');
        $('#problem_description_id').val(descriptionId);
        $('#description_input').val(descriptionText);
        $('#searchDescriptionModal').modal('hide');
    });
});
</script>
@endsection