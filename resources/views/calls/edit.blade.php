@extends('layouts.app')

@section('content')
<div class="bg-primary text-white">
</div>

<div class="container">
    <div class="bg-white p-3">
        <form action="{{ url('/calls/' . $call->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Cliente</label>
                    <select id="client_id" name="client_id" class="form-select text-truncate" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id', $call->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Agente</label>
                    <select id="agent_id" name="agent_id" class="form-select" required>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ old('agent_id', $call->agent_id) == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Servidor</label>
                    <input type="text" id="server_search" class="form-control" placeholder="Buscar servidor..." 
                           value="{{ $call->server ? $call->server->name : '' }}">
                    <input type="hidden" id="server_id" name="server_id" value="{{ old('server_id', $call->server_id) }}">
                </div>

                <div class="col-md-6">
                    <label>Número do Ticket</label>
                    <input type="text" id="ticket_number" name="ticket_number" class="form-control" 
                           value="{{ old('ticket_number', $call->ticket_number) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Tipo de Ação</label>
                    <select id="action_type_id" name="action_type_id" class="form-select" required>
                        @foreach($actionTypes as $type)
                            <option value="{{ $type->id }}" {{ old('action_type_id', $call->action_type_id) == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Status Final</label>
                    <select id="final_status_id" name="final_status_id" class="form-select" required>
                        @foreach($finalStatuses as $status)
                            <option value="{{ $status->id }}" {{ old('final_status_id', $call->final_status_id) == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Resultado</label>
                    <select id="call_result_id" name="call_result_id" class="form-select" required>
                        @foreach($callResults as $result)
                            <option value="{{ $result->id }}" {{ old('call_result_id', $call->call_result_id) == $result->id ? 'selected' : '' }}>
                                {{ $result->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Fix Remote Access switch -->
                <div class="col-md-6">
                    <label>Acesso Remoto</label>
                    <div class="form-check form-switch">
                        <input type="checkbox" id="remote_access" name="remote_access" 
                               class="form-check-input" role="switch"
                               value="1" {{ old('remote_access', $call->remote_access) ? 'checked' : '' }}>
                        <label class="form-check-label" for="remote_access">Ativado</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label>Descrição do Problema</label>
                    <input type="text" id="problem_description_search" class="form-control" placeholder="Buscar descrição..." 
                           value="{{ $call->problemDescription ? $call->problemDescription->description : '' }}">
                    <input type="hidden" id="problem_description_id" name="problem_description_id" 
                           value="{{ old('problem_description_id', $call->problem_description_id) }}">
                </div>
            </div>

            <!-- Move Observations to the bottom -->
            <div class="row mb-3">
                <div class="col-12">
                    <label>Observações</label>
                    <textarea id="observation" name="observation" class="form-control" 
                              rows="3">{{ old('observation', $call->observation) }}</textarea>
                </div>
            </div>

            <!-- Single set of buttons -->
            <div class="mt-4">
                <a href="{{ route('calls.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<style>
.form-control, .form-select {
    height: 38px;
    padding: 0.375rem 0.75rem;
}
.form-select {
    padding-right: 2rem;
}
textarea.form-control {
    height: auto;
    min-height: 100px;
}
.form-check-input[type="checkbox"] {
    width: 40px;
    height: 20px;
}
.btn {
    padding: 0.375rem 1rem;
}
</style>
<!-- Keep your existing modals here -->
@endsection

<style>
.bg-primary {
    background-color: #1a237e !important;
}
.bg-blue {
    background-color: #0d6efd;
}
.form-control, .form-select {
    height: 35px;
    padding: 0.25rem 0.5rem;
}
textarea.form-control {
    height: auto;
}
.form-switch .form-check-input {
    width: 40px;
    height: 20px;
    margin-top: 2px;
}
.btn {
    padding: 0.25rem 1rem;
}
label {
    margin-bottom: 0.25rem;
    font-weight: normal;
}
</style>

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

<!-- In the form, update the server and problem description fields -->
<div class="row mb-3">
    <div class="col-md-6">
        <label>Servidor</label>
        <select id="server_search" class="form-select" style="width: 100%">
            @if($call->server)
                <option value="{{ $call->server->id }}" selected>{{ $call->server->name }}</option>
            @endif
        </select>
        <input type="hidden" id="server_id" name="server_id" value="{{ old('server_id', $call->server_id) }}">
    </div>
    <div class="col-12">
        <label>Descrição do Problema</label>
        <select id="problem_description_search" class="form-select" style="width: 100%">
            @if($call->problemDescription)
                <option value="{{ $call->problemDescription->id }}" selected>{{ $call->problemDescription->description }}</option>
            @endif
        </select>
        <input type="hidden" id="problem_description_id" name="problem_description_id" value="{{ old('problem_description_id', $call->problem_description_id) }}">
    </div>
</div>

@section('scripts')
<!-- Add after your existing scripts -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#server_search').select2({
        placeholder: 'Buscar servidor...',
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("autocomplete.servers") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    })
                };
            }
        }
    }).on('select2:select', function(e) {
        $('#server_id').val(e.params.data.id);
    });

    $('#problem_description_search').select2({
        placeholder: 'Buscar descrição...',
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("autocomplete.problem-descriptions") }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term
                };
            },
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.description
                        };
                    })
                };
            }
        }
    }).on('select2:select', function(e) {
        $('#problem_description_id').val(e.params.data.id);
    });
});
</script>
@endsection