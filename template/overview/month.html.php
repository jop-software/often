<h1>{{ @language.overview.title }} > {{ @year }} > {{ @monthname }} - {{ @hours }}:{{ @minutes }}</h1>

<ul>
    <repeat group="{{ @entries }}" value="{{ @entry }}">
        <li>
            <a href="{{ @app.base }}/entry/{{ @entry->getId() }}">
                <button>{{ @entry->getDate() }}</button>
            </a>
        </li>
    </repeat>
</ul>