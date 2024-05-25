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