<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();    // menggil method costruct di parent class
    is_logged_in();
  }
  public function index()
  {
    $data['title'] = 'Menu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk top bar
    // $data['menu'] = $this->db->get('user_menu')->result_array();   // untuk menu/index

    // rules
    $this->form_validation->set_rules('menu', 'Menu', 'required');
    // cek validasi
    if ($this->form_validation->run() == false) {
      $this->load->view('tamplates/header', $data);
      $this->load->view('tamplates/sidebar', $data);
      $this->load->view('tamplates/topbar', $data);
      $this->load->view('menu/index', $data);
      $this->load->view('tamplates/footer');
    } else {
      $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
      // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      //     New menu added!
      //    </div>');
      // redirect('menu');
    }
  }

  public function getDataMenu()
  {
    $data['menu'] = $this->db->get('user_menu')->result_array();
    echo json_encode($data['menu']);
  }

  public function deleteMenu($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_menu');
    // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //       Menu has been deleted!
    //      </div>');
    // redirect('menu');
  }

  public function getMenuById($id)
  {
    // echo $id;
    // die;
    echo json_encode($this->db->get_where('user_menu', ['id' => $id])->result_array());
  }

  public function editMenu()
  {
    $data = [
      'menu' => $this->input->post('menu')
    ];
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('user_menu', $data);
    // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    // Menu has been edited!
    // </div>');
  }


  public function submenu()
  {
    $data['title'] = 'Submenu Management';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();  // untuk top bar
    $data['menu'] = $this->db->get('user_menu')->result_array();   // untuk menu/index

    $this->load->model('Menu_model', 'menu');
    $data['submenu'] = $this->menu->getSubMenu();   // untuk menu/index

    // role
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('menu_id', 'Menu', 'required');
    $this->form_validation->set_rules('url', 'Url', 'required');
    $this->form_validation->set_rules('icon', 'Icon', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('tamplates/header', $data);
      $this->load->view('tamplates/sidebar', $data);
      $this->load->view('tamplates/topbar', $data);
      $this->load->view('menu/submenu', $data);
      $this->load->view('tamplates/footer');
    } else {
      $data = [
        'title' => $this->input->post('title'),
        'menu_id' => $this->input->post('menu_id'),
        'url' => $this->input->post('url'),
        'icon' => $this->input->post('icon'),
        'is_active' => $this->input->post('is_active')
      ];

      $this->db->insert('user_sub_menu', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      New submenu  added!
      </div>');
      redirect("menu/submenu");
    }
  }

  public function getSubmenuById($id)
  {
    // echo $id;
    // die;
    echo json_encode($this->db->get_where('user_sub_menu', ['id' => $id])->result_array());
  }

  public function editSubmenu()
  {
    $data = [
      'title' => $this->input->post('title'),
      'menu_id' => $this->input->post('menu_id'),
      'url' => $this->input->post('url'),
      'icon' => $this->input->post('icon'),
      'is_active' => $this->input->post('is_active')
    ];
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('user_sub_menu', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Menu has been edited!
    </div>');
    redirect('menu/submenu');
  }

  public function deleteSubmenu($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user_sub_menu');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Menu has been deleted!
         </div>');
    redirect('menu/submenu');
  }
}
