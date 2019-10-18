<include href="utils/errors.html.php" />

<style>
.form-group {
    display: block;
}    
</style>

<h1>Login</h1>

<form action="login" method="POST">
    <div class="form-group">
        <label for="username">Benutzername</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Passwort</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="form-group">
        <input type="submit" value="Login">
    </div>
</form>