@extends('layouts.app')

@section('content')
<div class="container-fluid px-3">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalhes do Agente</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <p class="form-control-static">{{ $agent->code }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <p class="form-control-static">{{ $agent->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <p class="form-control-static">{{ $agent->active ? 'Ativo' : 'Inativo' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Criado em</label>
                        <p class="form-control-static">{{ $agent->created_at->format('d/m/Y H:i:s') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Atualizado em</label>
                        <p class="form-control-static">{{ $agent->updated_at->format('d/m/Y H:i:s') }}</p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('agents.index') }}" class="btn btn-secondary me-2">Voltar</a>
                        <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection