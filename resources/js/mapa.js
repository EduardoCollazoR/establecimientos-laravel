import {
  OpenStreetMapProvider
} from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();
document.addEventListener('DOMContentLoaded', () => {


  if (document.querySelector('#mapa')) {
    const lat = 20.666332695977;
    const lng = -103.392177745699;

    const mapa = L.map('mapa').setView([lat, lng], 16);

    //eliminar piner previos
    let markers = new L.FeatureGroup().addTo(mapa);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);

    let marker;

    // agregar el pin
    marker = new L.marker([lat, lng], {
      draggable: true,
      autoPan: true,
    }).addTo(mapa);

    //agregar pin a las capa

    markers.addLayer(marker);

    // Geocode service
    const geocodeService = L.esri.Geocoding.geocodeService({
      apikey: 'AAPK51ced614021e4f21af74daf27277b9f5Uxuq7m36qAPjugjTTIH38HvZAwYkiFgxukCV8IzccfHzRAbKGXry7Uhwc7VcBj0X'
    });

    // buscador de direcciones
    const buscador = document.querySelector('#formbuscador');
    buscador.addEventListener('blur', buscadorDireccion);

    //detectar movimiento del marker

    reubicarPin(marker);

    function reubicarPin(marker) {
      marker.on('moveend', function(e) {
        marker = e.target;


        const posicion = marker.getLatLng();

        // centrar automaticamente
        mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));

        //reverse geocoding, cuando el usuario reubica el pin
        geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado) {

          marker.bindPopup(resultado.address.LongLabel);
          marker.openPopup();

          //llenar los campos
          llenarInputs(resultado);

        })
      });
    }

    function buscarDireccion(e) {
      if (e.target.value.length > 10) {
        provider.search({
            query: e.target.value + ' Tijuana MX '
          })
          .then(resultado => {
            if (resultado[0]) {

              //limpiar los pines previos

              markers.clearLayers();
              //reverse geocoding, cuando el usuario reubica el pin
              geocodeService.reverse().latlng(resultado[0].bounds[0], 16).run(function(error, resultado) {



                //llenar los campos
                llenarInputs(resultado);

                mapa.setView(resultado.latlng);

                // agregar el pin
                marker = new L.marker(resultado.latlng, {
                  draggable: true,
                  autoPan: true,
                }).addTo(mapa);

                //asignar el contener de markers el nuevo pin
                markers.addLayer(marker);

                reubicarPin(marker);

              })
            }
          })
      }
    }

    function llenarInputs(resultado) {

      document.querySelector('#direccion').value = resultado.address.Address || '';
      document.querySelector('#colonia').value = resultado.address.Neighborhood || '';

      document.querySelector('#lat').value = resultado.latlng.lat || '';
      document.querySelector('#lng').value = resultado.latlng.lng || '';

    }
  }

})
