<?= $this->extend('layouts/template'); ?>

<?= $this->section('konten'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/Anime/create" class="btn btn-primary mt-3">Tambah Data</a>
            <h1 class="my-3">Daftar Anime Populer</h1>
            <?php if (session()->getFlashData('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul Anime</th>
                        <th scope="col">Judul Anime</th>
                        <th scope="col">Tahun Tayang</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($anime as $a) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $a['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $a['judul_anime']; ?></td>
                            <td><?= $a['tahun']; ?></td>
                            <td>
                                <a href="/anime/<?= $a['slug']; ?>" class="btn btn-warning shadow">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>