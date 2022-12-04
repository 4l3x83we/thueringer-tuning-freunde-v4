    <script type="module">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/de-DE.json"
                },
                "order": [[0, 'DESC']],
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": [5]
                    }
                ],
            });
        });
    </script>
