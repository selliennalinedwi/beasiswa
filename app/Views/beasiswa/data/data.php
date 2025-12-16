
<style>
  .text-limit {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}


.text-full {
  -webkit-line-clamp: unset;
}

</style>
    <div class="pagetitle">
      <h1>Tabel Beasiswa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Table Data</li>
          <li class="breadcrumb-item active">Data Beasiswa</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <pre></pre>
              <a href="<?= base_url('beasiswa/data/input') ?>" class="btn btn-success mb-3 text-white"onclick="return confirm('Apakah Anda yakin ingin menambah data user?')">Tambah Data Beasiswa</a>
              <a href="<?= base_url('beasiswa/data/deleted') ?>" class="btn btn-warning mb-3 text-black">Deleted Beasiswa</a>

              <div class="table-responsive">
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Beasiswa</th>
                    <th scope="col">Penyelenggara Oleh</th>
                    <th scope="col">Jenjang (SMA/Kuliah)</th>
                    <th scope="col">Deadline Pendaftaran</th>
                    <th scope="col">Kuota</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Syarat</th>
                    <th scope="col">Kontak</th>
                    <th scope="col">Status Aktif</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $ms = 1; foreach ($love as $key => $value) { ?>
                    <tr>
                      <td><?= $ms++ ?></td>
                      <td><?= $value->nama_beasiswa ?></td>
                      <td><?= $value->penyelenggara ?></td>
                      <td><?= $value->jenjang ?></td>
                      <td><?= $value->deadline ?></td>
                      <td><?= $value->kuota ?></td>
                      <td>
                        <div class="desc text-limit" id="desc-<?= $value->id_beasiswa ?>">
                          <?= nl2br($value->deskripsi) ?>
                        </div>
                        <a href="javascript:void(0)"
                          class="toggle-link"
                          onclick="toggleText('desc-<?= $value->id_beasiswa ?>', this)">
                          Lihat selengkapnya
                        </a>

                      </td>

                      <td>
                        <div class="desc text-limit" id="syarat-<?= $value->id_beasiswa ?>">
  <?= nl2br($value->syarat) ?>
</div>
<a href="javascript:void(0)"
   class="toggle-link"
   onclick="toggleText('syarat-<?= $value->id_beasiswa ?>', this)">
   Lihat selengkapnya
</a>

                      </td>

                      <td><?= $value->kontak ?></td>
                      <td>
                        <?= $value->aktif == 1 
                            ? '<span class="badge bg-success">Aktif</span>' 
                            : '<span class="badge bg-secondary">Nonaktif</span>' ?>
                      </td>

                     
                      <td>
                        <button class="btn btn-info btn-detail" data-id="<?= $value->id_beasiswa ?>"><i class="bi bi-info-circle" style="color: white;"></i></button>
                        <div class="btn-group btn-group-action mt-2" id="action-<?= $value->id_beasiswa ?>" style="display: none;"> 
                          <a href="<?= base_url('beasiswa/data/soft/' . $value->id_beasiswa) ?>" class="btn btn-danger btn-delete"><i class="bi bi-trash"></i></a><pre></pre> <!-- hapus -->
                          <a href="<?= base_url('beasiswa/data/edit/' . $value->id_beasiswa) ?>" class="btn btn-warning"><i class="bi bi-pencil" style="color: white;"></i></a> <!-- edit -->
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.desc').forEach(desc => {
    const link = desc.nextElementSibling;

    // cek apakah teks terpotong
    if (desc.scrollHeight <= desc.clientHeight + 1) {
      link.style.display = 'none';
    }
  });
});

function toggleText(id, el) {
  const box = document.getElementById(id);
  box.classList.toggle('text-limit');

  el.innerText = box.classList.contains('text-limit')
    ? 'Lihat selengkapnya'
    : 'Tutup';
}
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const detailButtons = document.querySelectorAll('.btn-detail');
    const editButtons = document.querySelectorAll('.btn-edit');
    const deleteButtons = document.querySelectorAll('.btn-delete');
    const inputButton = document.querySelector('.btn-inputalumni');

    detailButtons.forEach(button => {
      button.addEventListener('click', function () {
        const alumniId = this.dataset.id;
        const actionDiv = document.getElementById('action-' + alumniId);
        actionDiv.style.display = (actionDiv.style.display === 'none' || actionDiv.style.display === '') ? 'block' : 'none';
      });
    });

    editButtons.forEach(button => {
      button.addEventListener('click', function () {
        const alumniId = this.dataset.id;
        const url = window.location.origin + '/alumni/alumni/editalumni/' + alumniId;


        fetch(url)
          .then(response => response.text())
          .then(data => {
            document.getElementById('content').innerHTML = data;
            history.pushState(null, '', '/alumni/alumni');
            initializeCropper();
            initializeInputAlumniScript();
          })
          .catch(error => console.error('Error:', error));
      });
    });

    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        const alumniId = this.dataset.id;
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
          // window.location.href = '<?= base_url("alumni/alumni/hapusalumni/") ?>' + alumniId;
          window.location.href = '<?= rtrim(base_url("alumni/alumni/hapusalumni"), "/") . "/" ?>' + alumniId;

        }
      });
    });

    if (inputButton) {
      inputButton.addEventListener('click', function (e) {
        e.preventDefault(); 
        if (confirm('Apakah Anda yakin ingin menambah data alumni?')) {
          fetch('<?= base_url("alumni/alumni/inputalumni") ?>')
            .then(res => res.text())
            .then(html => {
              document.getElementById('content').innerHTML = html;
              history.pushState(null, '', '/alumni/alumni');
              initializeCropper();
              initializeInputAlumniScript();
            })
            .catch(err => console.error('Gagal load halaman input:', err));
        }
      });
    }
  });

    function initializeCropper() {
  let cropper;
  const input = document.getElementById('file');
  const image = document.getElementById('imagePreview');
  const previewImage = document.getElementById('croppedPreview');

  if (input && image && previewImage) {
    input.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (event) {
        image.src = event.target.result;
        image.style.display = 'block';

        if (cropper) cropper.destroy();

        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 2,
          autoCropArea: 0.8,
          guides: true,
          center: true,
          highlight: true,
          background: true,
          movable: false,
          zoomable: true,
          cropBoxMovable: true,
          cropBoxResizable: true,
          minContainerHeight: 400,
          crop(event) {
            const canvas = cropper.getCroppedCanvas({ width: 100, height: 100 });
            previewImage.src = canvas.toDataURL();
          }
        });
      };
      reader.readAsDataURL(file);
    });

    document.querySelector('form').addEventListener('submit', function (e) {
      if (cropper) {
        e.preventDefault();
        cropper.getCroppedCanvas().toBlob((blob) => {
          const fileInput = document.getElementById('file');
          const newFile = new File([blob], "cropped.png", { type: "image/png" });
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(newFile);
          fileInput.files = dataTransfer.files;
          this.submit();
        });
      }
    });
  }
}

function initializeInputAlumniScript() {
    const pendidikanRadios = document.querySelectorAll('input[name="status_pendidikan"]');
    const tempatSMADiv = document.getElementById('tempatSMADiv');
    const tempatSMKDiv = document.getElementById('tempatSMKDiv');
    const tempatKuliahDiv = document.getElementById('tempatKuliahDiv');

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

    bekerjaRadios.forEach(radio => {
      radio.addEventListener('change', function () {
        if (this.value === "Iya") {
          tempatBekerjaDiv.style.display = "block";
        } else {
          tempatBekerjaDiv.style.display = "none";
       }
    });
  });
}
</script>
