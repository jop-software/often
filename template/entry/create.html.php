<h1><a href="{{@app.base}}/dashboard"><-</a> {{ @language.entry.create }}</h1> 
<form action="{{ @app.base }}/createEntry" method="POST">
    <div class="form-group">
        <label for="date">{{ @language.entry.date }}:</label>
        <input type="date" name="date" id="date" value="{{ @vars.date }}">
    </div>
    <div class="form-group">
        <label for="start">{{ @language.entry.start }}:</label>
        <input type="time" name="start" id="start">
    </div>
    <div class="form-group">
        <label for="end">{{ @language.entry.end }}:</label>
        <input type="time" name="end" id="end">
    </div>
    <div class="form-group">
        <label for="break">{{ @language.entry.break }}:</label>
        <input type="time" name="break" id="break">
    </div>
    <div class="form-group">
        <label for="exp">{{ @language.entry.exp }}:</label>
        <input type="time" name="exp" id="exp">
    </div>
    <div class="form-group">
        <label for="note">{{ @language.entry.note }}:</label>
        <textarea type="text" name="note" id="note"></textarea>
    </div>
    <input type="submit" value="{{ @language.entry.submit }}">
</form>