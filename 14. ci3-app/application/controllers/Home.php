<?php

class Home extends CI_Controller
{
  // method default
  // parameter $nama  ini akan mengambil data yg ada di url
  // saat kita menuliskan http::/localhost:8080/Ci3-app/controller/index/data maka data ini akan masuk sebagai parameter di method
  public function index($nama = 'Selamat Datang')
  {
    $this->session->unset_userdata('keyword');    // untuk unset session 
    // memanggil view
    // load : digunakan untuk melakuakan load model, view, helper, dll
    // $this->load->view('index');   // meload halaman index.php yg ada didalam folder views
    $data['judul'] = 'Halaman Home';    // untuk mengirimkan data
    $data['nama'] = $nama;
    $this->load->view('tamplates/header', $data);    // meload file tamplates/header.php yg ada didalam folder views dan juga mengirimkan sebuah data
    $this->load->view('home/index', $data);    // meload file home/index.php yg ada didalam folder views dan juga mengirimkan sebuah data
    $this->load->view('tamplates/footer');    // meload file tamplates/footer.php yg ada didalam foldr views
  }
}
