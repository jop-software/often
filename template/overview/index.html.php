<h1>{{ @language.overview.title }}</h1>

<ul>
    <repeat group="{{ @months }}" value="{{ @item }}">
        {~ @month = @item["month"] ~}
        {~ @year = @item["year"] ~}
        <li><a href="{{ @app.base }}/overview/{{ @year }}/{{ @month }}">{{ @month }} {{ @year }}</a></li>    
    </repeat>
</ul>