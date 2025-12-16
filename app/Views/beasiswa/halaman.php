
    <div class="pagetitle">
      <?php if ($firstLogin): ?>
	<h1>Selamat datang, <?= $prof->nama ?>!</h1>
<?php else: ?>
	<h1>Selamat datang kembali, <?= $prof->nama ?>!</h1>
<?php endif; ?>

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-10">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-5">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Log Activity</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Check Here</h6>
                     <a href="<?= base_url('kas/user/log') ?>" class="btn btn-link p-0 small text-success fw-bold">
                        Klik Disini
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-3 col-md-5">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Transaksi</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-receipt"></i>   
                    </div>
                    <div class="ps-3">
                      <h6>Check Here</h6>
                     <a href="<?= base_url('kas/transaksi') ?>" class="btn btn-link p-0 small text-success fw-bold">
                        Klik Disini
                      </a>
                    </div>
                  </div>
                </div>

              </div>
            </div>
