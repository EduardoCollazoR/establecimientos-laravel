@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.css" integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g==" crossorigin="">

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@3.0.4/dist/esri-leaflet.js" integrity="sha512-oUArlxr7VpoY7f/dd3ZdUL7FGOvS79nXVVQhxlg6ij4Fhdc4QID43LUFRs7abwHNJ0EYWijiN5LP2ZRR2PY4hQ==" crossorigin=""></script>

<!-- Load Esri Leaflet Geocoder from CDN -->
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.1/dist/esri-leaflet-geocoder.js" integrity="sha512-enHceDibjfw6LYtgWU03hke20nVTm+X5CRi9ity06lGQNtC9GkBNl/6LoER6XzSudGiXy++avi1EbIg9Ip4L1w==" crossorigin=""></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.min.css" integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('content')
<div class="container">
    <h1 class="text-center mt-4">Editar Establecimiento</h1>
    <div class="mt-5 row justify-content-center">
        <form class="col-md-9 col-xs-12 card card-body" action="{{ route('establecimiento.update',['establecimiento' => $establecimiento->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="border p-4">
                <legend class="text-primaty">Nombre y Categoria e Imagen principal</legend>

                <div class="form=group">
                    <label class="" for="nombre">Nombre Establecimiento</label>
                    <input id="nombre" type="text" name="nombre" class="form-control @error('nombre') is-invalid
                    @enderror" placeholder="Nombre establecimiento" value="{{$establecimiento->nombre}}">
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
                        <option value="{{$categoria->id}}" {{$establecimiento->categoria_id==$categoria->id ? 'selected':''}}>{{ $categoria->nombre}}</option>

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

                    <img style="width:200px; margin-top:20px;" src="/storage/{{$establecimiento->imagen_principal}}">
                </div>

            </fieldset>
            <fieldset class="border p-4 mt-5">
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

                    @enderror" placeholder="Direccion" value="{{$establecimiento->direccion}}" name="direccion">
                    @error('direccion')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <div class="form-group">
                    <label class="colonia">Colonia</label>
                    <input type="text" id="colonia" class="form-control @error('colonia') is-invalid

                    @enderror" placeholder="Colonia" value="{{$establecimiento->colonia}}" name="colonia">
                    @error('colonia')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>

                    @enderror
                </div>

                <input type="hidden" name="lat" id="lat" value="{{$establecimiento->lat}}">
                <input type="hidden" name="lng" id="lng" value="{{$establecimiento->lng}}">
            </fieldset>
            <fieldset class="border p-4 mt-5">
                <legend class="text-primary">Información Establecimiento: </legend>
                <div class="form-group">
                    <label for="nombre">Teléfono</label>
                    <input type="tel" class="form-control @error('telefono')  is-invalid  @enderror" id="telefono" placeholder="Teléfono Establecimiento" name="telefono" value="{{$establecimiento->telefono }}">

                    @error('telefono')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>



                <div class="form-group">
                    <label for="nombre">Descripción</label>
                    <textarea class="form-control  @error('descripcion')  is-invalid  @enderror" name="descripcion">{{ $establecimiento->descripcion }}</textarea>

                    @error('descripcion')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nombre">Hora Apertura:</label>
                    <input type="time" class="form-control @error('apertura')  is-invalid  @enderror" id="apertura" name="apertura" value="{{ $establecimiento->apertura }}">
                    @error('apertura')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nombre">Hora Cierre:</label>
                    <input type="time" class="form-control @error('cierre')  is-invalid  @enderror" id="cierre" name="cierre" value="{{$establecimiento->cierre}}">
                    @error('cierre')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </fieldset>

            </fieldset>
            <fieldset class="border p-4 mt-5">
                <legend class="text-primaty">Imagenes establecimiento:</legend>

                <div class="form=group">
                    <label for="imagenes"></label>
                    <div id="dropzone" class="dropzone form-control"></div>
                </div>

                @if(count($imagenes)>0)
                @foreach ($imagenes as $imagen)

                <input class="galeria" type="hidden" value="{{$imagen->ruta_imagen}}">

                @endforeach
                @endif
            </fieldset>

            <input type="hidden" id="uuid" name="uuid" value="{{$establecimiento->uuid}}">
            <input type="submit" class="btn btn-primary mt-3 d-block" value="Guardar cambios">
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>

@endsection
