<?php

namespace App\Controllers\Beasiswa;
use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\M_log;

class Level extends BaseController
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
        $hehe['love'] = $this->M_belajar->level();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data Level.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/level/level', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function deleted () {

		$level = $this->session->get('level');
        $id_user = $this->session->get('id');
		$logModel = new M_log(); 
		if ($level === '1' || $level === '2' || $level === '3') {
		$apel['mey'] = $this->M_belajar->settings();
        $hehe['love'] = $this->M_belajar->leveldelete();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data deleted level.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/level/deleted', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function edit($id)
    {

        $level = $this->session->get('level');
        $id_user = $this->session->get('id');
		if ($level === '1' || $level === '2' || $level === '3') {

            $where = ['id_level' => $id];
            $hehe['love'] = $this->M_belajar->getwhere('level', $where);

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
            echo view('beasiswa/level/editlevel', $hehe);
            echo view('beasiswa/admin/footer');
        }
    }

    public function editsave()
    {
        $request = service('request');
        $id = $request->getPost('id');
        $email = $request->getPost('email');
        $password = $request->getPost('password');

        $dataAlumni = [
            'nama_level' => $request->getPost('nama'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $whereAlumni = ['id_level' => $id];
        $this->M_belajar->edit('level', $dataAlumni, $whereAlumni);

        log_activity(session()->get('id'), 'Mengedit data level ' . $dataAlumni['nama_level'] . ' dengan ID: ' . $id);

        return redirect()->to('beasiswa/level');
    }

    public function soft($id_alumni)
    {
        $result = $this->M_belajar->softDeleteLevel($id_alumni);
        log_activity(session()->get('id'), "Menghapus data level dengan ID: " . $id_alumni);

        if ($result) {
            session()->setFlashdata('success', 'Level berhasil dihapus (soft delete)');
        } else {
            session()->setFlashdata('error', 'Level tidak ditemukan');
        }

        return redirect()->to('beasiswa/level/deleted');
    }

    public function restore($id_alumni)
    {
        $result = $this->M_belajar->restoreLevel($id_alumni);
        log_activity(session()->get('id'), "Merestore data level dengan ID: " . $id_alumni);

        if ($result) {
            session()->setFlashdata('success', 'Level berhasil direstore');
        } else {
            session()->setFlashdata('error', 'Level tidak ditemukan');
        }

        return redirect()->to('beasiswa/level');
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

            log_activity($id_user, 'Mengakses halaman Input Level.');
            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/level/inputlevel', $hehe);
            echo view('beasiswa/admin/footer');
        }
    }

    public function inputsave()
    {
        $session = session();

        $userData = [
            'nama_level' => $this->request->getPost('nama'),
           'created_at' => date('Y-m-d H:i:s'),
        ];

        $success = $this->M_belajar->input('level', $userData);
        $id_user = $this->db->insertID();
        log_activity($session->get('id'), "Menambahkan level: {$userData['nama_level']}");

        return redirect()->to(base_url('beasiswa/level'));
    }
}