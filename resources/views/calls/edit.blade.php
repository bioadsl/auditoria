@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Editar Chamado') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('calls.update', $call) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="client_id" class="col-md-4 col-form-label text-md-end">{{ __('Cliente') }}</label>
                            <div class="col-md-6">
                                <select id="client_id" class="form-control @error('client_id') is-invalid @enderror" name="client_id" required>
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id', $call->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="agent_id" class="col-md-4 col-form-label text-md-end">{{ __('Agente') }}</label>
                            <div class="col-md-6">
                                <select id="agent_id" class="form-control @error('agent_id') is-invalid @enderror" name="agent_id" required>
                                    <option value="">Selecione um agente</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}" {{ old('agent_id', $call->agent_id) == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('agent_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="server_id" class="col-md-4 col-form-label text-md-end">{{ __('Servidor') }}</label>
                            <div class="col-md-6">
                                <input id="server_autocomplete" type="text" class="form-control @error('server_id') is-invalid @enderror" 
                                    placeholder="Digite para buscar um servidor" 
                                    value="{{ $call->server ? $call->server->name . ' (' . $call->server->ip . ')' : '' }}">
                                <input type="hidden" id="server_id" name="server_id" value="{{ old('server_id', $call->server_id) }}">
                                @error('server_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Continue with the rest of the fields following the same pattern -->
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Atualizar') }}
                                </button>
                                <a href="{{ route('calls.index') }}" class="btn btn-secondary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    $(function() {
        $("#server_autocomplete").autocomplete({
            source: "{{ route('autocomplete.servers') }}",
            minLength: 2,
            select: function(event, ui) {
                $("#server_id").val(ui.item.id);
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div>" + item.name + " (" + item.ip + ")</div>")
                .appendTo(ul);
        };
    });
</script>
@endpush