documen.addEventListener('DOMcontentloaded', () => {


  if (document.querySelector('#dropzone')) {
    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone('div#dropzone', {
      url: '/imagenes/store',
      dictDefaultMessage: 'Sube hasta 10 imagenes',
      maxFiles: 10,
      require: true,
      acceptedFiles: ".png,.jpg,.gif",
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });
  }

})
