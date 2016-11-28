<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>La Beer Book</title>

    <!-- Bootstrap -->
    <link href="static/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style personnels -->
    <link rel="stylesheet" type="text/css" href="static/css/labeerbook.css-">

    <style>
      body {
        padding-top: 70px;
        padding-bottom: 30px;
      }
    </style>
  </head>
  <body>

    <!-- -------------------------------------------------------------------- -->
    <!--                 HEADER                                               -->
    <!-- -------------------------------------------------------------------- -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">LaBeerBook</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse text-right" style="color: white;">
          Réalisé par Ricardo Rodriguez et Quentin Castillo
        </div>
      </div>
    </nav>


    <!-- -------------------------------------------------------------------- -->
    <!--                 GRAND CONTENEUR                                      -->
    <!-- -------------------------------------------------------------------- -->
    <div class="container" role="main">

      <!-- -------------------------------------------------------------------- -->
      <!--                 BANDEAU MESSAGES                                     -->
      <!-- -------------------------------------------------------------------- -->
      <?php include($nameApp."/view/bandeau.php"); ?>


      <!-- -------------------------------------------------------------------- -->
      <!--                 PROFIL                                               -->
      <!-- -------------------------------------------------------------------- -->
      <div class="row">
        <div class="col-sm-3" style="background-color: black;">
          <img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" style="width: 200px; height: 200px;"
               src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzIwMHgyMDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNThhYWU0NTdjZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1OGFhZTQ1N2NkIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjczLjUiIHk9IjEwNC44Ij4yMDB4MjAwPC90ZXh0PjwvZz48L2c+PC9zdmc+"
               data-holder-rendered="true">
        </div>
        <div class="col-sm-6" style="background-color: red;">
          Nom prenom <br/>
          Age
        </div>
        <div class="col-sm-3 hidden-xs" style="">h3</div>
      </div>


      <div class="row">

        <!-- -------------------------------------------------------------------- -->
        <!--                 MENU GAUCHE                                          -->
        <!-- -------------------------------------------------------------------- -->
        <div class="col-sm-3" style="background-color: red;">
          <ul>
            <li>Option 1</li>
            <li>Option 2</li>
            <li>Option 3</li>
          </ul>
        </div>


        <!-- -------------------------------------------------------------------- -->
        <!--                 MUR OU PAGE ACTUELLE                                 -->
        <!-- -------------------------------------------------------------------- -->
        <div class="col-sm-6" style="background-color: green;">
          <h1>Contenu de la page</h1>

          <?php include($template_view); ?>
        </div>


        <!-- -------------------------------------------------------------------- -->
        <!--                 PUUUUB                                               -->
        <!-- -------------------------------------------------------------------- -->
        <div class="col-sm-3 hidden-xs" style="background-color: blue;">
          <h1>3</h1>
        </div>
      </div>

    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="static/js/jquery-3.1.1.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="static/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <!-- AJAX -->
    <script type="text/javascript" src="static/js/ajax.js"></script>
  </body>
</html>
