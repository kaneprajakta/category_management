<?php
// No direct script execution
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Dropdown_model to handle all related information from MySQL
 */
class Dropdown_model extends CI_Model
{
    /**
     * MySQL table which contains all data about users
     * @var string
     */
    protected $table = 'categories';
    /*public function get_category_level(){
        
        $sql_func_call   = "select max( figure_up_depth(cat_id) ) as max_depth from categories;";
        $query_func_call = $this->db->query($sql_func_call);
        $res_arr         = $query_func_call->result_array();
        $depth           = $res_arr[0]['max_depth'];
        return $depth; 
    }*/
    /**
     * Returns, User First Name by Email ID
     * @param  [type] $email_addres   [description]
     * @return [type] [description]
     */
    public function get_dropdown_data($level)
    {
        if($level == 'level1'){
            $sql             = "select cat_id,cat_name,level from categories where parent_id is null";
            $query           = $this->db->query($sql);
            
            // if record exist
            if ($query->num_rows() > 0) {
                // return all data as array
                return $query->result_array();
            } else {
                // error
                return false;
            }
        }
    }

    public function get_sub_cat_data($parent_cat_id){
        $sql             = "select cat_id,cat_name,level from categories where parent_id = '$parent_cat_id' order by sort_order asc";
        $query           = $this->db->query($sql);
        
        // if record exist
        if ($query->num_rows() > 0) {
            // return all data as array
            return $query->result_array();
        } else {
            // error
            return false;
        }
    }
}
?>