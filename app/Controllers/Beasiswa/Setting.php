<?php

namespace App\Controllers\Beasiswa;

use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\M_user;

class Setting extends BaseController
{
    protected $session;
    protected $db;
    protected $validation;

    public function __construct()
    {
        helper(['url', 'form', 'log']);
        $this->session = session();
        $this->db = \Config\Database::connect();
        $this->validation = \Config\Services::validation();

        $this->absenModel = new M_belajar();
    }

    public function index()
    {
        $level = $this->session->get('level');
        $id_user = $this->session->get('id');

        if ($level == 1 || $level == 2) {
            $apel['mey'] = $this->absenModel->settings();

            $data = [
                'title' => 'Data User',
                'anjas' => $this->absenModel->settings(),
                'showWelcome' => false
            ];

		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->absenModel->profile();
            } else {
                $hee['prof'] = null;
            }

            log_activity($id_user, 'Mengakses halaman Settings.');
            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/web', $data);
            echo view('beasiswa/admin/footer');
        }
    }

public function update_foto()
{
    $id_setting = 1; 
    $fotoFile = $this->request->getFile('foto');

    if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
        $newName = $fotoFile->getRandomName();

        // Simpan file baru ke folder public
        if ($fotoFile->move(ROOTPATH . 'public/assets/img', $newName)) {

            // Ambil data lama
            $old = $this->db->table('setting')->where('id', $id_setting)->get()->getRow();

            // Update DB dengan nama foto baru
            $this->db->table('setting')->where('id', $id_setting)->update(['foto' => $newName]);

            // Hapus foto lama setelah DB update berhasil
            if ($old && $old->foto && file_exists(ROOTPATH . 'public/assets/img/' . $old->foto)) {
                unlink(ROOTPATH . 'public/assets/img/' . $old->foto);
            }

            log_activity(session()->get('id'), 'Mengubah foto setting web');
            session()->setFlashdata('success', 'Foto berhasil diperbarui.');
        } else {
            session()->setFlashdata('error', 'Gagal mengupload foto.');
        }
    } else {
        session()->setFlashdata('error', 'Tidak ada file yang dipilih.');
    }

    return redirect()->to('/beasiswa/setting');
}


    public function hapus_foto()
    {
        $id_user = $this->session->get('id');

        $user = $this->db->table('setting')->select('foto')->where('id', 1)->get()->getRow();
        if ($user && $user->foto && file_exists(ROOTPATH . 'assets/img/' . $user->foto)) {
            unlink(ROOTPATH . 'assets/img/' . $user->foto);
        }

        $this->db->table('setting')->where('id', 1)->update(['foto' => null]);
        log_activity($id_user, 'Menghapus Foto Web');

        $this->session->setFlashdata('success', 'Foto web berhasil dihapus!');
        return redirect()->to('/beasiswa/setting');
    }

    public function update_profile()
    {
        $id_user = $this->session->get('id');

        $email = $this->request->getPost('nama');
        $updateUserData = ['nama' => $email];

        $this->db->table('setting')->where('id', 1)->update($updateUserData);

        log_activity($id_user, 'Mengubah Data Foto Web');

        $this->session->setFlashdata('success', 'Web berhasil diperbarui.');
        return redirect()->to('/beasiswa/setting');
    }




}
