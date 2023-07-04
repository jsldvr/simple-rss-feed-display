<script src="app/scripts/jquery-3.5.1.js"></script>
<script src="app/scripts/bootstrap.bundle.min.js"></script>
<script src="app/scripts/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#news-table').DataTable({
            dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
            order: [
                [0, 'desc']
            ],
        });
    });
</script>