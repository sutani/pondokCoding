<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_artikel extends CI_Model {
	  public $table = 'artikel';

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this->load->library('fungsi');
	}

	function getArtikel() {
        //$this->db->get('mobil');
        //return $this->db->order_by('type','ASC')->result();
    $this->db->from("artikel");
		$this->db->order_by("id_artikel", "ASC");
		$query = $this->db->get();
		return $query->result();
    }

		public function get_where($where)
    {
      // Jalankan query
      $query = $this->db
        ->where($where)
        ->get($this->table);

      // Return hasil query
      return $query;
    }

    function GetData($id) {
    	//return $this->db->where('idmerk', $id)->get('merk')->result_array();
    	//echo "ID:".$id;
    	//$id = $this->uri->segment(3);
    	$id = $this->uri->segment(3);
    	return $this->db->get_where('artikel', array('id_artikel'=> $id))->row();
    }

    public function getMerk(){
  		//return $this->db->from("merk")->order_by('namamerk', 'ASC')->result();

  		$this->db->from("merk");
		$this->db->order_by("namamerk", "ASC");
		$query = $this->db->get();
		return $query->result();

 	}

 	public function insert()
	{

		$judul 		= $this->input->post('judul_artikel');
		$isi    	= $this->input->post('isi_artikel');
		$author 		= $this->input->post('author');
		$foto 		= $this->input->post('gambar_artikel');

		$sekarang	= $this->fungsi->hariini();

		$image_info = $this->upload->data();
		$file_name 	= $image_info['file_name'];

		$input = array (
			'judul_artikel' => $judul,
	    'isi_artikel'  => $isi,
			 'gambar_artikel' => $file_name,
			   'author' => $author,
		  	'tanggal' 			=> $sekarang,

		);

		return $this->db->insert('artikel', $input);
	}

	public function delete($param) {
		return $this->db->delete('artikel', array('id_artikel' => $param));
	}

}
