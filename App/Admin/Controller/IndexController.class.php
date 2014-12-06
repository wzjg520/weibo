<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	if(session('admin')){
    		$this->display();
    	}else{
    		$this->redirect('Login/index');
    	}
    	
       
    }
}