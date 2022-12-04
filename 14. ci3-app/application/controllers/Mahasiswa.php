<?php

class Mahasiswa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();    // untuk menjalankan method construct di class parent(CI_Controller)
    // $this->load->database();    // untuk mengkoneksikan semua method class Mahasiswa ke database. Tapi in memiliki kekurangan karena jika semua controller ingin terhubung ke dalam sebuah database maka kita harus menuliskan sintaks ini kedalam method cunstruct. Untuk mengatasinya kita lakukan konfigurasi pada file application/config/autoload.php bagian libraries diisi dengan array('database')
    $this->load->model('Mahasiswa_model');    // meload file Mahasiswa_model.php yg ada didalam folder models untuk semua method yg ada di class Mahasiswa
    $this->load->library('form_validation');    // untuk memelakukan validasi pada form
  }

  // method default
  public function index()
  {
    $this->session->unset_userdata('keyword');    // untuk unset session 
    // memanggil view
    // load : digunakan untuk melakuakan load model, view, helper, dll
    // $this->load->database();    // untuk mengkonseksikan method index ke database. Tapi ini memiliki kekurangan karena ini hanya digunakan untuk mengkoneksikan method index saja. Bagaimana jika kita memilikie method lain yg harus terkonseksi dengan database. Untuk mengatasinya kita tulis ke dalam method "__construct"
    // $this->load->model('Mahasiswa_model');    // meload file Mahasiswa_model.php yg ada didalam folder models untu method index ini saja buka untuk method yg lain di dalam class Mahasiswa
    $data['judul'] = 'Daftar Mahasiswa';    // untuk mengirimkan data
    $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();   // untuk mengambil data dari file models/Mahasiswa_model.php dengan method getAllMahasiswa()
    // sercing data mahasiswa
    if ($this->input->post('keyword')) {    // jika input keyword ada isinya
      $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();   // menjalankan sebuah model 'Mahasiswa_model' dan method 'cariDataMahasiswa'
    }
    $this->load->view('tamplates/header', $data);   // meload file tamplates/header.php yg ada didalam folder views dan juga mengirimkan sebuah data
    $this->load->view('mahasiswa/index', $data);   // meload file mahasiswa/index.php yg ada didalam folder views 
    $this->load->view('tamplates/footer');   // meload file tamplates/footer.php yg ada didalam folder views
  }
  // method default
  public function detail($id)
  {
    // memanggil view
    $data['judul'] = 'Detail Data Mahasiswa';    // untuk mengirimkan data
    $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);   // untuk mengambil data dari file models/Mahasiswa_model.php dengan method getMahasiswaById()
    $this->load->view('tamplates/header', $data);   // meload file tamplates/header.php yg ada didalam folder views dan juga mengirimkan sebuah data
    $this->load->view('mahasiswa/detail', $data);   // meload file mahasiswa/index.php yg ada didalam folder views 
    $this->load->view('tamplates/footer');   // meload file tamplates/footer.php yg ada didalam folder views
  }

  // method tambah data mahasiswa
  public function tambah()
  {
    $data['judul'] = 'Form Tambah Data Mahasiswa';
    // membuat rules
    // rule digunakan untuk mengecek apakah tiap element formnya sudah sesuai dengan rulesnya(misal tidak boleh kosong, harus angka, maksimal karakterna berapa, minimum karakternya berapa, dll)
    // require : tidak boleh kosong
    // matches : 2 element form harus sama
    // valid_email : email harus valid
    // set_rules('name_elemenForm', 'name_alias', 'rules')
    // validation_errors() : untuk menangkap semua pesan error
    // form_error('field_name', 'prefix', 'sufix') : untuk menampilkan error pada sebuah input
    // form_error('field_name', '<div class="error">','</div>')
    // set_value('field_name') : digunakan untuk mengisikan value pada input
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('nim', 'NIM', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    // membuat validation form
    if ($this->form_validation->run() == FALSE) {   // untuk mengecek apakah validasinya gagal
      $this->load->view('tamplates/header', $data);
      $this->load->view('mahasiswa/tambah');
      $this->load->view('tamplates/footer');
    } else {    // jika validasinya berhasil
      // var_dump($_POST);
      $this->Mahasiswa_model->tambahDataMahasiswa();    // menjalankan sebuah model 'Mahasiswa_model' dan method 'tambahDataMahasiswa'
      // Flashdata : untuk menampilkan sebuah alert yg mana jika data berhasil atau gagal ditambahkan
      // $this->session->set_flashdata('item', 'value') : untuk membuat session flash
      // $this->session->flash('item')
      $this->session->set_flashdata('flash', 'ditambahkan');
      redirect('mahasiswa');   // redirect('controller/method')
    }
  }

  // method hapus data mahasiswa berdasarkan id
  public function hapus($id)
  {
    $this->Mahasiswa_model->hapusDataMahasiswa($id);    // menjalankan sebuah model 'Mahasiswa_model' dan method 'hapusDataMahasiswa'
    // Flashdata : untuk menampilkan sebuah alert yg mana jika data berhasil atau gagal ditambahkan
    // $this->session->set_flashdata('item', 'value') : untuk membuat session flash
    // $this->session->flash('item')
    $this->session->set_flashdata('flash', 'dihapus');
    redirect('mahasiswa');   // redirect('controller/method')
  }

  // method ubah data mahasiswa berdasarkan id
  public function ubah($id)
  {
    $data['judul'] = 'Form Ubah Data Mahasiswa';
    $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);   // untuk mengambil data dari file models/Mahasiswa_model.php dengan method getMahasiswaById()
    $data['jurusan'] = ['Teknik Informatika', 'Akutansi', 'Menejemen'];
    // membuat rules
    // rule digunakan untuk mengecek apakah tiap element formnya sudah sesuai dengan rulesnya(misal tidak boleh kosong, harus angka, maksimal karakterna berapa, minimum karakternya berapa, dll)
    // require : tidak boleh kosong
    // matches : 2 element form harus sama
    // valid_email : email harus valid
    // set_rules('name_elemenForm', 'name_alias', 'rules')
    // validation_errors() : untuk menangkap semua pesan error
    // form_error('field_name', '<div class="error">','</div>')
    // set_value('field_name') : digunakan untuk mengisikan value pada input
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('nim', 'NIM', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    // membuat validation form
    if ($this->form_validation->run() == FALSE) {   // untuk mengecek apakah validasinya gagal
      $this->load->view('tamplates/header', $data);
      $this->load->view('mahasiswa/ubah', $data);
      $this->load->view('tamplates/footer');
    } else {    // jika validasinya berhasil
      // var_dump($_POST);
      $this->Mahasiswa_model->ubahDataMahasiswa($id);    // menjalankan sebuah model 'Mahasiswa_model' dan method 'tambahDataMahasiswa'
      // Flashdata : untuk menampilkan sebuah alert yg mana jika data berhasil atau gagal ditambahkan
      // $this->session->set_flashdata('item', 'value') : untuk membuat session flash
      // $this->session->flash('item')
      $this->session->set_flashdata('flash', 'diubah');
      redirect('mahasiswa');   // redirect('controller/method')
    }
  }
}
