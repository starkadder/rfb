<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stations extends CI_Controller {
  
  public function index()
  {
  }


  public function add()
  {
    $name = trim($this->input->post("name"));
    $url = trim($this->input->post("url"));
    $options = trim($this->input->post("options"));
    $return = $this->input->post("return");
    
    
    $data["error"] = "";    
    $data["action"] = "add";
    $data["name"] = $name;
    $data["url"] = $url;
    $data["options"] = $options;
    
    
    if (! $return ) {
      $this->load->view('edit_station',$data);
      return;
    }
    if (! $name ) {
      $data["error"] = "Station name cannot be blank";    
      $this->load->view('edit_station',$data);
      return;
    }
    if (! $url) {
      $data["error"] = "Station URL cannot be blank";    
      $this->load->view('edit_station',$data);
      return;
    }

    $insert['name'] = $name;
    $insert['url'] =  $url;
    $insert['options'] =  $options;

    $this->load->model("Stations_model");
    if ( ! $this->Stations_model->add_station( $insert ) ) {
      $data['error'] = "Station '$name' already exist!";
      $this->load->view("edit_station",$data);
      return;
    }
    $this->load->helper("url");
    redirect("",$data);
    return;
  }


  public function edit() {
    $this->load->model("Stations_model");

    $station = $this->input->post("station");
    if (! $station) {
      $data["stations"] = $this->Stations_model->get();
      $this->load->view("edit_list",$data);
      return;
    }


    $name = trim($this->input->post("name"));
    $url = trim($this->input->post("url"));
    $options = trim($this->input->post("options"));
    $return = $this->input->post("return");

    $data["action"] = "edit";
    $data["error"] = "";
    $data["station"] = $station;
    $data["name"] = "";
    $data["options"] = "";
    $data["url"] = "";

    $edit = $this->Stations_model->info($station);
    foreach ( $edit->result() as $e ) {
      $data["error"] = "";
      $data["station"] = $e->id;
      $data["name"] = $e->name;
      $data["url"] = $e->url;
      $data["options"] = $e->options;
    }
    if ( ! $return ) {
      $this->load->view("edit_station",$data);
      return;
    }

    if ( $name ) {
      $data["name"] = $name;
    }
    if ( $url ) {
      $data["url"] = $url;
    }

    if (! $name ) {
      $data["error"] = "Station name cannot be blank";    
      $this->load->view('edit_station',$data);
      return;
    }
    if (! $url) {
      $data["error"] = "Station URL cannot be blank";    
      $this->load->view('edit_station',$data);
      return;
    }

    $update['name'] = $name;
    $update['url'] =  $url;
    $update['options'] =  $options;

    $this->Stations_model->update( $update, $station );
    $data["stations"] = $this->Stations_model->get();
    $this->load->view("edit_list",$data);
    return;
  }


  public function delete() {
    $this->load->model("Stations_model");

    $station = $this->input->post("station");
    if (! $station) {
      $data["stations"] = $this->Stations_model->get();
      $this->load->view("delete_list",$data);
      return;
    }

    $edit = $this->Stations_model->delete($station);

    $this->load->helper("url");
    redirect("",$data);
    return;
  }


}

