<?php

namespace App\Controllers\Beasiswa;

use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\MenuModel;
use App\Models\Beasiswa\M_user;

class Profile extends BaseController
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
    public function updateprofileajax()
{
    if ($this->request->isAJAX()) {
        $email = $this->request->getJSON()->email ?? null;
        $username = $this->request->getJSON()->username ?? null;

        $userId = session()->get('id'); 

        if ($userId && $email && $username) {
            $db = \Config\Database::connect();
            $builder = $db->table('user');
            $builder->where('id_user', $userId);
            $builder->update([
                'nama' => $email,
                'username' => $username
            ]);

            return $this->response->setJSON(['success' => true]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Data tidak lengkap']);
    }

    return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Akses ditolak']);
}

    public function index()
    {
        $level = $this->session->get('level');
        $id_user = $this->session->get('id');

        if ($level == 1 || $level == 2) {
            $apel['mey'] = $this->absenModel->settings();

            $data = [
                'title' => 'Data User',
                'anjas' => $this->absenModel->user(),
                'showWelcome' => false
            ];

		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->absenModel->profile();
            } else {
                $hee['prof'] = null;
            }

            log_activity($id_user, 'Mengakses halaman Profile.');
            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/profile', $data);
            echo view('beasiswa/admin/footer');
        }
    }

    public function update_foto()
    {
        $id_user = $this->session->get('id');
        $updateUserData = [];

        $fotoFile = $this->request->getFile('foto');
        if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
            $newName = $fotoFile->getRandomName();

            if ($fotoFile->move(ROOTPATH . 'assets_olimpiade/img', $newName)) {
                // Hapus foto lama jika ada
                $oldFoto = $this->db->table('user')->getWhere(['id_user' => $id_user])->getRow()->foto;
                if ($oldFoto && file_exists(ROOTPATH . 'assets_olimpiade/img/' . $oldFoto)) {
                    unlink(ROOTPATH . 'assets_olimpiade/img/' . $oldFoto);
                }
                $updateUserData['foto'] = $newName;
            } else {
                $this->session->setFlashdata('error', 'Gagal mengupload foto.');
                return redirect()->to('/beasiswa/profile');
            }
        }

        if (!empty($updateUserData)) {
            $this->db->table('user')->where('id_user', $id_user)->update($updateUserData);
            log_activity($id_user, 'Mengubah Foto Profil');
        } else {
            log_activity($id_user, 'Mengubah Data Profil');
        }

        $this->session->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to('/beasiswa/profile');
    }

    public function hapus_foto()
    {
        $id_user = $this->session->get('id');

        $user = $this->db->table('user')->select('foto')->where('id_user', $id_user)->get()->getRow();
        if ($user && $user->foto && file_exists(ROOTPATH . 'assets_olimpiade/img/' . $user->foto)) {
            unlink(ROOTPATH . 'assets_olimpiade/img/' . $user->foto);
        }

        $this->db->table('user')->where('id_user', $id_user)->update(['foto' => null]);
        log_activity($id_user, 'Menghapus Foto Profile');

        $this->session->setFlashdata('success', 'Foto profil berhasil dihapus!');
        return redirect()->to('/beasiswa/profile');
    }

    public function update_profile()
    {
        $id_user = $this->session->get('id');

        $email = $this->request->getPost('nama');
        $username = $this->request->getPost('username');
        $updateUserData = ['nama' => $email, 'username' => $username];

        $this->db->table('user')->where('id_user', $id_user)->update($updateUserData);

        log_activity($id_user, 'Mengubah Data Profil');

        $this->session->setFlashdata('success', 'Profil berhasil diperbarui.');
        return redirect()->to('/beasiswa/profile');
    }



public function changepassword()
{
    $session = session();
    $id_user = $session->get('id'); 
    $db = \Config\Database::connect();
    $user = $db->table('user')->where('id_user', $id_user)->get()->getRow();

    $currentPassword = $this->request->getPost('password');
    $newPassword     = $this->request->getPost('newpassword');
    $renewPassword   = $this->request->getPost('renewpassword');

    // Cek apakah password di DB adalah md5 (panjang 32 karakter dan hanya hex)
    $isMd5 = strlen($user->password) === 32 && ctype_xdigit($user->password);

    $passwordValid = false;
    if ($isMd5) {
        $passwordValid = (md5($currentPassword) === $user->password);
    } else {
        $passwordValid = password_verify($currentPassword, $user->password);
    }

    if (!$passwordValid) {
        $session->setFlashdata('password_error', 'Password lama salah.');
        return redirect()->to('/beasiswa/profile');
    }

    if ($newPassword !== $renewPassword) {
        $session->setFlashdata('password_error', 'Konfirmasi password tidak cocok.');
        return redirect()->to('/beasiswa/profile');
    }

    // Simpan password baru dengan MD5
    $db->table('user')->where('id_user', $id_user)->update([
        'password' => md5($newPassword)
    ]);

    $session->setFlashdata('password_success', 'Password berhasil diubah.');
    return redirect()->to('/beasiswa/profile');
}



}
