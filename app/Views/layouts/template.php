<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/template/css/bootstrap.min.css" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">

    <title><?= $judul; ?></title>
</head>

<body>

    <!-- navbar -->
    <?= $this->include('layouts/navbar'); ?>

    <!-- Konten -->
    <?= $this->renderSection('konten'); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/template/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </script>

    <script>
        function previewImg() {
            const sampul = document.querySelector('#sampul');
            const sampulLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            sampulLabel.textContent = sampul.files[0].name;
            // buat ngambil file yg diupload
            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>