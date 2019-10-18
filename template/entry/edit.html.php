<h1> <a href="{{@app.base}}/dashboard"><-</a> Edit {{ @entry->getDate() }}</h1>

<form action="{{ @app.base }}/editEntry" method="POST">
    <input type="hidden" name="id" value="{{ @entry->getId() }}">
    <table>
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ @entry->getId() }}</td>
            </tr>
            <tr>
                <td>Date</td>
                <td><input type="date" name="date" value="{{ @entry->getDate() }}"></td>
            </tr>
            <tr>
                <td>Start</td>
                <td><input type="time" name="start" value="{{ @entry->getStart() }}"></td>
            </tr>
            <tr>
                <td>End</td>
                <td><input type="time" name="end" value="{{ @entry->getEnd() }}"></td>
            </tr>
            <tr>
                <td>Break</td>
                <td><input type="time" name="break" value="{{ @entry->getBreak() }}"></td>
            </tr>
            <tr>
                <td>Expectation</td>
                <td><input type="time" name="exp" value="{{ @entry->getExp() }}"></td>
            </tr>
            <tr>
                <td>Note</td>
                <td><textarea name="note">{{ @entry->getNote() }}</textarea></td>
            </tr>
        </tbody>
    </table>
    <input type="submit" name="submit" value="save">
</form>