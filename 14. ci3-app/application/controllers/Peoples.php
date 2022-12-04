<?php

class Peoples extends CI_Controller
{
  // method default
  public function index()
  {
    // memangil view
    $data['judul'] = 'List of Peoples';
    // load model 
    // $this->load->model('model_name', 'alias') : untuk membuat nama alias pada sebuah model
    $this->load->model('Peoples_model', 'peoples');
    // $data['peoples'] = $this->peoples->getAllPeoples();   // untuk mengambil data dari file models/Peoples_model.php dengan method getAllPeoples()

    // ambil data keyword
    if ($this->input->post('keyword')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);    // set session agar saat berpindah halaman masih ada data yang dikirimkan
    } else {
      $data['keyword'] = $this->session->userdata('keyword');   // masukan session ke dalam array untuk digunakan di method getPeoples;
    }

    // load pagination
    $this->load->library('pagination');

    // config
    if ($this->session->userdata('keyword')) {
      $this->db->like('name', $data['keyword']);
      $this->db->or_like('email', $data['keyword']);
      $this->db->from('peoples');
      $config['total_rows'] = $this->db->count_all_results();   // untuk menghitung berapa baris yg dikembalikan pada query terakhti yg kita lakukan
    } else {
      $config['total_rows'] = $this->peoples->countAllPeople();   // untuk menentukan jumlah data pada tabel
    }
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;   // untuk menentukan mau beropa data perhalaman

    // initialize
    $this->pagination->initialize($config);

    // segment url
    $data['start'] = $this->uri->segment(3);    // untuk mengambil segment yg ada di url dengan parameter index ke 3
    $data['peoples'] = $this->peoples->getPeoples($config['per_page'], $data['start'], $data['keyword']);
    $this->load->view('tamplates/header', $data);
    $this->load->view('peoples/index', $data);
    $this->load->view('tamplates/footer');
  }
}
