@extends('layouts.app')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                    <input type="text" id="server_search" class="form-control" placeholder="Buscar servidor...">
                    <input type="hidden" id="server_id" name="server_id">
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
                <div class="col-md-6">
                    <label>Resultado</label>
                    <select name="call_result_id" class="form-select" required>
                        <option value="">Selecione...</option>
                        @foreach($callResults as $result)
                            <option value="{{ $result->id }}">{{ $result->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Acesso Remoto</label>
                    <div class="form-check form-switch mt-2">
                        <input type="checkbox" name="remote_access" class="form-check-input" role="switch" value="1">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label>Descrição do Problema</label>
                    <input type="text" id="problem_description_search" class="form-control" placeholder="Buscar descrição...">
                    <input type="hidden" id="problem_description_id" name="problem_description_id">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label>Observações</label>
                    <textarea name="observation" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('calls.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#server_search').autocomplete({
        source: function(request, response) {
            $.get('{{ route("autocomplete.servers") }}', {
                search: request.term
            }).done(function(data) {
                response(data.map(function(item) {
                    return {
                        label: item.name,
                        value: item.id
                    };
                }));
            });
        },
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $('#server_id').val(ui.item.value);
        }
    });

    $('#problem_description_search').autocomplete({
        source: function(request, response) {
            $.get('{{ route("autocomplete.problem-descriptions") }}', {
                search: request.term
            }).done(function(data) {
                response(data.map(function(item) {
                    return {
                        label: item.description,
                        value: item.id
                    };
                }));
            });
        },
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $('#problem_description_id').val(ui.item.value);
        }
    });
});
</script>
@endsection
