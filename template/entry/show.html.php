<h1><a href="{{@app.base}}/dashboard"><-</a>  {{ @entry->getDate() }}</h1>

<table>
    <tbody>
        <tr>
            <td>{{ @language.entry.date }}</td>
            <td>{{ @entry->getDate() }}</td>
        </tr>
        <tr>
            <td>{{ @language.entry.start }}</td>
            <td>{{ @entry->getStart() }}</td>
        </tr>
        <tr>
            <td>{{ @language.entry.end }}</td>
            <td>{{ @entry->getEnd() }}</td>
        </tr>
        <tr>
            <td>{{ @language.entry.diff }}</td>
            <td>
                {~ @diff = @entry->getWorktimeDifference() ~}
                {{ @diff[0] }}:{{ @diff[1] }}
            </td>
        </tr>
        <tr>
            <td>{{ @language.entry.break }}</td>
            <td>{{ @entry->getBreak() }}</td>
        </tr>
        <tr>
            <td>{{ @language.entry.exp }}</td>
            <td>{{ @entry->getExp() }}</td>
        </tr>
        <tr>
            <td>{{ @language.entry.worked }}</td>
            <td>{{ @entry->getWorkedTime() }}</td>
        </tr>
        <tr>
            <td>{{ @language.entry.note }}</td>
            <td>{{ @entry->getNote() }}</td>
        </tr>
    </tbody>
</table>

<a href="{{ @app.base }}/entry/{{ @entry->getId() }}/delete"><button>{{ @language.entry.show.delete }}</button></a>
<a href="{{ @app.base }}/entry/{{ @entry->getId() }}/edit"><button>{{ @language.entry.show.edit }}</button></a>