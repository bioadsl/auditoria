@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import Reports</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reports.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Select File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection