<?= $this->extend('layouts/template'); ?>

<?= $this->section('konten'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="my-3"><b>Form Ubah Data Anime</b></h1>
            <hr>
            <form action="/Anime/update/<?= $anime['id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $anime['slug']; ?>">
                <div class="form-group row">
                    <label for="judul_anime" class="col-sm-2 col-form-label">Judul Anime</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul_anime')) ? 'is-invalid' : ''; ?>" id="judul_anime" name="judul_anime" autofocus value="<?= (old('judul_anime')) ? old('judul_anime') : $anime['judul_anime']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul_anime'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $anime['penulis']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $anime['penerbit']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Tayang</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="tahun" name="tahun" value="<?= (old('tahun')) ? old('tahun') : $anime['tahun']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul" value="<?= (old('sampul')) ? old('sampul') : $anime['sampul']; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>