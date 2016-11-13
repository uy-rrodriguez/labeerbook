Vous êtes désormais connecté, <?php echo $context->getSessionAttribute("user")->identifiant; ?>.

<br />

<ul>
	<li><a href="?action=showMessage">Show messages</a></li>
	<li><a href="?action=showChats">Show chats</a></li>
</ul>

<button onclick="logout()">Logout</button>
