<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
public function categories(){

    $this->load->model('CategoryModel');
    $data = $this->CategoryModel->get_categories();

    //print_r($data);
}

public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
        $this->load->model('CategoryModel');
        $data['p_cat'] = $this->CategoryModel->get_categories();
        //print_r($data);
		$data['title'] = 'Create a new category';
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
        if ($this->form_validation->run() === FALSE)
		{
			echo "inside if";
			//$this->load->view('templates/header', $data);
			$this->load->view('create',$data);
			//$this->load->view('templates/footer');

		}
		else
		{
			echo "inside else";
			$this->CategoryModel->create(0);
			//$this->load->view('templates/header', $data);
			$this->load->view('success');
			//$this->load->view('templates/footer');
		}
	}
}
?>