<div id="errors">
    <check if="{{ @SESSION.errors }}">
        <true>
            <b>Errors:</b>
            <ul>
                <repeat group="{{ @SESSION.errors }}" value="{{ @error }}">
                    <li>
                        {{ @error }}
                    </li>
                </repeat>
            </ul>
        </true>
    </check>
</div>