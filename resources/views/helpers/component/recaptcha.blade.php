@push('css')
    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!}
@endpush

@push('js')
    <script type="text/javascript">
        function callbackThen(response) {
            // read Promise object
            response.json().then(function (data) {
                console.log(data);
                if (data.success && data.score > 0.6) {
                    console.log('valid recaptcha');
                } else {
                    document.getElementById('kontaktForm').addEventListener('submit', function (event) {
                        event.preventDefault();
                        alert('recaptcha error.');
                    });
                }
            });
        }
        function callbackCatch(error) {
            console.log('Error: ' + error);
        }
    </script>
@endpush
