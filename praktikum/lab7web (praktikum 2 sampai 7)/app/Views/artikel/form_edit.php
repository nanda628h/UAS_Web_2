<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<form action="" method="post">
    <p>
        <label>Judul</label>
        <input type="text" name="judul" value="<?= $data['judul']; ?>" required>
    </p>
    <p>
        <label>Isi</label>
        <textarea name="isi" cols="50" rows="10"><?= $data['isi']; ?></textarea>
    </p>
    <!-- Kategori (Praktikum 6) -->
    <p>
        <label>Kategori</label>
        <select name="id_kategori">
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $k) : ?>
                <option value="<?= $k['id_kategori']; ?>"
                    <?= ($data['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>
