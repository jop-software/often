<h1 style="color: red">DELETE</h1>
<h2>Are you sure, you want to delete this entry?</h2>

<form action="{{ @app.base }}/deleteEntry" method="post">
    <input type="hidden" name="id" value="{{ @entry->getId() }}">
    <input type="submit" name="delete" value="YES">
</form>
<a href="{{ @app.base }}/entry/{{ @entry->getId() }}"><button>NO</button></a>