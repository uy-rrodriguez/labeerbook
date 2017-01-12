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
    <link rel="stylesheet" type="text/css" href="static/css/labeerbook.css">
</head>
<body>

    <!-- -------------------------------------------------------------------- -->
    <!--                 HEADER                                               -->
    <!-- -------------------------------------------------------------------- -->
    <nav id="navbar-titre" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="?action=showProfile">labeerbook</a>
            </div>
            <div id="signature" class="navbar-collapse collapse text-right">
                <a href="https://fr.wikipedia.org/wiki/Copyleft">@Copyleft</a>
                q.castillo r.rodriguez
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


        <div class="row">
            <div class="col-xs-0 col-sm-2 col-md-3"></div>

            <!-- -------------------------------------------------------------------- -->
            <!--                 MUR OU PAGE ACTUELLE                                 -->
            <!-- -------------------------------------------------------------------- -->
            <div id="contenu-login" class="col-xs-12 col-sm-8 col-md-6">
                <?php include($template_view); ?>
            </div>

            <div class="col-xs-0 col-sm-2 col-md-3"></div>
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
