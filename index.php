<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Short Link - Encurtador de URL's</title>

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="node_modules/ladda/dist/ladda.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/main.css">

</head>
<body>

  <div class="text-center" style="padding:50px 0">
    <div class="logo">Short Link - Encurtador de URL's</div>
    <!-- Main Form -->
    <div class="url-form">
      <form id="short-url-form" class="text-left">
        <div class="etc-url-form">
          <p>Entre abaixo com a url que você deseja encurtar.</p>
        </div>

        <div class="main-url-form">
          <div class="url-group">
            <div class="form-group">
              <label for="origin_full_url" class="sr-only">URL</label>
              <input type="url" class="form-control" id="origin_full_url" name="origin_full_url" placeholder="http://exemple.com" required>
            </div>
          </div>
          <button type="submit" class="submit-button btn-request-short-url" data-style="zoom-in">
              <i class="fa fa-chevron-right"></i>
          </button>
        </div>

        <!--<div class="etc-url-form">
          <p>Seu novo link: <span>link here</span></p>
        </div>-->
        <div class="url-form-main-message hide" id="container_result">
          <p>Seu novo link: <span id="span_short_url"></span></p>
        </div>
      </form>
    </div>
    <!-- end:Main Form -->
  </div>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/ladda/dist/spin.min.js"></script>
  <script src="node_modules/ladda/dist/ladda.min.js"></script>

  <script>
    (function($) {

      "use strict";

      document.getElementById('short-url-form').onsubmit= function(e){
        e.preventDefault();
      }

      var lBtn = Ladda.create( document.querySelector('.btn-request-short-url') );

      $('.btn-request-short-url').click(function() {
        var self = $(this);
        var $shortUrlForm = $('#short-url-form');
        var req;

        if($shortUrlForm.is(':valid')) {
          self.css({'background-color': '#aaaaaa'});

          req = requestShortUrl();

          req.always( function() {
            self.css({'background-color': '#fff'});
          });
        }

      });

      function requestShortUrl() {
        var $containerResult = $('#container_result');
        var $originFullUrl = $('#origin_full_url');
        var $spanShortUrl = $('#span_short_url');

        var origemUrl = $originFullUrl.val();

        return $.ajax({
          url: 'php/encurtador.php',
          type: 'POST',
          data: {origemUrl: origemUrl},
          dataType: 'json',
          beforeSend: function(xhr) {
            lBtn.start();
          },
          success: function(result) {

            if(typeof result === 'object' && result.short_url != undefined) {

              $spanShortUrl.text(result.short_url);
              $containerResult.removeClass('hide').addClass('show success');

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

    })(jQuery);
  </script>
</body>
</html>
