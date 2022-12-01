<div class="header">
    <h1>Fahrzeugbilder</h1>
</div>
<div class="body">
    <div class="row">
        <div class="col-lg-12">
            <label for="carImages" class="form-label">Fahrzeugbilder: <small class="text-muted">(maximal 10 Bilder gleichzeitig bei insgesamt 10 MB)</small></label>
            <input type="file" id="carImages" class="file" name="images[]" data-overwrite-initial="false" data-browse-on-zone-click="true" data-msg-placeholder="Wählen Sie {files} zum Hochladen aus ..." multiple>
        </div>
    </div>
</div>

@push('css')
    <style>
        .file-preview {
            background: #121212;
            border-color: #8f8f8f;
        }
        .file-drop-zone {
            border-color: #7a7a7a;
        }
        .file-drop-zone-title {
            color: #cccccc;
        }
        .file-caption-name:not(.file-caption-disabled) {
            background-color: #121212;
        }
    </style>
@endpush

@push('js')
    <script type="module">
        $(document).ready(function () {
            $('#carImages').fileinput({
                theme: "bs5",
                language: "de",
                allowedFileTypes: [
                    'image'
                ],
                allowedFileExtensions: [
                    'jpg', 'jpeg', 'jpe', 'png', 'gif', 'tif', 'tiff', 'svg', 'svgz', 'webp'
                ],
                overwriteInitial: false,
                maxFileSize: 10240,
                maxFileNum: 10,
                inputGroupClass: "input-group-sm",
            });
        });
    </script>
@endpush
