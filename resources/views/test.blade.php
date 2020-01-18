<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dropzone Test</title>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <style media="screen">
    body {
            background: rgb(243, 244, 245);
            height: 100%;
            color: rgb(100, 108, 127);
            line-height: 1.4rem;
            font-family: Roboto, "Open Sans", sans-serif;
            font-size: 20px;
            font-weight: 300;
            text-rendering: optimizeLegibility;
          }

          h1 { text-align: center; }

          #dropzone {
            background: white;
            border-radius: 20px;
            border: 2px dashed rgb(142, 142, 142);
            border-image: none;
            max-width: 500px;
            height: 500px;
            margin-left: auto;
            margin-right: auto;
            padding: 30px;
            text-align: center;
            position: relative;
            display: inline-flex;
            align-items: center;
          }
          .dropzone .dz-preview .dz-image {
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            height: 100%;
            position: relative;
            display: block;
            z-index: 10;
        }
        .dropzone {
            min-height: 150px;
            border: 0;
            background: white;
            padding: 20px 20px;
        }
    </style>
  </head>
  <body>
    <section id="demo_dropzone" class="mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-0">
            <div class="card">
              <h5 class="card-header">Dropzone</h5>
              <div class="card-body">
                <h1>DropzoneJS File Upload Demo</h1>
                <section>
                  <div id="dropzone">
                    <form class="dropzone needsclick" id="demo-upload" action="/upload">
                      <div class="dz-message needsclick">
                        Drop files here or click to upload.<br>
                        <span class="note needsclick mt-2 mb-2">
                          <i class="fas fa-camera fa-2x"></i>
                        </span>
                      </div>
                    </form>
                  </div>
                </section>

                <br/>
                <hr size="3" noshade color="#F00000">



                <div id="preview-template" style="display: none;">
                  <div class="dz-preview dz-file-preview">
                    <div class="dz-image">
                      <IMG data-dz-thumbnail="">
                    </div>
                    <div class="dz-details">
                      <div class="dz-size">
                        <SPAN data-dz-size=""></SPAN>
                      </div>
                      <div class="dz-filename">
                        <SPAN data-dz-name=""></SPAN>
                      </div>
                    </div>
                    <div class="dz-progress">
                      <SPAN class="dz-upload" data-dz-uploadprogress=""></SPAN>
                    </div>
                    <div class="dz-error-message">
                      <SPAN data-dz-errormessage=""></SPAN>
                    </div>
                    <div class="dz-success-mark">
                      <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                        <title>Check</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                            <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                        </g>
                      </svg>
                    </div>
                    <div class="dz-error-mark">
                      <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                          <title>error</title>
                          <desc>Created with Sketch.</desc>
                          <defs></defs>
                          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                              <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                  <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                              </g>
                          </g>
                      </svg>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <form action="{{ route('seller.store') }}" enctype="multipart/form-data" method="POST">
                <input type="text" id ="firstname" name ="firstname" />
                <input type="text" id ="lastname" name ="lastname" />
                <div class="dropzone" id="myDropzone" style="border: 2px solid #eee;">
                  <h6>Drag and drop</h6>
                </div>
                <button type="submit" id="submit-all"> upload </button>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    Dropzone.autoDiscover = false;
    var dropzone = new Dropzone('#demo-upload', {
      url: '{{ route("seller.store") }}',
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
      addRemoveLinks: true,
      previewTemplate: document.querySelector('#preview-template').innerHTML,
      parallelUploads: 2,
      thumbnailHeight: 220,
      thumbnailWidth: 220,
      maxFilesize: 3,
      filesizeBase: 1000,
      thumbnail: function(file, dataUrl) {
        if (file.previewElement) {
          file.previewElement.classList.remove("dz-file-preview");
          var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
          for (var i = 0; i < images.length; i++) {
            var thumbnailElement = images[i];
            thumbnailElement.alt = file.name;
            thumbnailElement.src = dataUrl;
          }
          setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
        }
      }

      });


      // Now fake the file upload, since GitHub does not handle file uploads
      // and returns a 404

      var minSteps = 6,
        maxSteps = 60,
        timeBetweenSteps = 100,
        bytesPerStep = 100000;

      dropzone.uploadFiles = function(files) {
      var self = this;

      for (var i = 0; i < files.length; i++) {

        var file = files[i];
        totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

        for (var step = 0; step < totalSteps; step++) {
          var duration = timeBetweenSteps * (step + 1);
          setTimeout(function(file, totalSteps, step) {
            return function() {
              file.upload = {
                progress: 100 * (step + 1) / totalSteps,
                total: file.size,
                bytesSent: (step + 1) * file.size / totalSteps
              };

              self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
              if (file.upload.progress == 100) {
                file.status = Dropzone.SUCCESS;
                self.emit("success", file, 'success', null);
                self.emit("complete", file);
                self.processQueue();
                //document.getElementsByClassName("dz-success-mark").style.opacity = "1";
              }
            };
          }(file, totalSteps, step), duration);
        }
      }
      }
    </script>
    <script type="text/javascript">
    Dropzone.autoDiscover = false;
      Dropzone.options.myDropzone= {
        url: '{{ route("seller.store") }}',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 5,
        maxFilesize: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        init: function() {
            dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

            // for Dropzone to process the queue (instead of default form behavior):
            document.getElementById("submit-all").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                dzClosure.processQueue();
            });

            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
                formData.append("firstname", jQuery("#firstname").val());
                formData.append("lastname", jQuery("#lastname").val());
            });
        }
      }
    </script>
  </body>
</html>
