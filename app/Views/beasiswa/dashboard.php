<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Beasiswa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="<?= base_url('assets/img/1753932978_cfd1c6c6012e8b3982be.jpg')?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png')?>" rel="apple-touch-icon">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.snow.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.bubble.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css')?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/simple-datatables/style.css')?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/style.css')?>" rel="stylesheet">
<style>
  #main {
  margin-left: 300px;
  padding: 20px;
}

@media (max-width: 1199px) {
  #main {
    margin-left: 0;
  }
}

</style>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>    

<div class="container my-4">
<div class="d-flex align-items-center justify-content-between mb-4">
  <h1 class="card-title text-center pb-0 fs-4">Daftar Beasiswa Aktif</h1>
<a href="<?= base_url('beasiswa/login') ?>" class="btn btn-primary btn-sm">
  Login
</a>

</div>

  <div class="row">
    <?php if (!empty($beasiswa)): ?>
      <?php foreach ($beasiswa as $b): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">

              <h5 class="card-title">
                <?= esc($b->nama_beasiswa) ?>
              </h5>

              <p class="text-muted mb-1">
                <strong>Penyelenggara:</strong><br>
                <?= esc($b->penyelenggara) ?>
              </p>

              <p class="mb-1">
                <strong>Jenjang:</strong> <?= esc($b->jenjang) ?>
              </p>

              <p class="mb-1">
                <strong>Kuota:</strong> <?= esc($b->kuota) ?> orang
              </p>

<?php
  $today = date('Y-m-d');
  $deadlineClass = ($b->deadline <= $today) ? 'text-danger fw-bold' : 'text-dark';
?>
<p class="mb-2 <?= $deadlineClass ?>">
  <strong>Deadline:</strong>
  <?= date('d M Y', strtotime($b->deadline)) ?>
</p>


              <!-- Deskripsi (3 baris) -->
              <p class="text-muted text-truncate-3">
                <?= esc($b->deskripsi) ?>
              </p>

              <div class="mt-auto">
                <button 
                  class="btn btn-outline-primary btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#detail<?= $b->id_beasiswa ?>">
                  Lihat Detail
                </button>
              </div>

            </div>
          </div>
        </div>

        <!-- MODAL DETAIL -->
        <div class="modal fade" id="detail<?= $b->id_beasiswa ?>" tabindex="-1">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title"><?= esc($b->nama_beasiswa) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                <p><strong>Penyelenggara:</strong> <?= esc($b->penyelenggara) ?></p>
                <p><strong>Jenjang:</strong> <?= esc($b->jenjang) ?></p>
                <p><strong>Kuota:</strong> <?= esc($b->kuota) ?></p>
                <p><strong>Deadline:</strong> <?= date('d M Y', strtotime($b->deadline)) ?></p>

                <hr>

                <h6>Deskripsi</h6>
                <p><?= nl2br(esc($b->deskripsi)) ?></p>

                <h6>Syarat</h6>
                <p><?= nl2br(esc($b->syarat)) ?></p>

                <h6>Kontak</h6>
                <p><?= esc($b->kontak) ?></p>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                  Tutup
                </button>
              </div>

            </div>
          </div>
        </div>

      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-warning text-center">
          Belum ada beasiswa aktif.
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
</main>
<script src="<?= base_url(
    'assets/vendor/apexcharts/apexcharts.min.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/chart.js/chart.umd.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/echarts/echarts.min.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/quill/quill.min.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/simple-datatables/simple-datatables.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/tinymce/tinymce.min.js')?>"></script>
  <script src="<?= base_url(
    'assets/vendor/php-email-form/validate.js')?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?= base_url('assets/js/main.js')?>"></script>


</body>

</html>