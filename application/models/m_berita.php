<?php 
	defined('BASEPATH') OR EXIT ('No direct script access allowed');

	class m_berita extends CI_Model{
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function tampil_data(){
			return $this->db->get("pengguna");
		}

		public function input_data($object){
			return $this->db->insert("pengguna", $object);
		}		

		public function hapus_data($id){
			$this->db->where("id", $id);
			return $this->db->delete("pengguna");
		}

		public function edit_data($id){
			$this->db->where("id", $id);
			return $this->db->get("pengguna");
		}

		public function update_data($id, $object){
			$this->db->where("id", $id);
			return $this->db->update("pengguna", $object);
		}

		function cek_login($username, $password){
			$this->db->select('username', 'password');
			$this->db->from('pengguna');
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$this->db->limit(1);
			
			$query = $this->db->get();
			if ($query->num_rows()==1) {
				return $query->result();
			} else {
				return false;
			}
		}

	    // function data_login($username,$password) {
	    //     $this->db->where('username', $username);
	    //     $this->db->where('password', $password);
	    //     return $this->db->get("pelanggan")->row();
	    // }

	    public function masukanData($object){
			return $this->db->insert("berita", $object);
		}	

		public function ambilData() {
		return $this->db->get("berita");
		}

 		public function inputkegiatanB($object){
			return $this->db->insert("tb_bupati", $object);
		}	
		public function ambilDataB() {
		return $this->db->get("tb_bupati");
		}




		public function uploadberita(){
    	$config['upload_path'] = './pict/';
    	$config['allowed_types'] = 'jpg|png|jpeg|pdf';
    	$config['max_size']  = '2048';
    	$config['remove_space'] = TRUE;
  
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('foto_berita')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  // Fungsi untuk menyimpan data ke database
  public function saveberita($upload){
    $data = array(
      'judul_berita'=>$this->input->post('judul_berita'),
      'tanggal_berita'=>$this->input->post('tanggal_berita'),
  		'lokasi_berita'=>$this->input->post('lokasi_berita'),
  		'deskripsi_berita'=>$this->input->post('deskripsi_berita'),
      'foto_berita' => $upload['file']['file_name']
    );
    
    $this->db->insert('berita', $data);
  }


// Fungsi untuk melakukan proses upload file
  public function upload(){
    $config['upload_path'] = './pict/';
    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
    $config['max_size']  = '2048';
    $config['remove_space'] = TRUE;
  
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('file_naskah')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  // Fungsi untuk menyimpan data ke database
  public function save($upload){
    $data = array(
      'judul_naskah'=>$this->input->post('judul_naskah'),
      'nama_file' => $upload['file']['file_name'],
      'ukuran_file' => $upload['file']['file_size'],
      'tipe_file' => $upload['file']['file_type'],
      'lokasi_file' => $upload['file']['full_path']
    );
    
    $this->db->insert('tb_naskah', $data);
  }


public function uploadkegiatanbupati1(){
    $config['upload_path'] = './pict/bupati';
    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
    $config['max_size']  = '2048';
    $config['remove_space'] = TRUE;
  
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('foto_kegiatan_b')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  // Fungsi untuk menyimpan data ke database
  public function savekegiatanbupati1($upload){
    $data = array(
      'nama_kegiatan_b'=>$this->input->post('nama_kegiatan_b'),
       'tanggal_kegiatan_b'=>$this->input->post('tanggal_kegiatan_b'),
  		'tempat_kegiatan_b'=>$this->input->post('tempat_kegiatan_b'),
  		'deskripsi_kegiatan_b'=>$this->input->post('deskripsi_kegiatan_b'),
      'foto_kegiatan_b' => $upload['file']['file_name']
    );
    
    $this->db->insert('tb_bupati2', $data);
  }

  public function uploadkegiatanwakil(){
    $config['upload_path'] = './pict';
    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
    $config['max_size']  = '2048';
    $config['remove_space'] = TRUE;
  
    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('foto_kegiatan_w')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    }else{
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  // Fungsi untuk menyimpan data ke database
  public function savekegiatanwakilbupati($upload){
    $data = array(
      'nama_kegiatan_w'=>$this->input->post('nama_kegiatan_w'),
       'tanggal_kegiatan_w'=>$this->input->post('tanggal_kegiatan_w'),
  		'tempat_kegiatan_w'=>$this->input->post('tempat_kegiatan_w'),
  		'deskripsi_kegiatan_w'=>$this->input->post('deskripsi_kegiatan_w'),
      'foto_kegiatan_w' => $upload['file']['file_name']
    );
    
    $this->db->insert('tb_wakil_bupati', $data);
  }






	}
?>