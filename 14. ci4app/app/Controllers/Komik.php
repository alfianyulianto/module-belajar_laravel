<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
  protected $komikModel;  // membuat property agar nanti instansiasi dari model dapat digunakan di kelas ini dan kelas turunan

  public function __construct()
  {
    // JIka semua controller bisa menggunakan satu tabel di dalam database kita bisa lakukan konfigurasi di BaseController
    $this->komikModel = new KomikModel();
  }

  public function index()
  {

    // cara koneksi ke databae tanpa model
    // $db = \Config\Database::connect();
    // $komik = $db->query('SELECT * FROM komik');
    // // dd($komik);
    // foreach ($komik->getresultArray() as $row) {
    //   d($row);
    // }

    // cara koneksi ke database pakai model kita harus instansiasi
    // $komikModel = new \App\Models\KomikModel();
    // $komikModel = new KomikModel(); // ini memiliki kekurangan jika setiap method pada class ini membuthkan model artinya kita harus melakukan instansiasi di tiap-tiap method. Untuk mengatasi itu maka kita bisa instansiasi dalam method construct
    // findAll() : sperti select * from yaitu untuk mengambil semua data
    // $komik = $this->komikModel->findAll();
    // dd($komik);
    // $data = [
    //   'title' => 'Daftar Komik',
    //   'komik' => $komik
    // ];
    $data = [
      'title' => 'Daftar Komik',
      'komik' => $this->komikModel->getKomik()
    ];

    return view('komik/index', $data);   // untuk menampikan halaman index di dalam folder komik
  }

  public function detail($slug)
  {
    $data = [
      'title' => 'Detail Komik',
      'komik' => $this->komikModel->getKomik($slug)
    ];
    // dd($data['komik']);

    // jika komik tidak ada di tabel database
    if (empty($data['komik'])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan.');
    }

    return view('komik/detail', $data);
  }

  // untuk menampilkan form
  public function create()
  {
    session();    // digunakan agar validation bisa digunakan, jika tidak ada maka error tidak akan muncul session ini bisa disimpan di BaseController.php
    $data = [
      'title' => 'Form Tambah Data Komik',
      'validation' => \Config\Services::validation()    // meload library
    ];

    return  view('komik/create', $data);
  }

  // untuk melakukan insert data dan mengelola validasi 
  public function save()
  {
    // validation form
    // required : harus diisi
    // is_unique[ignoreTabel.ignoreField.ingonreValue] : untuk memberitahu bahwa field yang di input tidak boleh sama dengan field yang ada di database
    // {field} : untuk menampilkan nama field
    // {param} : untuk mengambil jumlah karakter pada max_length dan min_length
    // {value} : untuk mengambil value
    if (!$this->validate([
      'judul' => [
        'label' => 'Judul',
        'rules' => 'required|is_unique[komik.judul]|max_length[8]',
        'errors' => [
          'required' => '{field} komik harus di isi.',
          'is_unique' => '{field} sudah ada.',
          'max_length' => '{field} panjang maksimal {param} karakter'
        ]
      ],
      'penulis' => 'required',
      'penerbit' => 'required',
      'sampul' => [
        'label' => 'Sampul',
        'rules' => 'max_size[sampul,3072]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar.',
          'is_image' => 'Yang anda pilih bukan gambar.',
          'mime_in' => 'Yang anda pilih bukan gambar.'
        ]
      ]
    ])) {
      // dd(\Config\Services::validation()->getErrors());   // mengecek error
      // withInput() : digunakan untuk membuat session yang dapat digunakan untuk input
      return redirect()->to('/komik/create')->withInput();
    }
    // dd('berhasil');

    // ambil gambar
    // getFile('fieldName) : untuk mengambil file yang di upload
    $fileSampul = $this->request->getFile('sampul');
    // dd($fileSampul);
    // apakah ada file gambar yang di upload
    // dd($fileSampul->getError());
    // jika errornya 4 tidak ada file ang diupload
    // jika errornya 0 ada file yang diupload
    if ($fileSampul->getError() == 4) {
      $namaSampul = 'default.png';
    } else {
      // generate naam sampul random
      $namaSampul = $fileSampul->getRandomName();
      // $namaSampul = $fileSampul->getName();    // untuk mengambil nama file yang diupload
      // pindahka file ke folder img
      // $fileSampul->move('img');    // memindahkan file dengan defaul nama file asli
      $fileSampul->move('img', $namaSampul);
    }

    // url_title : digunakan untuk membuat slug
    // ada 3 parameter 
    // parameter 1 string nya mau apa
    // parameter 2 separator / pemisah nya apa
    // parameter 3 boolean lowercase, true jika lowercase false jika tidak
    $slug = url_title($this->request->getVar('judul'), '-', 'true');
    // dd($slug);

    $this->komikModel->save([
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $namaSampul
    ]);

    $session = \Config\Services::session();
    $session->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
    Data berhasil ditambahkan!
  </div>');
    //   session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">
    //   Data berhasil ditambahkan!
    // </div>');

    // redirect()->to() : untuk mengembalikan ke URL tertentu
    return redirect()->to('/komik');
  }

  public function delete($id)
  {
    // cari gambar berdasarkan id
    $komik = $this->komikModel->find($id);

    // cek jia file gambarnya default.png
    if ($komik['sampul'] != 'default.png') {
      // hapus gambar yang ada di folder public/img
      unlink('img/' . $komik['sampul']);
    }

    // hapus data di dalam database
    $this->komikModel->delete($id);

    // with() : digunakan untuk mengirimkan flashdata
    return redirect()->to('/komik')->with('pesan', '<div class="alert alert-success" role="alert">
    Data berhasil dihapus!
  </div>');
  }

  public function edit($slug)
  {
    session();    // digunakan agar validation bisa digunakan, jika tidak ada maka error tidak akan muncul session ini bisa disimpan di BaseController.php
    $data = [
      'title' => 'Form Ubah Data Komik',
      'validation' => \Config\Services::validation(),    // meload libaray
      'komik' => $this->komikModel->getKomik($slug)
    ];

    return  view('komik/edit', $data);
  }

  public function update($id)
  {
    // dd($this->request->getvar());
    $komikLama = $this->komikModel->getKomik($this->request->getvar('slug'));
    // dd($komikLama);
    if ($komikLama['judul'] == $this->request->getVar('judul')) {
      // dd('sama');
      $rule_id = 'required|max_length[8]';
    } else {
      // dd('beda');
      $rule_id = 'required|is_unique[komik.judul]|max_length[8]';
    }

    if (!$this->validate([
      'judul' => [
        'label' => 'Judul',
        'rules' => $rule_id,
        'errors' => [
          'required' => '{field} komik harus di isi.',
          'is_unique' => '{field} sudah ada.',
          'max_length' => '{field} panjang maksimal {param} karakter'
        ]
      ],
      'penulis' => 'required',
      'penerbit' => 'required',
      'sampul' => [
        'label' => 'Sampul',
        'rules' => 'max_size[sampul,3072]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar.',
          'is_image' => 'Yang anda pilih bukan gambar.',
          'mime_in' => 'Yang anda pilih bukan gambar.'
        ]
      ]
    ])) {
      // withInput() : digunakan untuk membuat session yang dapat digunakan untuk input
      return redirect()->to('/komik/create')->withInput();
    }

    // ambil gambar
    // getFile('fieldName') : untuk mengambil file yang di upload
    $fileSampul = $this->request->getFile('sampul');
    // dd($fileSampul);
    // cek apakah tetap gambar lama
    // dd($fileSampul->getError());
    // jika errornya 4 tidak ada file ang diupload
    // jika errornya 0 ada file yang diupload
    if ($fileSampul->getError() == 4) {
      $namaSampul = $this->request->getVar('sampulLama');
    } else {
      // generate naam sampul random
      $namaSampul = $fileSampul->getRandomName();
      // $namaSampul = $fileSampul->getName();    // untuk mengambil nama file yang diupload
      // pindahka file ke folder img
      // $fileSampul->move('img');    // memindahkan file dengan defaul nama file asli
      $fileSampul->move('img', $namaSampul);
      // hapus file yang lama
      unlink('img/' . $this->request->getVar('sampulLama'));
    }


    $slug = url_title($this->request->getVar('judul'), '-', 'true');
    $this->komikModel->save([
      'id' => $id,
      'judul' => $this->request->getVar('judul'),
      'slug' => $slug,
      'penulis' => $this->request->getVar('penulis'),
      'penerbit' => $this->request->getVar('penerbit'),
      'sampul' => $namaSampul
    ]);

    return redirect()->to('/komik')->with('pesan', '<div class="alert alert-success" role="alert">
    Data berhasil diubah!
  </div>');
  }
}
