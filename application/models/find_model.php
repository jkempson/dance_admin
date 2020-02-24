<?php

class Find_model extends CI_Model
{
    public function query($query)
    {
    	if (!empty($query)) {
		    $fields = $this->db->list_fields('view_pupil');
		    $sql = "SELECT * FROM view_pupil";
		    if ($query != "*") {
				$sql .= " WHERE ";  
				for($i = 0; $i < count($fields); $i++){ 
					$sql .= $fields[$i]." LIKE '%$query%' OR "; 
				} 
				$sql = substr($sql,0,-4);
			}
		    return $this->db->query($sql)->result();
	    }
    }
}
?>