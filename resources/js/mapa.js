document.addEventListener('DOMContentLoaded', () => {


  if (document.querySelector('#mapa')) {
    const lat = 20.666332695977;
    const lng = -103.392177745699;

    const mapa = L.map('mapa').setView([lat, lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);

    let marker;

    // agregar el pin
    marker = new L.marker([lat, lng], {
      draggable: true,
      autoPan: true,
    }).addTo(mapa);
    // Geocode service
    const geocodeService = L.esri.Geocoding.geocodeService();
    //detectar movimiento del marker

    marker.on('mouseend', function(e) {
      marker = e.target;

      const posicion = marker.getLatLng;

      // centrar automaticamente
      mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));

      //reverse geocoding, cuando el usuario reubica el pin
      geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado) {
        marker.binPopup(resultado.adress.LongLabel);
        marker.openPopup();

        //llenar los campos
        llenarInputs(resultado);
      })
    });

    function llenarInputs(resultado) {

      document.querySelector('#direccion').value = resultado.adress.Adress || '';
      document.querySelector('#colonia').value = resultado.adress.Neighborhood || '';

      document.querySelector('#lat').value = resultado.latlng.lat || '';
      document.querySelector('#lng').value = resultado.latlng.lng || '';

    }
  }

})
