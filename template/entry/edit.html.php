<h1> <a href="{{@app.base}}/dashboard"><-</a> {{ @language.entry.show.edit }} {{ @entry->getDate() }}</h1>

<form action="{{ @app.base }}/editEntry" method="POST">
    <input type="hidden" name="id" value="{{ @entry->getId() }}">
    <table>
        <tbody>
            <tr>
                <td>{{ @language.entry.id }}</td>
                <td>{{ @entry->getId() }}</td>
            </tr>
            <tr>
                <td>{{ @language.entry.date }}</td>
                <td><input type="date" name="date" value="{{ @entry->getDate() }}"></td>
            </tr>
            <tr>
                <td>{{ @language.entry.start }}</td>
                <td><input type="time" name="start" value="{{ @entry->getStart() }}"></td>
            </tr>
            <tr>
                <td>{{ @language.entry.end }}</td>
                <td><input type="time" name="end" value="{{ @entry->getEnd() }}"></td>
            </tr>
            <tr>
                <td>{{ @language.entry.break }}</td>
                <td><input type="time" name="break" value="{{ @entry->getBreak() }}"></td>
            </tr>
            <tr>
                <td>{{ @language.entry.exp }}</td>
                <td><input type="time" name="exp" value="{{ @entry->getExp() }}"></td>
            </tr>
            <tr>
                <td>{{ @language.entry.note }}</td>
                <td><textarea name="note">{{ @entry->getNote() }}</textarea></td>
            </tr>
        </tbody>
    </table>
    <input type="submit" name="submit" value="{{ @language.entry.show.edit }}">
</form>