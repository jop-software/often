<h1>Dashboard</h1>

<ul>
    <repeat group="{{ @entries }}" value="{{ @entry }}">
        <button><a href="{{ @app.base }}/entry/{{ @entry->getId() }}">{{ @entry->getDate() }}</a></li>
    </repeat>
</ul>