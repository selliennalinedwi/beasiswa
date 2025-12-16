<?php

namespace App\Controllers\Beasiswa;
use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\M_log;

class Halaman extends BaseController
{

 	protected $session;
    protected $M_belajar;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->M_belajar = new \App\Models\Beasiswa\M_belajar(); 
		helper(['url', 'log']);
    }

    public function index () {

		$level = $this->session->get('level');
        $id_user = $this->session->get('id');
		$logModel = new M_log(); 
		$jumlahLog = $logModel->where('id_user', $id_user)
                      ->where('activity', 'Berhasil login!')
                      ->countAllResults();

		$firstLogin = ($jumlahLog <= 1);

		$apel['mey'] = $this->M_belajar->settings();

		if ($level === '1' || $level === '2' || $level === '3') {
                $hee['prof'] = $this->M_belajar->profile();
            } else {
                $hee['prof'] = null;
            }
		
		$headerData = array_merge($apel, $hee);
		$hehe = array_merge($hee, ['firstLogin' => $firstLogin]);
		log_activity($id_user, 'Mengakses halaman dashboard admin.');
        echo view('beasiswa/admin/header', $headerData);
        echo view('beasiswa/halaman', $hehe);
        echo view('beasiswa/admin/footer');
    }

}