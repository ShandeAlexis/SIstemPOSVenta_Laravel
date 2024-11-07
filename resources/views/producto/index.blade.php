@extends('template')

@section('title','Productos')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@section('content')

@if (session('success'))
        <script>
            let message = "{{ session('success') }}";
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
@endif
<div class="container-fluid px-4">
    <h1 class="mt-4">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>
    <div class="mb-4">
        <a href="{{ route('productos.create') }}">
            <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla Productos
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Cídigo</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Presentación</th>
                        <th>Categorías</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $item )
                        <tr>
                            <td>
                                {{ $item->codigo }}
                            </td>
                            <td>
                                {{ $item->nombre }}
                            </td>
                            <td>
                                {{ $item->marca->caracteristica->nombre }}
                            </td>
                            <td>
                                {{ $item->presentacione->caracteristica->nombre }}
                            </td>

                            <td>
                               @foreach ($item->categorias as $category)
                                   <div class="container">
                                    <div class="row">
                                        <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{ $category->caracteristica->nombre }}</span>
                                    </div>
                                   </div>
                               @endforeach
                            </td>
                            <td>
                                @if ($item->estado == 1)
                                    <span class="fw-bolder rounded p-1 bg-success text-white">Activo</span>
                                @else
                                <span class="fw-bolder rounded p-1 bg-danger text-white">Eliminado</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-warning">Editar</button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verModal-{{ $item->id }}">Ver</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                  </div>
                            </td>
                        </tr>
                        <!-- modal !-->
                        <div class="modal fade" id="verModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle producto</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="row mb-3">
                                    <label for=""> <span class="fw-bolder">Descripcion :</span> {{ $item->descripcion }}</label>
                                  </div>
                                  <div class="row mb-3">
                                    <label for=""><span class="fw-bolder">Fecha de vencimiento: </span>{{ $item->fecha_vencimiento == '' ? 'No tiene' : $item->fecha_vencimiento }}</label>
                                  </div>
                                  <div class="row mb-3">
                                    <label for=""><span class="fw-bolder">Stock: </span>{{ $item->stock }}</label>
                                  </div>
                                  <div class="row mb-3">
                                    <label for="">Imagen:</label>
                                    <div>
                                        @if ($item->img_path != null)
                                            <img src="{{ Storage::url('app/private/public/productos/'.$item->img_path) }}" alt="">
                                        @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
