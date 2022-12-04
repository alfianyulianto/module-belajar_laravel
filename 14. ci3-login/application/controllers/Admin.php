<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();    // menggil method costruct di parent class
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk topbar
    $this->load->view('tamplates/header', $data);
    $this->load->view('tamplates/sidebar', $data);
    $this->load->view('tamplates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('tamplates/footer');
  }

  public function role()
  {
    $data['title'] = 'Role';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk topbar

    $data['role'] = $this->db->get('user_role')->result_array();

    // role
    $this->form_validation->set_rules('role', 'Role', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('tamplates/header', $data);
      $this->load->view('tamplates/sidebar', $data);
      $this->load->view('tamplates/topbar', $data);
      $this->load->view('admin/role', $data);
      $this->load->view('tamplates/footer');
    } else {
      $data = [
        'role' => $this->input->post('role')
      ];

      $this->db->insert('user_role', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      New role  added!
      </div>');
      redirect("admin/role");
    }
  }

  public function getRoleById($id)
  {
    // echo $id;
    // die;
    echo json_encode($this->db->get_where('user_role', ['id' => $id])->result_array());
  }

  public function editRole($id)
  {
    $data = [
      'role' => $this->input->post('role'),
    ];
    $this->db->where('id', $id);
    $this->db->update('user_role', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Menu has been edited!
    </div>');
    redirect('admin/role');
  }

  public function deleteRole($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_role');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Menu has been deleted!
         </div>');
    redirect('admin/role');
  }

  public function roleAccess($role_id)
  {
    $data['title'] = 'Role Access';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk topbar

    $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    $this->db->where('menu !=', 'Admin');   // untuk memberi kondisi bahwa mencari menu yang bukan Admin
    $data['menu'] = $this->db->get('user_menu')->result_array();

    // role
    $this->form_validation->set_rules('role', 'Role', 'required');
    if ($this->form_validation->run() == false) {
      $this->load->view('tamplates/header', $data);
      $this->load->view('tamplates/sidebar', $data);
      $this->load->view('tamplates/topbar', $data);
      $this->load->view('admin/role-access', $data);
      $this->load->view('tamplates/footer');
    } else {
      $data = [
        'role' => $this->input->post('role')
      ];

      $this->db->insert('user_role', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      New role  added!
      </div>');
      redirect("admin/role");
    }
  }

  public function chengeAccess()
  {
    // ambil data post yg dikirim lewat ajax
    $data = [
      'role_id' => $this->input->post('role_id'),
      'menu_id' => $this->input->post('menu_id')
    ];

    $result = $this->db->get_where('user_access_menu', $data);

    if ($result->num_rows() == 0) {
      $this->db->insert('user_access_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Access has been added!
       </div>');
    } else {
      $this->db->delete('user_access_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Access has not been added!
      </div>');
    }
  }
}
