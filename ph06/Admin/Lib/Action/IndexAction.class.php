<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {
    Public function index(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        $this->assign('u_name',$_SESSION['u_name']);
        $this->display();
	
    }
    Public function sysMessage(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        $this->systemMsg=systemMsg();
        $this->display();
    }
}