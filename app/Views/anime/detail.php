<?= $this->extend('layouts/template'); ?>

<?= $this->section('konten'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="my-4">Detail Anime</h1>
            <hr>
            <div class="card mb-3 shadow-lg" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $anime['sampul']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b><?= $anime['judul_anime']; ?></b></h5>
                            <p class="card-text">Penulis : <b><?= $anime['penulis']; ?></b></p>
                            <p class="card-text">Penerbit : <b><?= $anime['penerbit']; ?></b></p>
                            <p class="card-text">Tahun Tayang : <b><?= $anime['tahun']; ?></b></p>
                            <p class="card-text"><small class="text-muted">Terakhir diperbaharui = <b><?php echo date('D - M - Y') ?></b></small></p>

                            <a href="/Anime/edit/<?= $anime['slug']; ?>" class="btn btn-primary">Edit</a>
                            <form action="/Anime/<?= $anime['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin ?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <a href="/anime" class="btn btn-outline-dark">Kembali Ke Daftar Anime</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>