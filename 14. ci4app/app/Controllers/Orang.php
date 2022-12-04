<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
  protected $orangModel;
  public function __construct()
  {
    // instansiasi model orang
    $this->orangModel = new OrangModel();
  }

  public function index()
  {
    $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
    $keyword = $this->request->getVar('keyword');
    // d($keyword);
    if ($keyword) {
      $orang = $this->orangModel->search($keyword);
    } else {
      $orang = $this->orangModel;
    }
    $data = [
      'title' => 'Daftar Orang',
      // 'orang' => $this->orangModel->findAll(),  // menggunakan data tabel
      'orang' => $orang->paginate(10, 'orang'),    // untuk membuat pagination
      'pager' => $this->orangModel->pager,   // untuk membuat pagination
      'currentPage' => $currentPage
    ];

    return view('orang/index', $data);
  }
}
