<?= $this->include('template/header'); ?>

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <?php if (! empty($artikel['nama_kategori'])) : ?>
        <p><small>Kategori: <strong><?= $artikel['nama_kategori']; ?></strong></small></p>
    <?php endif; ?>
    <?php if ($artikel['gambar']) : ?>
        <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= $artikel['judul']; ?>">
    <?php endif; ?>
    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->include('template/footer'); ?>
