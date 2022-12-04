<?php

class Mahasiswa_model extends CI_Model
{
  public function getAllMahasiswa()
  {
    // menggunakan query builder 
    // $query =  $this->db->get('mahasiswa');   // untuk menampilkan semua data pada tabel mahasiswa di database
    // menggunakan getting query result
    // $query->result_array() : mengembalikan array multidimensi
    // return $query->result_array();
    return $this->db->get('mahasiswa')->result_array();
  }
  public function getMahasiswaById($id)
  {
    // menggunakan query builder 
    // $query = $this->db->get_where('mahasiswa', array('id' => $id));   // menampilkan satu data mahasiswa berdasarkan id tertentu
    // $query->row_array() : mengembalikan sebuah array associative
    // return $query->row_array(); 
    return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
  }
  public function tambahDataMahasiswa()
  {
    // membuat insert data
    // $this->db->insert('myTable', $data);
    // $this->input->post('some_data', XSS) : untuk mengambil data form yang di kirim lewat $_POST
    // parameter XSS(cross side scripting) : untuk menangani sql injection nilainya ada 'TRUE' dan 'FALES'
    $data = [
      'nama' => $this->input->post('nama', TRUE),
      'nim' => $this->input->post('nim', TRUE),
      'email' => $this->input->post('email', TRUE),
      'jurusan' => $this->input->post('jurusan', TRUE)
    ];

    $this->db->insert('mahasiswa', $data);    // melakuakn insert data ke tabel mahasiswa
  }
  public function hapusDataMahasiswa($id)
  {
    // membuat deleting data
    // $this->db->where('id', $id) : untuk menentukan data mana yang mau hapus(clausa)
    // $this->db->delete('myTabele') : untuk melakukan deleting data ke tabel mahasiswa
    $this->db->where('id', $id);
    // $this->db->delete('mahasiswa');   // melakukan deletinf data ke tabel mahasiswa
    $this->db->delete('mahasiswa', ['id' => $id]);
  }
  public function ubahDataMahasiswa($id)
  {
    // membuat updating data
    // $this->db->insert('myTable', $data);
    // $this->input->post('some_data', XSS) : untuk mengambil data form yang di kirim lewat $_POST
    // parameter XSS(cross side scripting) : untuk menangani sql injection nilainya ada 'TRUE' dan 'FALES'
    $data = [
      'nama' => $this->input->post('nama', TRUE),
      'nim' => $this->input->post('nim', TRUE),
      'email' => $this->input->post('email', TRUE),
      'jurusan' => $this->input->post('jurusan', TRUE)
    ];
    // $this->db->where('id', $id) : untuk menentukan data mana yang mau diubah(clausa)
    // $this->db->where('id', $thi->input->post('id')) : untuk menentukan data mana yang mau diubah(clausa)
    // $this->db->update('myTabele') : untuk melakukan ubah data ke tabel mahasiswa
    $this->db->where('id', $id);
    $this->db->update('mahasiswa', $data);    // melakuakn insert data ke tabel mahasiswa
  }
  public function cariDataMahasiswa()
  {
    $keyword = $this->input->post('keyword', TRUE);
    // $this->db->like('title', 'match') : untuk mencari data berdasarkan pola tertentu(clausa)
    // $this->db->or_like('title', 'match') : untuk mencari data berdasarkan pola tertentu(clausa)
    $this->db->like('nama', $keyword);
    $this->db->or_like('nim', $keyword);
    $this->db->or_like('email', $keyword);
    $this->db->or_like('jurusan', $keyword);
    return $this->db->get('mahasiswa')->result_array();
  }
}
