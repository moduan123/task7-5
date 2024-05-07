<?php 



class HomeController extends Controller
{
    public function index()
    {
        $data = ["name"=>"mahmoud modian"];
        $this->view('home',$data);
    }
}
