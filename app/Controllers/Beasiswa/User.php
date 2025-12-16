<?php

namespace App\Controllers\Beasiswa;
use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\M_log;

class User extends BaseController
{

 	protected $session;
    protected $M_belajar;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->M_belajar = new \App\Models\Beasiswa\M_belajar(); 
        $this->db = \Config\Database::connect();
		helper(['url', 'log']);
    }

    public function index () {

		$level = $this->session->get('level');
        $id_user = $this->session->get('id');
		$logModel = new M_log(); 
		if ($level === '1' || $level === '2' || $level === '3') {
		$apel['mey'] = $this->M_belajar->settings();
        $hehe['love'] = $this->M_belajar->user();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data User.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/user/user', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function deleted () {

		$level = $this->session->get('level');
        $id_user = $this->session->get('id');
		$logModel = new M_log(); 
		if ($level === '1' || $level === '2' || $level === '3') {
		$apel['mey'] = $this->M_belajar->settings();
        $hehe['love'] = $this->M_belajar->userdelete();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data deleted user.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/user/deleted', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function edit($id)
    {

        $level = $this->session->get('level');
        $id_user = $this->session->get('id');
		if ($level === '1' || $level === '2' || $level === '3') {

            $where = ['user.id_user' => $id];
            $hehe['love'] = $this->M_belajar->jwhere1('user', 'level', 'user.level=level.id_level', $where);

            $apel['mey'] = $this->M_belajar->settings();
            $hehe['level'] = $this->M_belajar->level();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }

            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/user/edituser', $hehe);
            echo view('beasiswa/admin/footer');
        }
    }

    public function editsave()
    {
        $request = service('request');
        $id = $request->getPost('id');
        $password = $request->getPost('password');

        $dataAlumni = [
            'nama' => $request->getPost('nama'),
            'username' => $request->getPost('username'),
            'level' => $request->getPost('level'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $whereAlumni = ['id_user' => $id];
        $this->M_belajar->edit('user', $dataAlumni, $whereAlumni);

        log_activity(session()->get('id'), 'Mengedit data user ' . $dataAlumni['nama'] . ' dengan ID: ' . $id);

        return redirect()->to('beasiswa/user');
    }

    public function soft($id_alumni)
    {
        $result = $this->M_belajar->softDelete($id_alumni);
        log_activity(session()->get('id'), "Menghapus data user dengan ID: " . $id_alumni);

        if ($result) {
            session()->setFlashdata('success', 'User berhasil dihapus (soft delete)');
        } else {
            session()->setFlashdata('error', 'User tidak ditemukan');
        }

        return redirect()->to('beasiswa/user/deleted');
    }

    public function restore($id_alumni)
    {
        $result = $this->M_belajar->restore($id_alumni);
        log_activity(session()->get('id'), "Merestore data user dengan ID: " . $id_alumni);

        if ($result) {
            session()->setFlashdata('success', 'User berhasil direstore');
        } else {
            session()->setFlashdata('error', 'User tidak ditemukan');
        }

        return redirect()->to('beasiswa/user');
    }

	public function input()
    {
        $level = $this->session->get('level');
        $id_user = $this->session->get('id');
		if ($level === '1' || $level === '2' || $level === '3') {
            $apel['mey'] = $this->M_belajar->settings();
            $hehe['level'] = $this->M_belajar->level();

		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }

            log_activity($id_user, 'Mengakses halaman Input User.');
            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/user/inputuser', $hehe);
            echo view('beasiswa/admin/footer');
        }
    }

    public function inputsave()
    {
        $session = session();

        $file = $this->request->getFile('file');
        $filename = '';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('assets_olimpiade/img', $filename);
        }

        $password = md5($this->request->getPost('password'));

        $userData = [
            'foto' => $filename,
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => $password,
            'level' => $this->request->getPost('level'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $success = $this->M_belajar->input('user', $userData);
        $id_user = $this->db->insertID();
        log_activity($session->get('id'), "Menambahkan user: {$userData['nama']} dengan ID user: {$id_user}");

        return redirect()->to(base_url('kas/user'));
    }

    public function log () {

		$level = $this->session->get('level');
        $id_user = $this->session->get('id');
		$logModel = new M_log(); 
		if ($level === '1' || $level === '2' || $level === '3') {
		$apel['mey'] = $this->M_belajar->settings();
        $hehe['love'] = $this->M_belajar->log();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data Log Activity.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/user/log', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function reset_password($id)
    {
        $userModel = new \App\Models\Olimpiade\UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            session()->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('beasiswa/user');
        }

        $username = $user['username'];
        $newPassword = MD5($username);

        $userModel->update($id, ['password' => $newPassword]);

        session()->setFlashdata('success', 'Password berhasil direset ke username.');
        return redirect()->to('beasiswa/user');
    }

}