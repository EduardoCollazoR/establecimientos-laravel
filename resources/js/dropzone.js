const {
  default: axios
} = require("axios");

documen.addEventListener('DOMcontentloaded', () => {


  if (document.querySelector('#dropzone')) {
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone('div#dropzone', {
      url: '/imagenes/store',
      dictDefaultMessage: 'Sube hasta 10 imagenes',
      maxFiles: 10,
      require: true,
      acceptedFiles: ".png,.jpg,.gif",
      addRemoveLinks: true,
      dictRemoveFile: "Eliminar imagen",
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      success: function(file, respuesta) {
        file.nombreServidor = respuesta.archivo;
      },
      sending: function(file, xhr, formData) {
        formData.append('uuid', document.querySelector('#uuid').value);
      },
      removedfile: function(file, respuesta) {
        const params = {
          imagen: file.nombreServidor
        };
        axios.post('/imagenes/destroy', params)
          .then(respuesta => {
            //eliminar del dom
            file.previewElement.parentNode.removeChild(file.previewElement);
          })
      }
    });
  }

})
