<div>
    <h2>Modification du profil</h2>
    <form method="post" action="#">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="NameEdit" name="nom"/><br>

            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control" id="FirstnameEdit" name="prenom"/><br>

            <label for="status">Status :</label>
            <input type="text" class="form-control" id="StatusEdit" name="status"/><br>

            <label for="password">Password :</label>
            <input type="password" class="form-control" id="PasswordEdit" name="password" /><br>

            <label for="passwordRepeat">Password again :</label>
            <input type="password" class="form-control" name="passwordRepeat" /><br>

            <button type="button" onclick=editProfile() class="btn btn-default">Submit</button>
        </div>
    </form>
</div>

