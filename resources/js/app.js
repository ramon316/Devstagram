// If you are using JavaScript/ECMAScript modules:
import Dropzone from "dropzone";

// If you are using an older version than Dropzone 6.0.0,
// then you need to disabled the autoDiscover behaviour here:
Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //aqui vamos agregar el código para mantener el valor de la imagen 
    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
            //este lo tiene que traer pero no tiene que ser verdadero
            imagenPublicada.size =1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;
            //call se inicializa cuando lo mandamos llamar
            this.options.addedfile.call(this, imagenPublicada);
            
            this.options.thumbnail.call(
                this,
                imagenPublicada,`/uploads/${imagenPublicada.name}`
            );
            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete",
            );
        }
    }
});

dropzone.on('sending', function(file, xhr, formData){
   console.log(file);
});

dropzone.on('success', function(file, response){
//console.log(response.imagen);
//vamos asignarle el nombre de nuestra imagen a nuestro input hidden
document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('error',function(file,message){
    console.log('error en la imagen');
});

//eliminar el nombre del input cuando se elimina la imagen
dropzone.on('removedfile',function(){
    document.querySelector('[name="imagen"]').value = "";
})