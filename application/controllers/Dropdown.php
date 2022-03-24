<?php
(defined('BASEPATH') or exit('No direct script access allowed'));
class Dropdown extends CI_controller
{
    /**
     * Class Constructor
     */
    public function __construct()
    {
        // execute parent class constructor
        parent::__construct();
        // load model
        $this->load->model('Dropdown_model');
        $this->load->library('session');
    }
    public function index(){
      //$depth = $this->Dropdown_model->get_category_level();
      
      $array_data = array();
      // only on Ajax Request
      if ($this->input->is_ajax_request()) {
        
        if ($this->input->post('action') && $this->input->post('action') == 'subcat') {
          $cat_id           = $this->input->post('cat_id', true);
          $array_data       = $this->Dropdown_model->get_sub_cat_data($cat_id);
          $this->output->set_content_type('application/json');
          if(!empty($array_data)){
            
            $this->output->set_output(json_encode(array("dd" => $array_data, "level" =>  $array_data[0]['level'])));
          }else if($cat_id == 0){

            $this->output->set_output(json_encode(array("dd" => "0",'level' => $this->input->post("lvl"))));
          }else{
            $this->output->set_output(json_encode(array("dd" => "no_subcat",'level' => $this->input->post("lvl"))));
          }
        } 
      }else{
        $array_data = $this->Dropdown_model->get_dropdown_data('level1');
        // send to view
        $this->load->view('dropdown', ['data' => $array_data,"level"=>$array_data[0]['level']]);
    }
  }
}
?>