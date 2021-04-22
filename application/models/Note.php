<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Manila');
class Note extends CI_Model {
    
    // no need since we are using prepared statement
    // function mysqli_real_escape_string($val){

    //     $escape_string = mysqli_real_escape_string($this->db->conn_id, $val);
    //     return $escape_string;
    // }





    function get_note_by_id($id){
        // $query = "SE";
        // $values = array($message_id); 
        // return $this->db->query($query,$values)->row_array();
        return $this->db->query("SELECT * FROM notes WHERE id = ?",$id)->row_array();
    }

    function get_all_notes(){
        return $this->db->query("SELECT * FROM notes ORDER BY id DESC")->result_array();
    }



    function add_note($note){
        $query = "INSERT INTO notes(title,description,created_at) VALUES (?,?,?)";
        $values = array($note["title"],$note["description"],date("Y-m-d, H:i:s"));
        return $this->db->query($query, $values);
    }

    function delete_note($id){
        $query = "DELETE FROM notes WHERE id = ?";
        $value = array($id);
        return $this->db->query($query,$value);
    }

    function edit_title($note){
        $query = "UPDATE notes SET title = ?, updated_at = ? WHERE id = ?";
        $values = array($note["title"],date("Y-m-d, H:i:s"),$note["note_id"],);
        return $this->db->query($query, $values);
    }

    function edit_description($note){
        $query = "UPDATE notes SET description = ?, updated_at = ? WHERE id = ?";
        $values = array($note["description"],date("Y-m-d, H:i:s"),$note["note_id"],);
        return $this->db->query($query, $values);
    }


}

?>