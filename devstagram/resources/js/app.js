import Dropzone from "dropzone";

// Evita que busque automaticamente los elementos con clase Dropzone
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage:'Sube tus imagenes maravillosas aqui',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false
});

dropzone.on('sending', function(file, xhr, formData){
    console.log('Imprimiendo info...');
    console.log(file);
});

dropzone.on('success', function(file, response){
    // Este response viene del imagenes.store
    console.log(response);
});

dropzone.on('error', function(file, message){
    console.log(message);
});