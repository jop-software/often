<style>
.form-group {
    display: block;
}    
</style>

<h1>Register</h1>

<form action="{{ @app.base }}/register" method="POST">
    <div class="form-group">
        <label for="username">Benutzername</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="form-group">
        <label for="language">Language</label>
        <select name="language" id="language">
            <option value="de_de">Deutsch</option>
            <option value="en_us">English</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Register">
    </div>
</form>