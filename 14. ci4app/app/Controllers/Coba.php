<?php

namespace App\Controllers;

class Coba extends BaseController
{
  public function index()
  {
    echo "Ini controller coba method coba";
  }

  // saat kita menuliskan http://localhost:8080/controller/method/data , maka data ini akan masuk sebagai parameter di method about
  public function about($nama = 'alfian', $umur = 21)
  {
    // echo "Halo nama saya $this->nama";  // mengambil parameter nama dari BaseController.php 

    echo "Helo nama saya $nama dan saya berumur $umur tahun.";
  }
}
