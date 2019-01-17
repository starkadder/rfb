<?php

class Stations_model extends CI_Model 
{

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
  }
  
  
  function get() {
    $sql = "select * from stations order by name";
    $query = $this->db->query($sql);
    return $query;
  } 

  function info($id) {
    $sql = "select * from stations where id = $id";
    $query = $this->db->query($sql);
    return $query;
  } 

  function now_playing() {
    $sql = "select * from playing;";
    $query = $this->db->query($sql);
    return $query;
  } 


  function stop_playing() {
    $sql = "delete fom playing where station_id >= 0;";
    $query = $this->db->query($sql);
  } 

  
  function update($data,$id) {
    $this->db->query($this->db->update_string('stations', $data, "id = $id"));
    return ;	      
  }
  
  function delete($id) {
    $this->db->query("delete from stations where id = $id");
    return;
  }
  
  function insert($data) {
    $this->db->query($this->db->insert_string("stations", $data));
    return;
  }
  
  function add_station($data) {
    $exists = $this->db->query("select * from stations where name = " . $this->db->escape($data['name']) );
    if ($exists->num_rows() > 0) {
      return FALSE;
    }
    $this->db->query($this->db->insert_string('stations', $data));
    return TRUE;
  }
  
}

?>
