<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {
  
  public function index()
  {
    $submit = $this->input->post("submit");
    
    if ($submit == "Play") {
      $this->play();
      return;
    }
    
    if ($submit == "Stop") {
      error_reporting(0);
      file_get_contents("http://localhost:8888/stop?station=0&type=s");
       error_reporting(E_ERROR | E_WARNING | E_PARSE);
    }
    
    $data["title"] = "radio free blossom";
    $this->load->model("Albums_model");
    $data["albums"] = $this->Albums_model->get();
    $playing = $this->Albums_model->now_playing();
    $data["nowplaying"] = -1;
    $data["message"] = "";
    $data["name"] = "";
    $data["url"] = "";
    foreach ( $playing->result() as $play ) {
      $data["nowplaying"] =  $play->station_id;
      $data["message"] = "Playing";
      $data["name"] = $play->name;
      $data["url"] = $play->url;
    }


    $this->load->view('main_albums',$data);
    return;
  }
  
  public function play() {
    $album = $this->input->post("album");
    error_reporting(0);
    file_get_contents("http://localhost:8888/play?station=$album&type=a");
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $this->load->helper('url');
    
    $data["nowplaying"] = -1;
    $data["message"] = "";
    $data["name"] = "";
    $data["url"] = "";
    $data["title"] = "Radio Free Blossom";
    
    $this->load->model("Albums_model");
    $playing = $this->Albums_model->info($album);
    $data["albums"] = $this->Albums_model->get();
    
    foreach ( $playing->result() as $play ) {
      $data["message"] = "Loading";
      $data["nowplaying"] = $play->id;
      $data["name"] = $play->name;
      $data["url"] = $play->url;
    }    
    
    
    $this->load->view('main_albums',$data);
    return;
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
      $this->load->view('edit_album',$data);
      return;
    }
    if (! $name ) {
      $data["error"] = "Album name cannot be blank";    
      $this->load->view('edit_album',$data);
      return;
    }
    if (! $url) {
      $data["error"] = "Album URL cannot be blank";    
      $this->load->view('edit_album',$data);
      return;
    }

    $insert['name'] = $name;
    $insert['url'] =  $url;
    $insert['options'] =  $options;

    $this->load->model("Albums_model");
    if ( ! $this->Albums_model->add_album( $insert ) ) {
      $data['error'] = "Album '$name' already exist!";
      $this->load->view("edit_album",$data);
      return;
    }
    $this->load->helper("url");
    redirect("albums",$data);
    return;
  }


  public function edit() {
    $this->load->model("Albums_model");

    $album = $this->input->post("album");
    if (! $album) {
      $data["albums"] = $this->Albums_model->get();
      $this->load->view("edit_album_list",$data);
      return;
    }


    $name = trim($this->input->post("name"));
    $url = trim($this->input->post("url"));
    $options = trim($this->input->post("options"));
    $return = $this->input->post("return");

    $data["action"] = "edit";
    $data["error"] = "";
    $data["album"] = $album;
    $data["name"] = "";
    $data["options"] = "";
    $data["url"] = "";

    $edit = $this->Albums_model->info($album);
    foreach ( $edit->result() as $e ) {
      $data["error"] = "";
      $data["album"] = $e->id;
      $data["name"] = $e->name;
      $data["url"] = $e->url;
      $data["options"] = $e->options;
    }
    if ( ! $return ) {
      $this->load->view("edit_album",$data);
      return;
    }

    if ( $name ) {
      $data["name"] = $name;
    }
    if ( $url ) {
      $data["url"] = $url;
    }

    if (! $name ) {
      $data["error"] = "Album name cannot be blank";    
      $this->load->view('edit_album',$data);
      return;
    }
    if (! $url) {
      $data["error"] = "Album URL cannot be blank";    
      $this->load->view('edit_album',$data);
      return;
    }

    $update['name'] = $name;
    $update['url'] =  $url;
    $update['options'] =  $options;

    $this->Albums_model->update( $update, $album );
    $data["albums"] = $this->Albums_model->get();
    $this->load->view("edit_album_list",$data);
    return;
  }


  public function delete() {
    $this->load->model("Albums_model");

    $album = $this->input->post("album");
    if (! $album) {
      $data["albums"] = $this->Albums_model->get();
      $this->load->view("delete_album_list",$data);
      return;
    }

    $edit = $this->Albums_model->delete($album);

    $this->load->helper("url");
    redirect("",$data);
    return;
  }


}

