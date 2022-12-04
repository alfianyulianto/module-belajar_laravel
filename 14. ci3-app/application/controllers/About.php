<?php

class About extends CI_Controller
{
  // method index
  public function index($nama = 'Alfian', $pekerjaan = 'Mahasiswa')
  {
    $this->session->unset_userdata('keyword');    // untuk unset session 
    $data['judul'] = 'Halaman About';
    $data['nama'] = $nama;
    $data['pekerjaan'] = $pekerjaan;
    $this->load->view('tamplates/header', $data);
    $this->load->view('about/index', $data);
    $this->load->view('tamplates/footer');
  }
}
