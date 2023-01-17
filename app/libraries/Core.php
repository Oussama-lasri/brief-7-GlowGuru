<?php
class Core {
     protected $currentController = 'pages';
     protected $CurrentMethod = 'index';
     protected $params = [];
     public function __construct(){
        // print_r($this->getURL());
        $url = $this->getURL();

        if(isset($url)){
        // look in controllers for first value
        if(file_exists('../app/Controllers/'.ucwords($url[0]).'.php')){
            // if exist , set controller 
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }}
        require_once '../app/Controllers/' . $this->currentController . '.php';
            // instantiate controller class
        $this->currentController = new $this->currentController;
        
        // check for second part of url (indice 1)
        if(isset($url[1])){
            // check to see if method exists in controllers(folder)
            if(method_exists($this->currentController,$url[1])){
                $this->CurrentMethod = $url[1];
                unset($url[1]);
                
            }
        }
        // get params 
        $this->params = $url ? array_values($url) : [];
        // print_r($this->params);
        

        call_user_func_array([$this->currentController, $this->CurrentMethod], $this->params);
       
        
     }
    




     public function getURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
     }
     

}