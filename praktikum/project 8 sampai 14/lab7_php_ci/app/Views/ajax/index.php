<?php $this->include('template/header'); ?>

<h1>Data Artikel (AJAX)</h1>

<table class="table-data" id="artikelTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr><td colspan="4">Loading data...</td></tr>
    </tbody>
</table>

<script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
<script>
$(document).ready(function () {

    function loadData() {
        $('#artikelTable tbody').html('<tr><td colspan="4">Loading data...</td></tr>');
        $.ajax({
            url: '<?= base_url('ajax/getData') ?>',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var html = '';
                if (data.length > 0) {
                    data.forEach(function (row) {
                        html += '<tr>';
                        html += '<td>' + row.id + '</td>';
                        html += '<td>' + row.judul + '</td>';
                        html += '<td>' + (row.status == 1 ? 'Publish' : 'Draft') + '</td>';
                        html += '<td>';
                        html += '<a href="<?= base_url('artikel/edit/') ?>' + row.id + '" class="btn btn-primary">Edit</a> ';
                        html += '<a href="#" class="btn btn-danger btn-delete" data-id="' + row.id + '">Hapus</a>';
                        html += '</td>';
                        html += '</tr>';
                    });
                } else {
                    html = '<tr><td colspan="4">Tidak ada data.</td></tr>';
                }
                $('#artikelTable tbody').html(html);
            }
        });
    }

    loadData();

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
            $.ajax({
                url: '<?= base_url('ajax/delete/') ?>' + id,
                method: 'DELETE',
                success: function () {
                    loadData();
                },
                error: function (xhr, status, err) {
                    alert('Error: ' + status + ' ' + err);
                }
            });
        }
    });

});
</script>

<?php $this->include('template/footer'); ?>
