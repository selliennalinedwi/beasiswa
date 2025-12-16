<?php

namespace App\Controllers\Beasiswa;
use App\Models\Beasiswa\M_belajar;

class Login extends BaseController
{
	public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->M_belajar = new \App\Models\Beasiswa\M_belajar(); 
		helper(['url', 'log']);
    }


    public function index () {
        $angka1 = rand(1, 10);
		$angka2 = rand(1, 10);
		$soal = "$angka1 + $angka2";
		session()->set('captcha_jawaban', $angka1 + $angka2);

		echo view('beasiswa/login', ['soal_captcha' => $soal]);
    }
	public function aksi_login()
	{
		$isOnline = $this->request->getPost('is_online');

		if ($isOnline == "1") {
			$recaptcha_secret = "6LfW-uArAAAAAMUqNUbMgjygjENArvbPBjGRkV69"; 
			$recaptcha_response = $_POST['g-recaptcha-response'];

			$verify_url = "https://www.google.com/recaptcha/api/siteverify";
			$response = file_get_contents($verify_url . "?secret=" . $recaptcha_secret . "&response=" . $recaptcha_response);
			$response_keys = json_decode($response, true);

			if (!$response_keys["success"]) {
				return redirect()->back()->with('error', 'reCAPTCHA verification failed. Please try again.');
			}
		} else {
			$jawabanUser = $this->request->getPost('captcha_jawaban');
			$jawabanBenar = session()->get('captcha_jawaban');
			if ((int)$jawabanUser !== (int)$jawabanBenar) {
				return redirect()->back()->with('error', 'Jawaban captcha salah!');
			}
		}

		$a = $this->request->getPost('email');
		$b = $this->request->getPost('pswd');

		$love = new M_belajar;
		$data = [
			"username" => $a,
			"password" => MD5($b),
		];

		$cek = $love->getWhere('user', $data);

		if ($cek != null) {

			session()->set('id', $cek->id_user);
			session()->set('u', $cek->username);
			session()->set('level', $cek->level);
			session()->set('isLoggedIn', true);

			$id_user = $cek->id_user;
			log_activity($id_user, 'Berhasil login!');

			
				return redirect()->to('beasiswa/halaman');

		} else {
			return redirect()->back()->with('error', 'Email atau password salah!');
		}
	}

    public function logout(){
		session()->destroy();
		return redirect()->to('beasiswa/dashboard');
	}
}