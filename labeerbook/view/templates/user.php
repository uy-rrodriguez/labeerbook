<?php
	/*//*//*/
		Auteur : Q.CASTILLO (TP 3)
        Modifications finales : R.RODRIGUEZ (TP 4)
	/*//*//*/

	$userTemplate = $context->getSessionAttribute("userTemplate");
    $AVATAR_FOLDER = "upload/avatar";
?>

<div class="item-liste-users col-xs-6 col-sm-4">
    <a href="?action=showProfile&idProfile=<?php echo $userTemplate->id; ?>">
        <div class="row">

            <div class="col-xs-12">
                <object class="img img-responsive" type="image/png"
                        data="static/img/def-avatars/user (<?php echo ($userTemplate->id % 15) + 1; ?>).png">

                    <img src="<?php echo $AVATAR_FOLDER . "/" . $userTemplate->avatar; ?>"
                        alt="Image de profil de l'ami">

                </object>
            </div>

            <div class="col-xs-12 text-center">
                <?php echo $userTemplate->identifiant; ?>
            </div>
        </div>
    </a>
</div>


