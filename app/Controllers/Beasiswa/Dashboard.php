<?php

namespace App\Controllers\Beasiswa;
use App\Models\Beasiswa\M_belajar;
use App\Models\Beasiswa\M_log;
use Config\Database;

class Dashboard extends BaseController
{
    protected $db;

 	protected $session;
    protected $M_belajar;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->M_belajar = new \App\Models\Beasiswa\M_belajar(); 
		helper(['url', 'log']);
        $this->db = Database::connect();

    }

    public function index () {


		$data['beasiswa'] = $this->db->table('beasiswa')
    ->where('aktif', 1)
    ->where('status_delete', 0)
    ->orderBy('deadline', 'ASC')
    ->get()
    ->getResult();



		
        echo view('beasiswa/dashboard', $data);
    }

}