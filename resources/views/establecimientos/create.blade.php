@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@3.0.4/dist/esri-leaflet.js" integrity="sha512-oUArlxr7VpoY7f/dd3ZdUL7FGOvS79nXVVQhxlg6ij4Fhdc4QID43LUFRs7abwHNJ0EYWijiN5LP2ZRR2PY4hQ==" crossorigin=""></script>

<!-- Load Esri Leaflet Geocoder from CDN -->
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js" integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w==" crossorigin=""></script>

@endsection

@section('content')
<div class="container">
    <h1 class="text-center mt-4">Registrar Establecimiento</h1>
    <div class="mt-5 row justify-content-center">
        <form class="col-md-9 col-xs-12 card card-body">

            <fieldset class="border p-4">
                <legend class="text-primaty">Nombre y Categoria e Imagen principal</legend>

                <div class="form=group">
                    <label class="" for="nombre">Nombre Establecimiento</label>
                    <input id="nombre" type="text" name="nombre" class="form-control @error('nombre') is-invalid
                    @enderror" placeholder="Nombre establecimiento" value="{{old('nombre')}}">
                    @error('nombre')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror

                    </input>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select class="form-control" name="categoria_id" ype="text" name="nombre" class="form-control @error('categoria_id') is-invalid
                    @enderror" id="categoria">
                        <option value="" selected disabled>--Seleccione--</option>
                        @foreach ($categorias as $categoria )
                        <option value="{{$categoria->id}}" {{old('categoria_id')==$categoria->id ? 'selected':''}}>{{ $categoria->nombre}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="form=group">
                    <label class="" for="imagen_principal">Imagen principal</label>
                    <input id="imagen_principal" type="file" name="imagen_principal" class=" form-control @error('imagen_principal') is-invalid @enderror" value="{{old('imagen_principal')}}">
                    @error('imagen_principal')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror

                    </input>
                </div>

            </fieldset>
            <fieldset class="border p-4">
                <legend class="text-primaty">Ubicacion:</legend>

                <div class="form=group">
                    <label class="" for="formbuscador">Direccion del Establecimiento</label>
                    <input id="formbuscador" type="text" class="form-control" placeholder="Calle del negocio">


                    </input>
                    <p class="text-secondary mt-5 mb-3 text-center">El asistente colocara una dirección estimada, mueve el pin hacia el lugar correcto </p>
                </div>


                <div class="form-group">
                    <div id="mapa" style="height:400px;"></div>
                </div>

                <p class="informacion">Confirma que los siguientes campos son correctos</p>
                <div class="form-group">
                    <label class="direccion">Direccion</label>
                    <input type="text" id="direccion" class="form-control @error('direccion') is-invalid

                    @enderror" placeholder="Direccion" value="{{old('direccion')}}">
                    @error('direccion')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <div class="form-group">
                    <label class="colonia">Colonia</label>
                    <input type="text" id="colonia" class="form-control @error('colonia') is-invalid

                    @enderror" placeholder="Colonia" value="{{old('colonia')}}">
                    @error('colonia')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <input type="hidden" name="lat" id="lat" value="{{old('lat')}}">
                <input type="hidden" name="lng" id="lng" value="{{old('lng')}}">
            </fieldset>
        </form>
    </div>
</div>
@endsection

@section('scripts')

@endsection
