<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<!-- Form Pencarian + Filter Kategori (Praktikum 5 & 6) -->
<form method="get" class="form-search">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari judul artikel">
    <select name="kategori_id">
        <option value="">Semua Kategori</option>
        <?php foreach ($kategori as $k) : ?>
            <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                <?= $k['nama_kategori']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Cari" class="btn">
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($artikel) : foreach ($artikel as $row) : ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td>
                <b><?= $row['judul']; ?></b>
                <p><small><?= substr($row['isi'], 0, 50); ?></small></p>
            </td>
            <td><?= $row['nama_kategori'] ?? '-'; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');"
                   href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; else : ?>
        <tr><td colspan="5">Belum ada data.</td></tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th>
        </tr>
    </tfoot>
</table>

<!-- Pagination manual (Praktikum 5) -->
<?php
$totalPages = ceil($total / $perPage);
if ($totalPages > 1) :
?>
<div class="pagination" style="margin-top:12px;">
    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
        <a href="?q=<?= $q ?>&kategori_id=<?= $kategori_id ?>&page=<?= $i ?>"
           class="btn <?= ($i == $page) ? 'btn-active' : ''; ?>"
           style="<?= ($i == $page) ? 'background:#16a085;' : ''; ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
</div>
<?php endif; ?>

<?= $this->include('template/admin_footer'); ?>
