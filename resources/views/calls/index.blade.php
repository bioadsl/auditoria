@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chamados</h1>
    
    <div class="mb-3">
        <a href="{{ route('calls.create') }}" class="btn btn-primary">Novo Chamado</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('calls.index') }}" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cliente</label>
                            <select name="client_id" class="form-control">
                                <option value="">Todos</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Agente</label>
                            <select name="agent_id" class="form-control">
                                <option value="">Todos</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ request('agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data Início</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Data Fim</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('calls.index') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Cliente</th>
                        <th>Agente</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calls as $call)
                    <tr>
                        <td>{{ $call->ticket_number }}</td>
                        <td>{{ $call->client->name }}</td>
                        <td>{{ $call->agent->name }}</td>
                        <td>{{ $call->call_date->format('d/m/Y H:i') }}</td>
                        <td>{{ $call->finalStatus->name }}</td>
                        <td>
                            <a href="{{ route('calls.show', $call) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('calls.edit', $call) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('calls.destroy', $call) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $calls->links() }}
        </div>
    </div>
</div>
@endsection