<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

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

	function __construct(){
		parent::__construct();
		$this->load->model('sitemodel');
		$this->load->model('loginmodel');
		$this->load->model('model_artikel');


	}

	public function index()
	{
			$data['artikel'] = $this->model_artikel->getArtikel();
			$this->load->view('frontend/frontend', $data);
	}

	public function detailArtikel($id = null)
  {
    // Ambil data berita dari database
    $artikel = $this->model_artikel->get_where(array('id_artikel' => $id))->row();


    // Jika data berita tidak ada maka show 404
    if (!$artikel) show_404();

    // Data untuk page berita/detail

    $data['artikel'] = $artikel;
		$data['list_artikel'] = $this->model_artikel->getArtikel();

    // Jalankan view template/layout
    $this->load->view('frontend/detailArtikel', $data);
  }

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('site'));
	}
}
