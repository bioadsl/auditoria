@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Importar Dados</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="csv_file" class="form-label">Arquivo CSV</label>
                    <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                    <div class="form-text">
                        O arquivo deve estar no formato CSV com as seguintes colunas: client_name, agent_name, server_name, action_type, final_status, call_result, problem_description
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Importar</button>
            </form>
        </div>
    </div>
</div>
@endsection