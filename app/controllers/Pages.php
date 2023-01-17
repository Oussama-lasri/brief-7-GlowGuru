<?php
class Pages extends Controller{
    public function __construct()
    {
        // $this->postModel = $this->model('Post');
    }
    public function index() {
        // if(isLoggedIn()){
        //     header('location:' . URLROOT . '/Dashboard/gestionCategories');
        // }
        $data = [
        'title' => 'index',
        'descreption' => 'For navbars that never collapse, add the .navbar-expand class on the navbar. For navbars that always collapse, don’t add any .navbar-expand class.'
    ];
        $this->view('pages/index',$data);
        
    }


    public function aboutus() {
        $data = [
            
        ];  
        $this->view('pages/about',$data);
        
    }
    public function contactUs() {
        $data = [
            
        ];  
        $this->view('pages/contactUs',$data);
        
    }
    public function categories() {
        $data = [
            
        ];  
        $this->view('pages/categories',$data);
        
    }



    public function add() {
        $data = [
            'title' => 'about',
            'descreption' => 'For navbars that never collapse, add the .navbar-expand class on the navbar. For navbars that always collapse, don’t add any .navbar-expand class.'
        ];  
        $this->view('posts/add',$data);
        
    }
}