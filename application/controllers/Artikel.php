<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {

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

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('model_artikel');

		//cek apakah sudah login atau belum
		if($this->session->userdata('status') != "login"){
			$this->session->set_flashdata('info', 'Maaf, Anda harus login terlebih dahulu.');
			redirect(base_url("site"));
		}
	}

	public function index()
	{
		$data['artikel'] = $this->model_artikel->getArtikel();
		$data['content'] = "artikel/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{

		if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('judul_artikel', 'Field of Judul Artikel', 'required');
				$this->form_validation->set_rules('isi_artikel', 'Field of Isi Artikel', 'required');
				$this->form_validation->set_rules('author', 'Field of Author', 'required');
				//$this->form_validation->set_rules('foto', 'Field of Foto Mobil', 'required');

				if ($this->form_validation->run() == FALSE)
		                {
		                	$data['artikel'] = $this->model_artikel->status();
		                    return $this->fungsi->status();
							$data['content'] = "artikel/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {
			                    $config['upload_path']          = './img/';
				                $config['allowed_types']        = 'gif|jpg|png';
				                //$config['max_size']             = 100;
				                //$config['max_width']            = 1024;
				                //$config['max_height']           = 768;
				                $this->load->library('upload', $config);

				                if (!$this->upload->do_upload('gambar_artikel')) {
					                // jika validasi file gagal, kirim parameter error ke index
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
					                // jika berhasil upload ambil data dan masukkan ke database
					                $upload_data = $this->upload->data();
					 				$file_name 	=   $upload_data['file_name'];

					                $insert = $this->model_artikel->insert();
				                    if($insert)
										{
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('artikel');
										}
					            }

		                }

			} else {
				$data['list'] = $this->model_artikel->getMerk();
				$data['content'] = "artikel/add";
				$this->load->view('template/template', $data);
			}



	}

	public function edit()
	{
		$this->load->library('fungsi');

		if($this->input->post('submit'))
			{

				//cek upload foto atau tidak
				if(isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name']))
				{

				$id 		= $this->input->post('id');
				$type 		= $this->input->post('type');
				$idmerk 	= $this->input->post('idmerk');
				$tahun 		= $this->input->post('tahun');
				$plat 		= $this->input->post('plat');
				$kursi 		= $this->input->post('kursi');
				$tarif 		= $this->input->post('tarif');
				$lembur 	= $this->input->post('lembur');
				$rangka 	= $this->input->post('rangka');

				$config['upload_path']          = './img/';
                $config['allowed_types']        = 'gif|jpg|png';
                //$config['max_size']             = 100;
                //$config['max_width']            = 1024;
                //$config['max_height']           = 768;
                $this->load->library('upload', $config);

				$image_info = $this->upload->data();
				$file_name 	= $image_info['file_name'];


						$field = array (
							'update' 		=> $this->fungsi->hariini(),
						    'type' 			=> $type,
						    'idmerk'  		=> $idmerk,
						    'tahunproduksi' => $tahun,
						    'platnomer'  	=> $plat,
						    'kursi'  		=> $kursi,
						    'tarif'  		=> $tarif,
						    'lembur'  		=> $lembur,
						    'norangka'  	=> $rangka,
						    'foto'			=> $_FILES['foto']['name']
						);

				                if (!$this->upload->do_upload('foto')) {
					                // jika validasi file gagal, kirim parameter error ke index
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
						                $this->db->where('idmobil', $id);
										$this->db->update('mobil', $field);

										if($this->db->affected_rows()) {
											$this->session->set_flashdata('info', 'Data berhasil diupdate');
											redirect('mobil');
										} else {
											$this->session->set_flashdata('info', 'Data gagal diupdate');
											redirect('mobil');
										}
								}

				} else {

				$id 		= $this->input->post('id');
				$type 		= $this->input->post('type');
				$idmerk 	= $this->input->post('idmerk');
				$tahun 		= $this->input->post('tahun');
				$plat 		= $this->input->post('plat');
				$kursi 		= $this->input->post('kursi');
				$tarif 		= $this->input->post('tarif');
				$lembur 	= $this->input->post('lembur');
				$rangka 	= $this->input->post('rangka');

						$field = array (
							'update' 		=> $this->fungsi->hariini(),
						    'type' 			=> $type,
						    'idmerk'  		=> $idmerk,
						    'tahunproduksi' => $tahun,
						    'platnomer'  	=> $plat,
						    'kursi'  		=> $kursi,
						    'tarif'  		=> $tarif,
						    'lembur'  		=> $lembur,
						    'norangka'  	=> $rangka
						);

						$this->db->where('idmobil', $id);
						$this->db->update('mobil', $field);

						if($this->db->affected_rows()) {
							$this->session->set_flashdata('info', 'Data berhasil diupdate');
							redirect('mobil');
						} else {
							$this->session->set_flashdata('info', 'Data gagal diupdate');
							redirect('mobil');
						}

				}

			} else {
				$id = $this->uri->segment(3);
				$data['edit'] = $this->mobilmodel->GetData($id);
				$data['list'] = $this->mobilmodel->getMerk();
				$data['content'] = "mobil/edit";
				$this->load->view('template/template', $data);
			}

	}

	public function hapus($id)
	{
		$this->mobilmodel->delete($id);

		if($this->db->affected_rows()) {
			$this->session->set_flashdata('info', 'Data berhasil dihapus');
			redirect('mobil');
		} else {
			$this->session->set_flashdata('info', 'Data gagal dihapus');
			redirect('mobil');
		}
	}

}
