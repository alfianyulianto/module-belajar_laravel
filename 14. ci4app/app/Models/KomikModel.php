<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
  protected $table = 'komik';   // nama tabel di database
  protected $primaryKey = 'id';   // nama field primary key, jika bukan id maka ganti sesuai nama field dari primary

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';    // tipe hasil yang dikembalikan bisa array atau object
  protected $useSoftDeletes = false;    // apakah kita mau menggunakan softDeletes default false, softDeletes data masih ada ketika di delete tetapi kita harus memeiliki sebuah field deleted_at

  protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];    // untuk menentukan field dalam database yang boleh di isi manual ketika melakukan inserting data

  protected $useTimestamps = true;    // default false ketika kita tidak butuh fitur atau field created_at dan updated_at
  protected $createdField  = 'created_at';  // 
  protected $updatedField  = 'updated_at';


  // untuk menampilkan data komik
  public function getKomik($slug = false)   // default false
  {
    // cek apakah method ini di panggil dengan slug atau tidak
    if ($slug == false) {
      return $this->findAll();
    }

    return $this->where(['slug' => $slug])->first();
  }
}
