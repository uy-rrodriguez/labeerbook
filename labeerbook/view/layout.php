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
    <link rel="stylesheet" type="text/css" href="static/chat/chat.css">
</head>
<body>

    <!-- -------------------------------------------------------------------- -->
    <!--                 HEADER                                               -->
    <!-- -------------------------------------------------------------------- -->
    <nav id="navbar-titre" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header text-right">
                <a class="navbar-brand" href="?action=showProfile">labeerbook</a>
            </div>
            <!--
            <div id="signature" class="navbar-collapse collapse text-right">
                <a href="https://fr.wikipedia.org/wiki/Copyleft">@Copyleft</a>
                q.castillo r.rodriguez
            </div>
            -->
        </div>
    </nav>


    <!-- -------------------------------------------------------------------- -->
    <!--                 GRAND CONTENEUR                                      -->
    <!-- -------------------------------------------------------------------- -->
    <div id="tout" class="container" role="main">


        <!-- -------------------------------------------------------------------- -->
        <!--                 BANDEAU MESSAGES                                     -->
        <!-- -------------------------------------------------------------------- -->
        <?php include($nameApp."/view/bandeau.php"); ?>


        <!-- -------------------------------------------------------------------- -->
        <!--                 PROFIL                                               -->
        <!-- -------------------------------------------------------------------- -->
        <div id="profil" class="row">
            <?php include("labeerbook/view/templates/profile.php"); ?>
        </div>

        <div class="row">


            <!-- -------------------------------------------------------------------- -->
            <!--                 MENU GAUCHE                                          -->
            <!-- -------------------------------------------------------------------- -->
            <?php include("labeerbook/view/templates/menu.php"); ?>



            <!-- -------------------------------------------------------------------- -->
            <!--                 MUR OU PAGE ACTUELLE                                 -->
            <!-- -------------------------------------------------------------------- -->
            <div id="contenu" class="col-xs-12 col-sm-8 col-md-6">
                <?php include($template_view); ?>
            </div>


            <!-- -------------------------------------------------------------------- -->
            <!--                 PUUUUB                                               -->
            <!-- -------------------------------------------------------------------- -->
            <div class="hidden-sm col-md-3" style="background-image: url('static/pub/ad-1/water-back.png');">
                <?php //include("labeerbook/view/templates/pub.php"); ?>
            </div>
        </div>
    </div>


    <!-- -------------------------------------------------------------------- -->
    <!--                 FENETRE DE CHAT                                      -->
    <!-- -------------------------------------------------------------------- -->
    <?php include("labeerbook/view/templates/chat.php"); ?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="static/js/jquery-3.1.1.min.js"></script>

    <!-- jQuery UI -->
    <script src="static/js/jquery-ui.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="static/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <!-- AJAX -->
    <script type="text/javascript" src="static/js/ajax.js"></script>
    <script type="text/javascript" src="static/chat/chat.js"></script>
    <script type="text/javascript" src="static/js/labeerbook.js"></script>
</body>
</html>
