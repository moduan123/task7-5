<?php 



class App 
{
    // controller
    protected $controller = "HomeController";
    // method 
    protected $action = "index";
    // params 
    protected $params=[];

    public function __construct()
    {
        $this->prepareURL($_SERVER['REQUEST_URI']);
        // invoke controller and method
        $this->render();

    }



    /**
     * extract controller and method and all parameters
     * @param string $url -> request from url path 
     * @return 
     */
    private function prepareURL($url)
    {
        $url = trim($url,"/");
        if(!empty($url))
        {
            $url = explode('/',$url);
           
            $this->controller = isset($url[0]) ? ucwords($url[0])."Controller":"HomeController";
        
            $this->action = isset($url[1]) ? $url[1]:"index";
           
            unset($url[0],$url[1]);

            $this->params = !empty($url) ? array_values($url) : [];
        }
        
    }



    /**
     * render controller and method and send parameters 
     * @return function 
     */

    private function render()
    {
        
       
        if(class_exists($this->controller))
        {
            $controller = new $this->controller;
           
            if(method_exists($controller,$this->action))
            {
                call_user_func_array([$controller,$this->action],$this->params);
            }
            else 
            {
             
                new View('error');
            }
        }
        
        else 
        {
            
            new View('error');
        }  
        
    }
}





