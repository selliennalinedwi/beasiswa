<?php

namespace App\Controllers\Beasiswa;
use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\M_log;

class Data extends BaseController
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
        $hehe['love'] = $this->M_belajar->beasiswa();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data beasiswa.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/data/data', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function deleted () {

		$level = $this->session->get('level');
        $id_user = $this->session->get('id');
		$logModel = new M_log(); 
		if ($level === '1' || $level === '2' || $level === '3') {
		$apel['mey'] = $this->M_belajar->settings();
        $hehe['love'] = $this->M_belajar->beasiswadelete();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		log_activity($id_user, 'Mengakses data deleted beasiswa.');
		$headerData = array_merge($apel, $hee);
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/data/deleted', $hehe);
        echo view('beasiswa/admin/footer');
    }}

    public function edit($id)
    {

        $level = $this->session->get('level');
        $id_user = $this->session->get('id');
		if ($level === '1' || $level === '2' || $level === '3') {

            $where = ['id_beasiswa' => $id];
            $hehe['love'] = $this->M_belajar->getwhere('beasiswa', $where);

            $apel['mey'] = $this->M_belajar->settings();
            $hehe['level'] = $this->M_belajar->beasiswa();
		if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }

            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/data/editdata', $hehe);
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
            'nama_beasiswa' => $request->getPost('nama'),
            'jenjang' => $request->getPost('jenjang'),
            'deadline' => $request->getPost('deadline'),
            'kuota' => $request->getPost('kuota'),
            'deskripsi' => $request->getPost('deskripsi'),
            'syarat' => $request->getPost('syarat'),
            'kontak' => $request->getPost('kontak'),
            'aktif' => $request->getPost('aktif'),
            'updated_at' => date('Y-m-d H:i:s')
        ];


        $whereAlumni = ['id_beasiswa' => $id];
        $this->M_belajar->edit('beasiswa', $dataAlumni, $whereAlumni);

        log_activity(session()->get('id'), 'Mengedit data beasiswa ' . $dataAlumni['nama_beasiswa'] . ' dengan ID: ' . $id);

        return redirect()->to('beasiswa/data');
    }

    public function soft($id_alumni)
    {
        $result = $this->M_belajar->softDeleteData($id_alumni);
        log_activity(session()->get('id'), "Menghapus data beasiswa dengan ID: " . $id_alumni);

        if ($result) {
            session()->setFlashdata('success', 'beasiswa berhasil dihapus (soft delete)');
        } else {
            session()->setFlashdata('error', 'beasiswa tidak ditemukan');
        }

        return redirect()->to('beasiswa/data/deleted');
    }

    public function restore($id_alumni)
    {
        $result = $this->M_belajar->restoreData($id_alumni);
        log_activity(session()->get('id'), "Merestore data beasiswa dengan ID: " . $id_alumni);

        if ($result) {
            session()->setFlashdata('success', 'beasiswa berhasil direstore');
        } else {
            session()->setFlashdata('error', 'beasiswa tidak ditemukan');
        }

        return redirect()->to('beasiswa/data');
    }

	public function input()
    {
        $level = $this->session->get('level');
        $id_user = $this->session->get('id');
        if ($level === '1' || $level === '2' || $level === '3') {
            $apel['mey'] = $this->M_belajar->settings();
            $hehe['level'] = $this->M_belajar->beasiswa();

            if ($level === '1' || $level === '2' || $level === '3') {
                $where = ['user.id_user' => $id_user];
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }

            log_activity($id_user, 'Mengakses halaman Input beasiswa.');
            $headerData = array_merge($apel, $hee);
            echo view('beasiswa/admin/header', $headerData);
            echo view('beasiswa/data/inputdata', $hehe);
            echo view('beasiswa/admin/footer');
        }
    }

    public function inputsave()
{
    $session = session();

    $userData = [
        'nama_beasiswa' => $this->request->getPost('nama'),
        'penyelenggara'       => $this->request->getPost('penyelenggara'),
        'jenjang'       => $this->request->getPost('jenjang'),
        'deadline'      => $this->request->getPost('deadline'),
        'kuota'         => $this->request->getPost('kuota'),
        'deskripsi'     => $this->request->getPost('deskripsi'),
        'syarat'        => $this->request->getPost('syarat'),
        'kontak'        => $this->request->getPost('kontak'),
        'aktif'         => $this->request->getPost('aktif'),
        'created_at'    => date('Y-m-d H:i:s'),
    ];

    $this->M_belajar->input('beasiswa', $userData);

    log_activity($session->get('id'), "Menambahkan beasiswa: {$userData['nama_beasiswa']}");

    return redirect()->to(base_url('beasiswa/data'));
}

}