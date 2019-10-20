<h1 style="color: red">{{ @language.entry.delete.title }}</h1>
<h2>{{ @language.entry.delete.info }}</h2>

<form action="{{ @app.base }}/deleteEntry" method="post">
    <input type="hidden" name="id" value="{{ @entry->getId() }}">
    <input type="submit" name="delete" value="{{ @language.entry.delete.submit }}">
</form>
<a href="{{ @app.base }}/entry/{{ @entry->getId() }}"><button>{{ @language.entry.delete.abort }}</button></a>