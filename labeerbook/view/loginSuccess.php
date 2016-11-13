Vous êtes désormais connecté, <?php echo $context->getSessionAttribute("user")->identifiant; ?>.

<br />

<ul>
	<li><a href="?action=showMessage&idUtilisateur=1">Show messages</a></li>
	<li><a href="?action=showChats">Show chats</a></li>
	<li><a href="?action=showUsers">Show all users</a></li>
</ul>

<button onclick="logout()">Logout</button>
