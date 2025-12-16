<!-- Tambahkan di bagian <head> atau sebelum </body> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- Bagian Profile -->
<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div>

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="<?= base_url('assets/img/'.$prof->foto);?>" alt="Profile" class="rounded-circle">
          <h2><?= $prof->nama?></h2>
          <h3><?= $prof->nama_level?></h3>
        </div>
      </div>
    </div>

    <div class="col-xl-8">
      <div class="card">
        <div class="card-body pt-3">
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-photo">Change Photo</button>
            </li>
             <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button> 
            </li>
          </ul>

          <div class="tab-content pt-2">
            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <h5 class="card-title">Profile Details</h5>
              <div class="row"><div class="col-lg-3 col-md-4 label">Nama Lengkap</div><div class="col-lg-9 col-md-8"><?= $prof->nama?></div></div>
              <div class="row"><div class="col-lg-3 col-md-4 label">Username</div><div class="col-lg-9 col-md-8"><?= $prof->username?></div></div>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
            <form action="<?= site_url('beasiswa/profile/update_profile') ?>" method="POST" enctype="multipart/form-data">
               <div class="row mb-3">
                      <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama" type="text" class="form-control" id="nama" value="<?= $prof->nama ?>">
                      </div>
                    </div>
                  <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control" id="username" value="<?= $prof->username ?>">
                      </div>
                    </div>
          
                 <div class="mt-2 d-flex">
                      <button type="submit" class="btn btn-primary btn-sm me-2">
                        <i class="bi bi-upload"></i> Simpan
                      </button>
                    </div>
            </form>
         </div>
         <div class="tab-pane fade profile-edit pt-3" id="profile-photo">
            <form action="<?= site_url('beasiswa/profile/update_foto') ?>" method="POST" enctype="multipart/form-data">
              <div class="row mb-3">
                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                <div class="col-md-8 col-lg-9">
                  <img src="<?= base_url('assets/img/'.$prof->foto);?>" alt="Profile" style="width: 210px; height: 135px; object-fit: cover;">
                  <div class="pt-2">
                    <input type="file" id="imageInput" name="foto" class="form-control" accept="image/*">
                    <img id="previewImage" src="#" alt="Preview" class="img-fluid mt-2" style="max-width: 300px; display:none;">
                    
                    <div class="mt-2 d-flex">
                      <button type="submit" class="btn btn-primary btn-sm me-2">
                        <i class="bi bi-upload"></i> Simpan
                      </button>
                      <?php if (!empty($prof->foto)): ?>
                        <a href="<?= site_url('beasiswa/profile/hapus_foto') ?>" class="btn btn-danger btn-sm">
                          <i class="bi bi-trash"></i> Hapus Foto
                        </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </form>
         </div>
                <div class="tab-pane fade pt-3" id="profile-change-password">
                    <form action="<?= base_url('beasiswa/profile/changepassword') ?>" method="post">
                        <?php if (session()->getFlashdata('password_error')): ?>
                          <div class="alert alert-danger"><?= session()->getFlashdata('password_error'); ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('password_success')): ?>
                          <div class="alert alert-success"><?= session()->getFlashdata('password_success'); ?></div>
                        <?php endif; ?>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form>

                </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Cropper -->
<div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="max-height: 500px; overflow: auto;">
        <div style="max-width: 100%; overflow: hidden;">
          <img id="cropperImage" src="#" style="max-width: 100%;" class="img-fluid">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="cropButton" class="btn btn-primary" data-bs-dismiss="modal">Crop & Preview</button>
      </div>
    </div>
  </div>
</div>

<script>
let cropper;
const imageInput = document.getElementById('imageInput');
const cropperImage = document.getElementById('cropperImage');
const previewImage = document.getElementById('previewImage');
const croppedImageInput = document.getElementById('croppedImage');

imageInput.addEventListener('change', function (e) {
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (event) {
    cropperImage.src = event.target.result;
    const modal = new bootstrap.Modal(document.getElementById('cropperModal'));
    modal.show();
  };
  reader.readAsDataURL(file);
});

document.getElementById('cropperModal').addEventListener('shown.bs.modal', function () {
  if (cropper) cropper.destroy();
  cropper = new Cropper(cropperImage, {
    aspectRatio: 1,
    viewMode: 1,
    autoCropArea: 1,
    responsive: true,
    scalable: true
  });
});

document.getElementById('cropButton').addEventListener('click', function () {
  const canvas = cropper.getCroppedCanvas({
    width: 300,
    height: 300,
    imageSmoothingQuality: 'high'
  });
  const dataURL = canvas.toDataURL('image/jpeg');
  previewImage.src = dataURL;
  previewImage.style.display = 'block';
  croppedImageInput.value = dataURL;
});

  
document.addEventListener("DOMContentLoaded", function () {
  const pendidikanRadios = document.querySelectorAll('input[name="status_pendidikan"]');
  const tempatSMADiv = document.getElementById('tempatSMADiv');
  const tempatSMKDiv = document.getElementById('tempatSMKDiv');
  const tempatKuliahDiv = document.getElementById('tempatKuliahDiv');

  tempatSMADiv.style.display = "none";
  tempatSMKDiv.style.display = "none";
  tempatKuliahDiv.style.display = "none";

  const selectedPendidikan = document.querySelector('input[name="status_pendidikan"]:checked');
  if (selectedPendidikan) {
    if (selectedPendidikan.value === "SMA") {
      tempatSMADiv.style.display = "block";
    } else if (selectedPendidikan.value === "SMK") {
      tempatSMKDiv.style.display = "block";
    } else if (selectedPendidikan.value === "Kuliah") {
      tempatKuliahDiv.style.display = "block";
    }
  }

  pendidikanRadios.forEach(radio => {
    radio.addEventListener('change', function () {
      tempatSMADiv.style.display = "none";
      tempatSMKDiv.style.display = "none";
      tempatKuliahDiv.style.display = "none";

      if (this.value === "SMA") {
        tempatSMADiv.style.display = "block";
      } else if (this.value === "SMK") {
        tempatSMKDiv.style.display = "block";
      } else if (this.value === "Kuliah") {
        tempatKuliahDiv.style.display = "block";
      }
    });
  });

  const bekerjaRadios = document.querySelectorAll('input[name="bekerja"]');
  const tempatBekerjaDiv = document.getElementById('tempatBekerjaDiv');

  const selectedBekerja = document.querySelector('input[name="bekerja"]:checked');
  if (selectedBekerja && selectedBekerja.value === "Iya") {
    tempatBekerjaDiv.style.display = "block";
  } else {
    tempatBekerjaDiv.style.display = "none";
  }

  bekerjaRadios.forEach(radio => {
    radio.addEventListener('change', function () {
      if (this.value === "Iya") {
        tempatBekerjaDiv.style.display = "block";
      } else {
        tempatBekerjaDiv.style.display = "none";
      }
    });
  });

}); 
<?php if (session()->getFlashdata('password_error') || session()->getFlashdata('password_success')): ?>
    document.addEventListener('DOMContentLoaded', function () {
      const tabTrigger = document.querySelector('[data-bs-target="#profile-change-password"]');
      if (tabTrigger) {
        new bootstrap.Tab(tabTrigger).show();
      }
    });
  <?php endif; ?>

</script>
