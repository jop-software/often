<h1>{{ @entry->getDate() }}</h1>

<table>
    <tbody>
        <tr>
            <td>Date</td>
            <td>{{ @entry->getDate() }}</td>
        </tr>
        <tr>
            <td>Start</td>
            <td>{{ @entry->getStart() }}</td>
        </tr>
        <tr>
            <td>End</td>
            <td>{{ @entry->getEnd() }}</td>
        </tr>
        <tr>
            <td>Break</td>
            <td>{{ @entry->getBreak() }}</td>
        </tr>
        <tr>
            <td>Expectation</td>
            <td>{{ @entry->getExp() }}</td>
        </tr>
        <tr>
            <td>Worked</td>
            <td>{{ @entry->getWorkedTime() }}</td>
        </tr>
        <tr>
            <td>Note</td>
            <td>{{ @entry->getNote() }}</td>
        </tr>
    </tbody>
</table>

<a href="{{ @app.base }}/entry/{{ @entry->getId() }}/delete"><button>delete</button></a>
<a href="{{ @app.base }}/entry/{{ @entry->getId() }}/edit"><button>edit</button></a>