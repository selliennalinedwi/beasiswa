
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Input Level</h5>
              <form class="row g-3" action="<?= base_url('beasiswa/data/inputsave')?>" method="POST" enctype="multipart/form-data" >

                <div class="col-12">
                  <label for="nama" class="form-label">Nama Beasiswa</label>
                  <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Penyelenggara Oleh:</label>
                  <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required>
                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Jenjang (SMA/Kuliah)</label>
                  <input type="text" class="form-control" id="nama" name="jenjang" required>
                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Deadline Pendaftaran</label>
                  <input type="date" class="form-control" id="nama" name="deadline" required>
                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Jumlah Kuota</label>
                  <input type="text" class="form-control" id="nama" name="kuota" required>
                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Deskripsi</label>
                  <!-- <input type="text" class="form-control" id="nama" name="deskripsi" required> -->
                  <textarea class="form-control" name="deskripsi" rows="4"></textarea>

                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Syarat</label>
                  <!-- <input type="text" class="form-control" id="nama" name="syarat" required> -->
                  <textarea class="form-control" name="syarat" rows="4"></textarea>

                </div>
                <div class="col-12">
                  <label for="nama" class="form-label">Kontak Beasiswa</label>
                  <input type="text" class="form-control" id="nama" name="kontak" required>
                </div>
                <div class="col-12">
                  <!-- nilai default OFF -->
                  <input type="hidden" name="aktif" value="0">

                  <div class="form-check form-switch">
                    <input 
                      class="form-check-input" 
                      type="checkbox" 
                      id="aktif"
                      name="aktif"
                      value="1"
                      <?= isset($data) && $data->aktif == 1 ? 'checked' : '' ?>
                    >
                    <label class="form-check-label" for="aktif">
                      Status Aktif
                    </label>
                  </div>

                </div>

                <div class="text-center">
                  <input type="hidden" name="user" id="user">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>

            </div>
          </div>


