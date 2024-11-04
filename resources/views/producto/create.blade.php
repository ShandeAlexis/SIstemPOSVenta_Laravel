@extends('template')

@section('title','Crear Producto')

@push('css')
<style>
    #descripcion{
        resize: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    <h1 class="mt-4">Crear Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Producto</a></li>
        <li class="breadcrumb-item active">Crear producto</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6 mb-2">
                <label for="codigo" class="form-label"> Codigo: </label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo')}}">
                @error('codigo')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="nombre" class="form-label"> Nombre: </label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre')}}">
                @error('nombre')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>


            <div class="col-md-12 mb-2">
                <label for="descripcion" class="form-label"> Descripcion: </label>
                <textarea name="descripcion" id="descripcion" cols="10" rows="3" class="form-control" value="{{ old('descripcion') }}"></textarea>
                @error('descripcion')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="fecha_vencimiento" class="form-label"> Fecha de vencimiento: </label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento')}}">
                @error('fecha_vencimiento')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-2">
                <label for="img_path" class="form-label"> Imagen: </label>
                <input type="file" name="img_path" id="img_path" class="form-control" accept="Image/*" >
                @error('img_path')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>


            <div class="col-md-6 mb-2">
                <label for="marca_id" class="form-label"> Marca: </label>
                <select data-live-search="true" name="marca_id" id="marca_id" class="form-control selectpicker show-tick"  title="Escoga una marca..." data-size="4">
                    @foreach ($marcas as $item)
                        <option value="{{ $item->id }}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                    @endforeach
                </select>
                @error('marca_id')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>


            <div class="col-md-6 mb-2">
                <label for="presentacione_id" class="form-label"> Presentacion: </label>
                <select data-live-search="true" name="presentacione_id" id="presentacione_id" class="form-control selectpicker show-tick"  title="Escoga una presentación..." data-size="4">
                    @foreach ($presentaciones as $item)
                        <option value="{{ $item->id }}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                    @endforeach
                </select>
                @error('presentacione_id')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>


            <div class="col-md-6 mb-2">
                <label for="categorias" class="form-label"> Categoria: </label>
                <select data-live-search="true" name="categorias[]" id="categorias" class="form-control selectpicker show-tick"  title="Escoga una categoria..." data-size="4" multiple>
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id, old('categorias',[])) ? 'selected' : '' }}>{{ $item->nombre }}</option>
                    @endforeach
                </select>
                @error('categorias')
                <small class="text-danger">{{ '*'.$message }}</small>
                @enderror
            </div>


            <div class="col-12 text-center ">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>



        </div>
        </form>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

@endpush