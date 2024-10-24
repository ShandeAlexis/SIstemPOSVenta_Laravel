@extends('template')

@section('title', 'categorias')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Categorias</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Categorias</li>
        </ol>

        <a href="">
            <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
        </a>
    </div>
@endsection
@push('js')
@endpush
