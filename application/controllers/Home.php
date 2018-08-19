<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
    parent::__construct();
    
    $this->load->model('m_berita');
  }

	public function index()
	{
		$this->load->view('dashboard');
	}

	public function bupati()
	{
		$this->load->view('input_kegiatan_bupati');
	}

	public function pemerintah()
	{
		$this->load->view('input_kegiatan_pemerintah');
	}

	public function wakilbupati()
	{
		$this->load->view('input_kegiatan_wakil_bupati');
	}

	public function uploadnaskah()
	{
		$this->load->view('input_naskah');
	}

	public function inputberita() {
		$this->load->model("m_berita");
		if ($this->input->post("submit")) {
			$judul_berita = $this->input->post("judul_berita");
			$tanggal_berita = $this->input->post("tanggal_berita");
			$lokasi_berita = $this->input->post("lokasi_berita");
			$deskripsi_berita = $this->input->post("deskripsi_berita");
			// $foto_berita = $this->upload->data();

			$config['upload_path']          = './pict/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			// $this->load->library('upload', $config);

			// $this->upload->inputberita('gambar');
   //      	$result1 = $this->upload->data();

			$object = array(
				"judul_berita" => $judul_berita, 
				"tanggal_berita" => $tanggal_berita, 
				"lokasi_berita" => $lokasi_berita,
				"deskripsi_berita" => $deskripsi_berita,
				// "foto_berita" => $foto_berita

			);

			if ($this->m_berita->masukanData($object)) {
				$this->load->model('m_berita');
				$data["berita"] = $this->m_berita->ambilData()->result();
				$this->load->view('dashboard', $data);
			} else {
				echo "Gagal di Simpan";
			}
		}
	}

	public function inputkegiatanbupati() {
		$this->load->model("m_berita");
		if ($this->input->post("submit")) {
			$nama_kegiatan_b = $this->input->post("nama_kegiatan_b");
			$tanggal_kegiatan_b = $this->input->post("tanggal_kegiatan_b");
			$tempat_kegiatan_b = $this->input->post("tempat_kegiatan_b");
			$deskripsi_kegiatan_b = $this->input->post("deskripsi_kegiatan_b");
			

			$config['upload_path']          = './pict/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$this->load->library('upload', $config);

			$this->upload->do_upload('foto_kegiatan_b');
        	$foto_kegiatan_b = $this->upload->data();

			$object = array(
				"nama_kegiatan_b" => $nama_kegiatan_b, 
				"tanggal_kegiatan_b" => $tanggal_kegiatan_b, 
				"tempat_kegiatan_b" => $tempat_kegiatan_b,
				"deskripsi_kegiatan_b" => $deskripsi_kegiatan_b,
				
			);

			if ($this->m_berita->inputkegiatanB($object)) {
				$this->load->model('m_berita');
				$data["tb_bupati"] = $this->m_berita->ambilDataB()->result();
				$this->load->view('input_kegiatan_bupati', $data);
			} else {
				echo "Gagal di Simpan";
			}
		}
	}



public function tambah(){
    $data = array();
    
    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di m_berita
      $upload = $this->m_berita->upload();
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di m_berita untuk menyimpan data ke database
        $this->m_berita->save($upload);
        
        redirect('home/uploadnaskah'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('input_naskah', $data);
  }

  public function tambahberita(){
    $data = array();
    
    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di m_berita
      $upload = $this->m_berita->uploadberita();
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di m_berita untuk menyimpan data ke database
        $this->m_berita->saveberita($upload);
        
        redirect('home'); // Redirect kembali ke halaman awal / halaman view data
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('dashboard', $data);
  }

public function tambahkegiatanbupati1(){
    $data = array();
    
    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di m_berita
      $upload = $this->m_berita->uploadkegiatanbupati1();
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di m_berita untuk menyimpan data ke database
        $this->m_berita->savekegiatanbupati1($upload);
        
        redirect('Selamat, data berhasil diinput','home/bupati'); // Redirect kembali ke halaman awal / halaman view data
        echo "<script> alert('Data Tersimpan')</script>";
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('input_kegiatan_bupati', $data);
  }


public function tambahkegiatanwakil(){
    $data = array();
    
    if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
      // lakukan upload file dengan memanggil function upload yang ada di m_berita
      $upload = $this->m_berita->uploadkegiatanwakil();
      
      if($upload['result'] == "success"){ // Jika proses upload sukses
         // Panggil function save yang ada di m_berita untuk menyimpan data ke database
        $this->m_berita->savekegiatanwakil($upload);
        
        redirect('Selamat, data berhasil diinput','home/wakil'); // Redirect kembali ke halaman awal / halaman view data
        echo "<script> alert('Data Tersimpan')</script>";
      }else{ // Jika proses upload gagal
        $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
      }
    }
    
    $this->load->view('input_kegiatan_bupati', $data);
  }










}



