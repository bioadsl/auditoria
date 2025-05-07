@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-white p-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <h5>Nome do Usuário</h5>
                <p>{{ $server->name }}</p>
            </div>

            <div class="col-md-6">
                <h5>Cliente</h5>
                <p>{{ $server->client->name }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('servers.edit', $server->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('servers.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection
// Template para show_servers.blade.php
@endsection