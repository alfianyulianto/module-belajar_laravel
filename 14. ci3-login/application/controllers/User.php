<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();    // menggil method costruct di parent class
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk topbar
    $this->load->view('tamplates/header', $data);
    $this->load->view('tamplates/sidebar', $data);
    $this->load->view('tamplates/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('tamplates/footer');
  }

  public function edit()
  {
    $data['title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk topbar

    // role
    // trim : untuk menghilangkan karakter spasi di akhir inputan
    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

    // validation
    if ($this->form_validation->run() == false) {
      $this->load->view('tamplates/header', $data);
      $this->load->view('tamplates/sidebar', $data);
      $this->load->view('tamplates/topbar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('tamplates/footer');
    } else {
      $name = $this->input->post('name');
      $email = $this->input->post('email');

      // cek apakah ada image yang diupload
      $upload_image = $_FILES['image'];
      // var_dump($old_image);
      // die;
      if ($upload_image['name']) {
        // configurasi
        $config['upload_path'] = './assets/img/profile';    // tempat penyimpanannya
        $config['allowed_types'] = 'gif|jpg|png';   // extensi file
        $config['max_size']     = '2048';   // 2MB

        // load upload image
        $this->load->library('upload', $config);

        // jika configurasi sudah lolos semua maka siap untuk diupload
        if ($this->upload->do_upload('image')) {
          // hapus file gambar profile sebelumnya
          $old_image = $data['user']['image'];
          if ($old_image != 'default.jpg') {
            // unlink : untuk menghapus file di dalam sebuah folder
            // FCPATH : untuk mengetahui path ke file name/front controlle
            $path = './assets/img/profile/' . $old_image;
            unlink($path);
          }

          $new_image =  $this->upload->data('file_name');   // mengambil nama file yang diupload
          $this->db->set('image', $new_image);
        } else {
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>'
          );
          redirect("user");
        }
      }

      $this->db->set('name', $name);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Your profile has been updated!
      </div>');
      redirect("user");
    }
  }

  public function changePassword()
  {
    $data['title'] = 'Change Password';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk topbar

    // role
    $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Repeat New Password', 'required|trim|min_length[3]|matches[new_password1]');

    // validation
    if ($this->form_validation->run() == false) {
      $this->load->view('tamplates/header', $data);
      $this->load->view('tamplates/sidebar', $data);
      $this->load->view('tamplates/topbar', $data);
      $this->load->view('user/changepassword', $data);
      $this->load->view('tamplates/footer');
    } else {
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');

      // cek apakah current password sama tidak password yg ada di DB
      // var_dump($current_password);
      // var_dump($data['user']['password']);
      // var_dump(password_verify($current_password, $data['user']['password']));
      if (!password_verify($current_password, $data['user']['password'])) {
        $this->session->set_flashdata(
          'message',
          '<div class="alert alert-danger" role="alert">Wrong current password!</div>'
        );
        redirect("user/changePassword");
      } else {
        // cek jika password saat ini sama dengan password baru
        if ($current_password == $new_password) {
          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>'
          );
          redirect("user/changePassword");
        } else {
          // jika password ok
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

          $this->db->set('password', $password_hash);
          $this->db->where('email', $this->session->userdata('email'));
          $this->db->update('user');

          $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Password change!</div>'
          );
          redirect("user/changePassword");
        }
      }
    }
  }
}
