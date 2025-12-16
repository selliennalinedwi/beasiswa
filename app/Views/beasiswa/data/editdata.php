<div id="content">

<div class="pagetitle">
  <h1>Edit Beasiswa</h1>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Beasiswa</h5>

        <form class="row g-3"
              action="<?= base_url('beasiswa/data/editsave') ?>"
              method="POST">

          <input type="hidden" name="id" value="<?= $love->id_beasiswa ?>">

          <div class="col-12">
            <label class="form-label">Nama Beasiswa</label>
            <input type="text"
                   class="form-control"
                   name="nama"
                   value="<?= $love->nama_beasiswa ?>"
                   required>
          </div>

          <div class="col-12">
            <label class="form-label">Penyelenggara Oleh</label>
            <input type="text"
                   class="form-control"
                   name="penyelenggara"
                   value="<?= $love->penyelenggara ?>"
                   required>
          </div>

          <div class="col-12">
            <label class="form-label">Jenjang (SMA / Kuliah)</label>
            <input type="text"
                   class="form-control"
                   name="jenjang"
                   value="<?= $love->jenjang ?>"
                   required>
          </div>

          <div class="col-12">
            <label class="form-label">Deadline Pendaftaran</label>
            <input type="date"
                   class="form-control"
                   name="deadline"
                   value="<?= $love->deadline ?>"
                   required>
          </div>

          <div class="col-12">
            <label class="form-label">Jumlah Kuota</label>
            <input type="text"
                   class="form-control"
                   name="kuota"
                   value="<?= $love->kuota ?>"
                   required>
          </div>

          <div class="col-12">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control"
                      name="deskripsi"
                      rows="4"><?= $love->deskripsi ?></textarea>
          </div>

          <div class="col-12">
            <label class="form-label">Syarat</label>
            <textarea class="form-control"
                      name="syarat"
                      rows="4"><?= $love->syarat ?></textarea>
          </div>

          <div class="col-12">
            <label class="form-label">Kontak Beasiswa</label>
            <input type="text"
                   class="form-control"
                   name="kontak"
                   value="<?= $love->kontak ?>"
                   required>
          </div>

          <div class="col-12">
            <!-- default OFF -->
            <input type="hidden" name="aktif" value="0">

            <div class="form-check form-switch">
              <input class="form-check-input"
                     type="checkbox"
                     name="aktif"
                     value="1"
                     <?= $love->aktif == 1 ? 'checked' : '' ?>>
              <label class="form-check-label">
                Status Aktif
              </label>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('beasiswa/data') ?>" class="btn btn-secondary">
              Batal
            </a>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

</div>
