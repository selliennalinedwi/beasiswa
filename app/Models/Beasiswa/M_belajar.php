<?php

namespace App\Models\Beasiswa;
use CodeIgniter\Model;

class M_belajar extends Model
{
	public function tampil($table,$by){
		return $this->db->table($table)
						->orderby($by,'asc')
						->get()
						->getResult();
	}
	public function settings()
    {
        return $this->db->table('setting')->orderBy('id', 'ASC')->get()->getRow();
    }
	public function profile(){
		$id = session()->get('id'); 

	return $this->db->table('user')
					->join('level', 'user.level=level.id_level', 'left')
					->where('user.id_user', $id)
					->get()
					->getRow();
	}
	public function user(){
		return $this->db->table('user')
					->join('level', 'user.level=level.id_level', 'left')
					->where('user.status_delete', 0)
					->get()
					->getResult();
	}
	public function log(){
		return $this->db->table('log')
					->select('log.*, user.username')
					->join('user', 'user.id_user=log.id_user')
					->get()
					->getResult();
	}
	public function userdelete(){
		return $this->db->table('user')
					->join('level', 'user.level=level.id_level', 'left')
					->where('user.status_delete', 1)
					->get()
					->getResult();
	}
	
	public function level(){
		return $this->db->table('level')	
					->where('status_delete', 0)
					->get()
					->getResult();
	}

	public function leveldelete(){
		return $this->db->table('level')
					->where('level.status_delete', 1)
					->get()
					->getResult();
	}

	public function softDeleteLevel($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('level')
                	->where('id_level', $id_alumni)
                	->update([
						'status_delete'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreLevel($id_alumni)
    {
        return $this->db->table('level')
               		->where('id_level', $id_alumni)
					->where('kas', 1)
                	->update([
						'status_delete'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function beasiswa(){
		return $this->db->table('beasiswa')	
					->where('status_delete', 0)
					->get()
					->getResult();
	}

	public function beasiswadelete(){
		return $this->db->table('beasiswa')
					->where('beasiswa.status_delete', 1)
					->get()
					->getResult();
	}

	public function softDeleteData($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('beasiswa')
                	->where('id_beasiswa', $id_alumni)
                	->update([
						'status_delete'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreData($id_alumni)
    {
        return $this->db->table('beasiswa')
               		->where('id_beasiswa', $id_alumni)
                	->update([
						'status_delete'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function softDelete($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('user')
                	->where('id_user', $id_alumni)
                	->update([
						'status_delete'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }

    public function restore($id_alumni)
    {
        return $this->db->table('user')
               		->where('id_user', $id_alumni)
                	->update([
						'status_delete'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function kategori(){
		return $this->db->table('kategori')	
					->join('rumah_ibadah', 'kategori.id_rumah=rumah_ibadah.id_rumah')
					->where('kategori.status', 0)
					->get()
					->getResult();
	}

	public function kategoridelete(){
		return $this->db->table('kategori')
					->join('rumah_ibadah', 'kategori.id_rumah=rumah_ibadah.id_rumah')
					->where('kategori.status', 1)
					->get()
					->getResult();
	}

	public function softDeleteKategori($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('kategori')
                	->where('id_kategori', $id_alumni)
                	->update([
						'status'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreKategori($id_alumni)
    {
        return $this->db->table('kategori')
               		->where('id_kategori', $id_alumni)
                	->update([
						'status'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function jkategori($where){
		return $this->db->table('kategori')
						->join('rumah_ibadah', 'rumah_ibadah.id_rumah=kategori.id_rumah')
						->where($where)
						->get()
						->getRow();
	}

	public function ibadah(){
		return $this->db->table('rumah_ibadah')	
					->where('status_delete', 0)
					->get()
					->getResult();
	}

	public function rumahdelete(){
		return $this->db->table('rumah_ibadah')
					->where('status_delete', 1)
					->get()
					->getResult();
	}

	public function softDeleteRumah($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('rumah_ibadah')
                	->where('id_rumah', $id_alumni)
                	->update([
						'status_delete'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreRumah($id_alumni)
    {
        return $this->db->table('rumah_ibadah')
               		->where('id_rumah', $id_alumni)
                	->update([
						'status_delete'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function kota(){
		return $this->db->table('kota')	
					->where('status_delete', 0)
					->get()
					->getResult();
	}

	public function kotadelete(){
		return $this->db->table('kota')
					->where('status_delete', 1)
					->get()
					->getResult();
	}

	public function softDeleteKota($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('kota')
                	->where('id_kota', $id_alumni)
                	->update([
						'status_delete'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreKota($id_alumni)
    {
        return $this->db->table('kota')
               		->where('id_kota', $id_alumni)
                	->update([
						'status_delete'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }
	
	public function cabang(){
		return $this->db->table('cabang')
					->join('rumah_ibadah', 'cabang.id_rumah=rumah_ibadah.id_rumah')
					->join('kota', 'cabang.id_kota=kota.id_kota')
					->where('cabang.status_delete', 0)
					->get()
					->getResult();
	}

	public function cabangdelete(){
		return $this->db->table('cabang')
					->join('rumah_ibadah', 'cabang.id_rumah=rumah_ibadah.id_rumah')
					->join('kota', 'cabang.id_kota=kota.id_kota')
					->where('cabang.status_delete', 1)
					->get()
					->getResult();
	}

	public function softDeleteCabang($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('cabang')
                	->where('id_cabang', $id_alumni)
                	->update([
						'status_delete'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreCabang($id_alumni)
    {
        return $this->db->table('cabang')
               		->where('id_cabang', $id_alumni)
                	->update([
						'status_delete'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function jcabang($where){
		return $this->db->table('cabang')
						->select('cabang.*, rumah_ibadah.nama, kota.nama_kota')
						->join('rumah_ibadah', 'rumah_ibadah.id_rumah=cabang.id_rumah')
						->join('kota', 'cabang.id_kota=kota.id_kota')
						->where($where)
						->get()
						->getRow();
	}

	public function transaksi()
	{
		return $this->db->table('transaksi')
			->select('transaksi.*, rumah_ibadah.nama, kota.nama_kota, cabang.nama_cabang, kategori.nama_kategori')
			->join('rumah_ibadah', 'transaksi.id_rumah = rumah_ibadah.id_rumah')
			->join('kategori', 'transaksi.id_kategori = kategori.id_kategori', 'left')
			->join('cabang', 'transaksi.id_cabang = cabang.id_cabang', 'left')
			->join('kota', 'cabang.id_kota = kota.id_kota', 'left')
			->where('transaksi.status', 0)
			->get()
			->getResult();
	}

	public function transaksidelete()
	{
		return $this->db->table('transaksi')
			->select('transaksi.*, rumah_ibadah.nama AS nama_rumah, kota.nama_kota, cabang.nama_cabang, kategori.nama_kategori')
			->join('rumah_ibadah', 'transaksi.id_rumah = rumah_ibadah.id_rumah')
			->join('kategori', 'transaksi.id_kategori = kategori.id_kategori', 'left')
			->join('cabang', 'transaksi.id_cabang = cabang.id_cabang', 'left')
			->join('kota', 'cabang.id_kota = kota.id_kota', 'left')
			->where('transaksi.status', 1)
			->get()
			->getResult();
	}

	public function softDeleteTransaksi($id_alumni)
    {
		$now = date('Y-m-d H:i:s');
        return $this->db->table('transaksi')
                	->where('id_transaksi', $id_alumni)
                	->update([
						'status'     => 1,
						'deleted_at' => $now,
                	]);
        return false;
    }
 
    public function restoreTransaksi($id_alumni)
    {
        return $this->db->table('transaksi')
               		->where('id_transaksi', $id_alumni)
                	->update([
						'status'     => 0,
						'deleted_at' => null,
                	]);
        return false;
    }

	public function jtransaksi($where)

	{
		return $this->db->table('transaksi')
			->select('transaksi.*, rumah_ibadah.nama AS nama_rumah, kota.nama_kota, cabang.nama_cabang, kategori.nama_kategori')
			->join('rumah_ibadah', 'transaksi.id_rumah = rumah_ibadah.id_rumah')
			->join('kategori', 'transaksi.id_kategori = kategori.id_kategori', 'left')
			->join('cabang', 'transaksi.id_cabang = cabang.id_cabang', 'left')
			->join('kota', 'cabang.id_kota = kota.id_kota', 'left')
			->where($where)
			->get()
			->getRow();
	}
	public function hei($table,$by, $where){
		return $this->db->table($table)
						->orderby($by,'asc')
						->where($where)
						->get()
						->getResult();
	}
	public function join($table, $table2, $on){
		return $this->db->table($table)
						->join($table2,$on)
						->get()
						->getResult();
	}

	public function jwhere($table, $table2, $on,$where){
		return $this->db->table($table)
						->join($table2,$on)
						->where($where)
						->get()
						->getResult();
	}
	public function jwhere1($table, $table2, $on,$where){
		return $this->db->table($table)
						->join($table2,$on)
						->where($where)
						->get()
						->getRow();
	}

	public function create($data){
		$query = $this->db->table($this->table)
						  ->insert($data);
						  return $query;
	}
	
	public function input($table, $data){
		 $this->db->table($table)
						->insert($data);
						return $this->db->insertID();
	}

	public function hapus($table, $where){
		return $this->db->table($table)
						->delete($where);
	}
	public function getWhere($table, $where){
		return $this->db->table($table)
						->getWhere($where)
						->getRow();
	}
	public function edit($table,$data,$where){
		return $this->db->table($table)
						->update($data,$where);
	}
	public function joinw($table, $table2, $on, $w){  
		return $this->db->table($table)
						->join($table2,$on)
						->where($w)
						->get()
						->getRow();
	}
	
}

