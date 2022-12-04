<?php

namespace App\Controllers;

class Pages extends BaseController
{
  public function index()
  {
    $data = [   // untuk mengirimkan data
      'title' => 'Home | AY-Blog',
    ];
    // echo view('layout/header', $data);   // menampilkan header 
    // echo view('pages/home');  // menampilkan halaman home yang ada di folder pages
    // echo view('layout/footer');   // menampilkan footer

    // menggunakan view layout
    return view('pages/home', $data);   // menampilkan halaman home yang ada di folder pages
  }

  public function about()
  {
    $data = [   // untuk mengirimkan data
      'title' => 'About Me | AY-Blog',
    ];
    // echo view('layout/header', $data);   // menampilkan header
    // echo view('pages/about');   // menampilkan halaman about yang ada di folder pages
    // echo view('layout/footer');   // menampilkan footer

    // menggunakan view layout
    return view('pages/about', $data);    // menampilkan halaman about yang ada di folder pages
  }

  public function contact()
  {
    $data = [
      'title' => 'Contact Us',
      'alamat' => [
        [
          'tipe' => 'Rumah',
          'alamat' => 'Jl. Rajawali No. 19',
          'kota' => 'Surakarta'
        ],
        [
          'tipe' => 'Kantor',
          'alamat' => 'Jl. abc No. 270',
          'kota' => 'Jakarta Selatan'
        ]
      ]
    ];

    return view('pages/contact', $data);    // menampilkan halaman contact yang ada di folder pages
  }
}
