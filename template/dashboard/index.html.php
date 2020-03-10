<h1>{{ @username }} Dashboard {{ @totalTime }}</h1>

<ul>
    <repeat group="{{ @entries }}" value="{{ @entry }}">
        <li>
            <a href="{{ @app.base }}/entry/{{ @entry->getId() }}">
                <button>{{ @entry->getDate() }}</button>
            </a>
        </li>
    </repeat>
</ul>

<check if="{{ @SESSION.userid }}">
    <true>
        <a href="{{ @app.base }}/entry/create"><button>{{ @language.dashboard.new }}</button></a>
        <a href="{{ @app.base }}/overview"><button>{{ @language.dashboard.overview }}</button></a>
        <a href="{{ @app.base }}/logout"><button>{{ @language.dashboard.logout }}</button></a>
    </true>
    <false>
        <a href="{{ @app.base }}/auth"><button>{{ @language.dashboard.login }}</button></a>
        <a href="{{ @app.base }}/auth"><button>{{ @language.dashboard.register }}</button></a>
    </false>
</check>

<p><a href="{{ @customization.urls.IMPRESS }}" target="_blank">Impress</a></p>