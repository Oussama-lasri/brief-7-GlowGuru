<?php
class Dashboard extends Controller
{

    public function __construct()
    {
        
    }

    public function gestionCategories(){
        $data = [
            
        ];  
        $this->view('Dashboard/gestionCategories',$data);
    }
    public function gestionProduct(){
        $data = [
            
        ];  
        $this->view('Dashboard/gestionProduct',$data);
    }
}