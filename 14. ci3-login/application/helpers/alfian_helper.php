<?php

function is_logged_in()
{
  $ci = get_instance(); // untuk memanggil library ci 
  if (!$ci->session->userdata('email')) {   // ambil session email
    redirect('auth');
  } else {
    $role_id = $ci->session->userdata('role_id');   // ambil session role_id
    $menu = $ci->uri->segment(1);   // ambil url segment ke 1

    // query ke tabel user_menu berdasakan menu yang ada
    $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    $menu_id = $queryMenu['id'];
    $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    // num_rows() : mengambil satu baris
    // jika 0 maka tidak ada bari, jika 1 maka ada baris yang dikembalikan
    if ($userAccess->num_rows() < 1) {    // jika tidak ada baris yang ketemu
      redirect('auth/blocked');   // arahkan ke auth/block
    }
  }
}

// fungsi untuk menu access
function check_access($role_id, $menu_id)
{
  $ci = get_instance();
  $ci->db->where('role_id', $role_id);
  $ci->db->where('menu_id', $menu_id);
  $result = $ci->db->get('user_access_menu');

  if ($result->num_rows() > 0) {
    return "checked='checked'";
  }
}
