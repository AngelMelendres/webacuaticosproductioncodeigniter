/*=============================================
AGREGAR MULTIMEDIA CON DROPZONE
=============================================*/

var arrayFiles = [];

$(".multimediaFisica").dropzone({
  url: "/",
  addRemoveLinks: true,
  acceptedFiles: "image/jpeg, image/png",
  maxFilesize: 2, //2mb
  maxFiles: 10, //maximo 10 archivos
  init: function () {
    this.on("addedfile", function (file) {
      arrayFiles.push(file);

      // console.log("arrayFiles", arrayFiles);
    });

    this.on("removedfile", function (file) {
      var index = arrayFiles.indexOf(file);

      arrayFiles.splice(index, 1);

      // console.log("arrayFiles", arrayFiles);
    });
  },
});
