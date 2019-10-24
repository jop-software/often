<style>
    .form-group {
        display: block;
    }
</style>

<h1>{{ @language.login.title }}</h1>

<form action="{{ @app.base }}/login" method="POST">
    <div class="form-group">
        <label for="username">{{ @language.login.form.username }}</label>
        <input type="text" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">{{ @language.login.form.password }}</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="form-group">
        <input type="submit" value="{{ @language.login.form.submit }}">
    </div>
</form>