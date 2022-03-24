<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {
    public function get_categories(){

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('parent_id', NULL);

        $parent = $this->db->get();

        $categories = $parent->result();
        //print_r( $categories);
        
        foreach($categories as $p_cat){

            //$categories[$i]->sub = $this->sub_categories($p_cat->cat_id);
            $categories_new[$p_cat->cat_id] = $p_cat->cat_name;
            
        }
        //print_r($categories_new);
        return $categories_new;
    }
    
    public function sub_categories($id){

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('parent_id', $id);

        $child = $this->db->get();
        $categories = $child->result();
        $i=0;
        foreach($categories as $p_cat){

            $categories[$i]->sub = $this->sub_categories($p_cat->cat_id);
            $i++;
        }
        return $categories;       
    }

    public function create($id = 0)
	{
		$this->load->helper('url');
        //echo "in model";
		

		$data = array(
			'cat_name' => $this->input->post('cat_name'),
			'parent_id' =>$this->input->post('sel_p_id'),
			
		);
		
		if ($id == 0) {
			return $this->db->insert('categories', $data);
		} else {
			$this->db->where('id', $id);
			return $this->db->update('categories', $data);
		}
	}
}
