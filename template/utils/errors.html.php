<div id="errors">
    <check if="{{ @errors }}">
        <true>
            <b>Errors:</b>
            <ul>
                <repeat group="{{ @errors }}" value="{{ @error }}">
                    <li>
                        {{ @error }}
                    </li>
                </repeat>
            </ul>
        </true>
    </check>
</div>