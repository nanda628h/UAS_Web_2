<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<!-- enctype multipart untuk upload gambar (Praktikum 7) -->
<form action="" method="post" enctype="multipart/form-data">
    <p>
        <label>Judul</label>
        <input type="text" name="judul" required>
    </p>
    <p>
        <label>Isi</label>
        <textarea name="isi" cols="50" rows="10"></textarea>
    </p>
    <!-- Kategori (Praktikum 6) -->
    <p>
        <label>Kategori</label>
        <select name="id_kategori">
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <!-- Upload Gambar (Praktikum 7) -->
    <p>
        <label>Gambar</label>
        <input type="file" name="gambar">
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>
