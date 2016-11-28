<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Encurtador de URL</title>

  <link rel="stylesheet" href="node_modules/ladda/dist/ladda.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

  <style type="text/css">

    input:required:invalid, input:focus:invalid {
      background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAeVJREFUeNqkU01oE1EQ/mazSTdRmqSxLVSJVKU9RYoHD8WfHr16kh5EFA8eSy6hXrwUPBSKZ6E9V1CU4tGf0DZWDEQrGkhprRDbCvlpavan3ezu+LLSUnADLZnHwHvzmJlvvpkhZkY7IqFNaTuAfPhhP/8Uo87SGSaDsP27hgYM/lUpy6lHdqsAtM+BPfvqKp3ufYKwcgmWCug6oKmrrG3PoaqngWjdd/922hOBs5C/jJA6x7AiUt8VYVUAVQXXShfIqCYRMZO8/N1N+B8H1sOUwivpSUSVCJ2MAjtVwBAIdv+AQkHQqbOgc+fBvorjyQENDcch16/BtkQdAlC4E6jrYHGgGU18Io3gmhzJuwub6/fQJYNi/YBpCifhbDaAPXFvCBVxXbvfbNGFeN8DkjogWAd8DljV3KRutcEAeHMN/HXZ4p9bhncJHCyhNx52R0Kv/XNuQvYBnM+CP7xddXL5KaJw0TMAF8qjnMvegeK/SLHubhpKDKIrJDlvXoMX3y9xcSMZyBQ+tpyk5hzsa2Ns7LGdfWdbL6fZvHn92d7dgROH/730YBLtiZmEdGPkFnhX4kxmjVe2xgPfCtrRd6GHRtEh9zsL8xVe+pwSzj+OtwvletZZ/wLeKD71L+ZeHHWZ/gowABkp7AwwnEjFAAAAAElFTkSuQmCC);
      background-position: right top;
      background-repeat: no-repeat;
      -moz-box-shadow: none;
    }
    input:required:valid {
      background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAepJREFUeNrEk79PFEEUx9/uDDd7v/AAQQnEQokmJCRGwc7/QeM/YGVxsZJQYI/EhCChICYmUJigNBSGzobQaI5SaYRw6imne0d2D/bYmZ3dGd+YQKEHYiyc5GUyb3Y+77vfeWNpreFfhvXfAWAAJtbKi7dff1rWK9vPHx3mThP2Iaipk5EzTg8Qmru38H7izmkFHAF4WH1R52654PR0Oamzj2dKxYt/Bbg1OPZuY3d9aU82VGem/5LtnJscLxWzfzRxaWNqWJP0XUadIbSzu5DuvUJpzq7sfYBKsP1GJeLB+PWpt8cCXm4+2+zLXx4guKiLXWA2Nc5ChOuacMEPv20FkT+dIawyenVi5VcAbcigWzXLeNiDRCdwId0LFm5IUMBIBgrp8wOEsFlfeCGm23/zoBZWn9a4C314A1nCoM1OAVccuGyCkPs/P+pIdVIOkG9pIh6YlyqCrwhRKD3GygK9PUBImIQQxRi4b2O+JcCLg8+e8NZiLVEygwCrWpYF0jQJziYU/ho2TUuCPTn8hHcQNuZy1/94sAMOzQHDeqaij7Cd8Dt8CatGhX3iWxgtFW/m29pnUjR7TSQcRCIAVW1FSr6KAVYdi+5Pj8yunviYHq7f72po3Y9dbi7CxzDO1+duzCXH9cEPAQYAhJELY/AqBtwAAAAASUVORK5CYII=);
      background-position: right top;
      background-repeat: no-repeat;
    }

  </style>
</head>
<body style="background-color:powderblue;">
  <div class="container">

    <h2>Encurtador de URL</h2>

    <form id="formShortUrl" class="form-horizontal">

      <div class="form-group">
        <label for="inputOrigemUrl" class="col-sm-2 control-label">Endereço original:</label>
        <div class="col-sm-5">
          <input type="url" required pattern="https?://.+" class="form-control" id="inputOrigemUrl" placeholder="http://exemple.com">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary btn-sm ladda-button btn-request-short-url" data-style="expand-right">
            <span class="ladda-label">Encurtar</span>
          </button>
        </div>
      </div>

      <div id="container-result" class="form-group hide">
        <label for="inputShortUrl" class="col-sm-2 control-label">Endereço encurtado</label>
        <div class="col-sm-5">
          <span id="spanShortUrl"></span>
        </div>
      </div>

    </form>

  </div>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/ladda/dist/spin.min.js"></script>
  <script src="node_modules/ladda/dist/ladda.min.js"></script>

  <script>
    $(function() {

      document.getElementById('formShortUrl').onsubmit= function(e){
        e.preventDefault();
      }

      var lBtn = Ladda.create( document.querySelector( '.btn-request-short-url' ) );

      $('.btn-request-short-url').click(function() {

        var $formShortUrl = $('#formShortUrl');

        if($formShortUrl.is(':valid')) {
          requestShortUrl();
        }

      });

      function requestShortUrl() {
        var $containerResult = $('#container-result');
        var $inputOrigemUrl = $('#inputOrigemUrl');
        var $spanShortUrl = $('#spanShortUrl');

        var origemUrl = $inputOrigemUrl.val();

        $.ajax({
          url: 'php/encurtador.php',
          type: 'POST',
          data: {origemUrl: origemUrl},
          dataType: 'json',
          beforeSend: function(xhr) {
            lBtn.start();
          },
          success: function(result) {

            if(typeof result === 'object' && result.shortUrl != undefined) {
              $spanShortUrl.text(result.shortUrl);
              $containerResult.removeClass('hide');
            } else {
              // alertar error
            }

          },
          error: function(xhr,status,error) {
            // alertar error
          },
          complete(xhr, status) {
            lBtn.stop();
          }
        });
      }

    });
  </script>
</body>
</html>
