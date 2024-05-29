import Dropzone from "dropzone";

// Evita que busque automaticamente los elementos con clase Dropzone
Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube tus imagenes maravillosas aqui",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('input[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector(
                'input[name="imagen"]'
            ).value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

/* dropzone.on('sending', function(file, xhr, formData){
    console.log('Imprimiendo info...');
    console.log(file);
}); */

dropzone.on("success", function (file, response) {
    // Este response viene del imagenes.store
    //console.log(response);

    // Le asigna el nombre de la imagen al form de post
    document.querySelector('input[name="imagen"]').value = response.imagen;
});

dropzone.on("removedfile", function(){
    document.querySelector('input[name="imagen"]').value = '';
});

dropzone.on("error", function (file, message) {
    console.log(message);
});
