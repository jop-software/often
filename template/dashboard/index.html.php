<h1>Dashboard {{ @totalTime }}</h1>

<ul>
    <repeat group="{{ @entries }}" value="{{ @entry }}">
        <li>
            <a href="{{ @app.base }}/entry/{{ @entry->getId() }}">
                <button>{{ @entry->getDate() }}</button>
            </a>
        </li>
    </repeat>
</ul>

<a href="{{ @app.base }}/entry/create"><button>New</button></a>
<check if="{{ @SESSION.userid }}">
    <true>
        <a href="{{ @app.base }}/login"><button>Login</button></a>
    </true>
    <false>
        <a href="{{ @app.base }}/register"><button>Register</button></a>
    </false>
</check>