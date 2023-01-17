<?php
class Dashboard extends Controller
{

    public function __construct()
    {
        
    }

    public function Dashboard(){
        $data = [
            
        ];  
        $this->view('Dashboard/Dashboard',$data);
    }
}