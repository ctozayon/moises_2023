  document.getElementById("uploadButton").addEventListener("click", function() {
    console.log("Botão de upload clicado");
    var dropzone = new Dropzone.forElement("awsDropzone")
    dropzone.processQueue();
  });

