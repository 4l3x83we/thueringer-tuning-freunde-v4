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
<script type="module">
    $(document).ready(function () {
        $('#images').fileinput({
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
        $('#images1').fileinput({
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
        $('#images2').fileinput({
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
        $('#images3').fileinput({
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
