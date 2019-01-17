<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {
  
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
    $this->load->model("Stations_model");
    $playing = $this->Stations_model->now_playing();
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


    $this->load->view('main_links',$data);
    return;
  }
  
  public function play() {
    $rawlink = $this->input->post("link");
    $link = urlencode($this->input->post("link"));
    error_reporting(0);
    file_get_contents("http://localhost:8888/play?station=$link&type=l");
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $this->load->helper('url');
    
    $data["nowplaying"] = -1;
    $data["message"] = "";
    $data["name"] = "";
    $data["url"] = "";
    $data["title"] = "Radio Free Blossom";
    
    $data["message"] = "Loading";
    $data["nowplaying"] = $rawlink;
    $data["name"] = $rawlink;
    $data["url"] = $link;
    
    
    $this->load->view('main_links',$data);
    return;
  }
  

}

