URL de l'application :

https://pedago.univ-avignon.fr/~uapv1403752/LaBeerBook/



Ce readme, créé en fin de projet, va indiquer les points importants réalisés au cours de ce projet.


---------------------------
Fonctionnalités ajoutées
---------------------------

Notre site, LaBeerBook, a remplit les exigences demandées durant les TP.


Connexion :
	Lors de l'ouverture du projet, une page de connexion s'affiche. Celle-ci demande un login ainsi qu'un mot de passe. En cas d'erreur,
	un message "Login incorrect !" s'écrit dans un bandeau de notification en haut de l'écran.


Menu principal :
	Lorsque la connexion est effectuée, on utilise le login entré pour directement afficher le profil de l'utilisateur. On a donc un avatar, un pseudo, un nom/prenom, un statut et un textarea qui permet de publier sur son propre mur. Cela compose donc la partie profil de l'utilsateur.

	En dessous, nous retrouvons les options possibles (liste d'amis, deconnexion, modification statut, etc, ...) ainsi que notre mur, qui contient tous les messages dont l'utilisateur est le destinataire.


Gestion de Bootstrap :

	Sur l'ensemble des pages, la gestion de Bootstrap est faite, sur la page d'accueil par exemple, le menu contextuel qui est sur la gauche en plein ecran se trouve sur un bouton cliquable quand la fenetre est réduite. Ainsi, la fenetre ne comprend plus que les données du profil et les messages en dessous.


Options possibles dans le menu :
		Liste d'amis :
			Lorsqu'on accède à la liste d'amis, un tableau s'affiche, contenant l'avatar de l'ami ainsi que son pseudo. La zone contenant l'ami est cliquable et permet ainsi d'accéder à son profil, contenant ses données et les messages qui lui sont destinés.
            À partir de ce qui a été demandé en cours de TP, on affiche la liste d'amis sur une colonne du layout, dans notre cas à droite. Cette liste est visible que si la taille de l'écran est "md" ou supérieur. Dans les autres cas (xs et sm), on affiche une option sur le menu à gacuhe qui permet de voir la liste d'amis.

		Éditer profil :
			Cette page devait en premier lieu nous permettre de modifier l'ensemble des données de l'utilisateur mais l'accès n'est pas autorisé par la BDD. Nous ne pouvons donc modifier que le statut.

            NOTE : Nous n'avons pas implémenté la mise-à-jour de la photo de profil.

		Accueil :
			Permet d'être redirigé vers le profil de l'utilisateur.

		Se déconnecter :
			Permet de fermer la session et d'être redirigé vers l'écran de connexion.




-----------------------
Partage des tâches
-----------------------

Pour se partager le travail, nous avons fait en sorte de suivre les indications du
TP. Pour chaques méthodes créées, nous avons mit un commentaire indiquant l'auteur ainsi qu'une
courte description de ce que fait la méthode.

En particulier, pour ce rendu final le partage de tâches a été fait comme suit :

    Q. Castillo
        Gestion des messages sur le mur
        Gestion du profil utilisateur

    R. Rodríguez
        Gestion de la liste d'amis et profil des amis.
        Gestion du chat


-----------------------
Le chat
-----------------------

En ce qui concerne le chat, celui comporte plusieurs fonctionnalités. Quelques unes demandés dans le sujet de TP, d'autres ajoutées.
Tout le code JavaScript associé au chat se trouve dans une classe Chat, définie dans le fichier static/chat/chat.js. La classe définie plusieurs fonctions internes pour simplifier la réutilisation.
Les styles CSS associés aux éléments du chat se trouvent dans static/chat/chat.css. Entre autres, nous y avons déclaré les animations utilisées pour minimiser et maximiser la fenêtre.

Resize
    La fenêtre de chat peut être rédimensionée grâce à la fonction resize de JQuery UI. Nous avons défini deux handlers qui permettent de changer la taille du div, dans les coin haut-gauche et bas-droite.

Minimiser / Maximiser
    Au début, la fenêtre de chat est minimisée. En cliquant sur le div on peut l'agrandir afin de voir les messages qui ont été envoyés. Le chat maximisé prend une taille par défaut ou la dernière taille établie avec Resize.

Drag
    Le chat se trouve dans un div positioné de manière absolue par rapport à toute la page. En cliquant sur le mot "Chat" on peut le déplacer librement. Cette fonctionnalité utilise la méthode Draggable de JQuery UI.

Notification
    La classe Chat définie une intervalle qui ira chercher toutes les X secondes les derniers messages publiés dans le chat. Si la fenêtre est minimisé, on verra une animation CSS qui indiaue la réception d'un nouveau message de chat. Si la fenêtre est maximisée, on verra la même animation et ensuite les derniers messages seront affichés à la fin du contenu du chat.

Envoi de messages
    Pour envoyer un message de chat, il suffit d'écrire le message et cliquer sur le bouton Send. On peut aussi faire [Entrer] pour l'envoyer. Si on veut insérer un saut de ligne dans notre message, il faut utiliser la combinaison de touches [Ctrl]+[Entrer].
