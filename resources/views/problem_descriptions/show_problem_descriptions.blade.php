@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalhes da Descrição do Problema</div>

                <div class="card-body">
                    <div class="form-group">
                        <label><strong>ID:</strong></label>
                        <p>{{ $problem_description->id }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Descrição:</strong></label>
                        <p>{{ $problem_description->description }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Criado em:</strong></label>
                        <p>{{ $problem_description->created_at->format('d/m/Y H:i:s') }}</p>
                    </div>

                    <div class="form-group">
                        <label><strong>Atualizado em:</strong></label>
                        <p>{{ $problem_description->updated_at->format('d/m/Y H:i:s') }}</p>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('problem_descriptions.edit', $problem_description->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('problem_descriptions.index') }}" class="btn btn-secondary">Voltar</a>
                        <form action="{{ route('problem_descriptions.destroy', $problem_description->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
// Template para show_problem_descriptions.blade.php
@endsection