<?php

// config
$config['base_url'] = 'http://localhost:8080/ci3-app/peoples/index';
$config['num_links'] = 3;   // untuk memberikan jumlah link pada pagination

// pagination for markup
$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination  justify-content-end">';
$config['full_tag_close'] = '</ul></nav>';

$config['first_link'] = '&laquo';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = '&raquo';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Previous';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
$config['cur_tag_close'] = '</a></li>';

$config['attributes'] = array('class' => 'page-link');
