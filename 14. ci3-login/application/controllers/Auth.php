<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();    // memanggil method cosntruct di parent CI_Controller

    // load form validation
    $this->load->library('form_validation');
  }
  public function index()
  {
    // cek jika sudah login maka tidak boleh kehalaman login
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    // rule form validation
    // trim : digunakan untuk mengecek karakter spasi
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    // validation form input
    if ($this->form_validation->run() == false) {
      $data['title'] = 'User Login';
      $this->load->view('tamplates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('tamplates/auth_footer');
    } else {
      // validasinya success
      $this->_login();
    }
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    // var_dump($user);
    // die;

    // jika usernya ada
    if ($user) {
      // jika usernya aktif
      if ($user['is_active'] == 1) {
        // cek password
        if (password_verify($password, $user['password'])) {
          // buat session agar nantinya bisa digunakan di setiap halaman
          $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
          ];
          $this->session->set_userdata('email', $data['email']);    // untuk topbar
          $this->session->set_userdata('role_id', $data['role_id']);    // untuk sidebar
          if ($user['role_id'] == 1) {
            redirect('admin');
          } else {
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Wrong password!
         </div>');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        This email has not been activated!
       </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
     Email is not registered!
    </div>');
      redirect('auth');
    }
  }

  public function registration()
  {
    // cek jika sudah login maka tidak boleh kehalaman registration
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    // rules form validation
    // trim : digunakan untuk mengecek karakter spasi
    // is_unique : digunakan untuk mengecek apakah field yg di inputkan sudah ada belu di dalam DB
    // is_unique[tabel_name.field_name]
    // min_length : digunakan untuk memberikan minimal panjang karakter pada sebuah input
    // min_length[8]
    // matches : digunakan untuk mengecek apakah 2 input sama atau tidak
    // matches[field_name]
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'The Email has been registered!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

    // validation form input
    if ($this->form_validation->run() == false) {
      $data['title'] = 'User Registration';
      $this->load->view('tamplates/auth_header', $data);
      $this->load->view('auth/registration');
      $this->load->view('tamplates/auth_footer');
    } else {
      // echo 'data basehasil ditambahkan!';
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 0,
        'date_created' => time()
      ];
      // insert data
      // $this->db->insert('user', $data);

      $this->_sendEmail();

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! Your account has been created. Please login!
      </div>');
      redirect('auth');
    }
  }

  private function _sendEmail()
  {
    $config = [
      'protocol' => "smtp",   // simple main transfer protocol
      'smtp_host' => "ssl://smtp.googlemail.com",
      'smtp_user' => "alfianyulianto.blog@gmail.com",
      'smtp_pass' => "Iyan2000",
      'smtp_port' => 465,
      'mailtype' => "html",
      'charset' => "utf-8",
      'newline' => "\r\n"
    ];
    $this->load->library("email", $config);
    $this->email->initialize($config);
    // $this->email->set_mailtype("html");
    // $this->email->set_newline("\r\n");

    $this->email->from("alfianyulianto.blog@gmail.com", "AY Blog");   // email dari siapa
    $this->email->to("alfianyulianto36@gmail.com");   // email dikirim ke mana
    $this->email->subject("Email Test");    // subject emailnya
    $this->email->message("Hello World");    // pesan emailnya

    // $this->email->send();
    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debugger();    // untuk menampilkan error
      die;
    }
  }

  public function logout()
  {
    // hilangkan session
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
   You have been logout!
   </div>');
    redirect('auth');
  }

  public function blocked()
  {
    $data['title'] = "Not Found";
    $this->load->view('tamplates/auth_header', $data);
    $this->load->view('auth/blocked');
    $this->load->view('tamplates/auth_footer');
  }
}
