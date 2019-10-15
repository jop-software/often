<h1>Create Entry</h1>

<form action="{{ @APP.base }}/createEntry" method="POST">
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" name="date" id="date">
    </div>
    <div class="form-group">
        <label for="start">Start:</label>
        <input type="time" name="start" id="start">
    </div>
    <div class="form-group">
        <label for="end">End:</label>
        <input type="time" name="end" id="end">
    </div>
    <div class="form-group">
        <label for="exp">Expectation:</label>
        <input type="time" name="exp" id="exp">
    </div>
    <div class="form-group">
        <label for="note">Note:</label>
        <textarea type="text" name="note" id="note"></textarea>
    </div>
    <input type="submit" value="create">
</form>