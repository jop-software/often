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
        <a href="{{ @app.base }}/entry/create"><button>New</button></a>
        <a href="{{ @app.base }}/logout"><button>Logout</button></a>        
    </true>
    <false>
        <a href="{{ @app.base }}/login"><button>Login</button></a>
        <a href="{{ @app.base }}/register"><button>Register</button></a>
    </false>
</check>