<?php
class LoginAction extends Action{
    public function login(){
        $this->display();
    }
    public function doLogin(){
        $c_name=$_POST['c_name'];
       $where['u_name']=$_POST['u_name'];
       $c_password=($_POST['u_password']);
       $customer=M('customer');
       $message=$customer->where($where)->find();
       if (!$c_name||$message['c_password']!=$c_password) {
           $this->error('用户名或者账号不正确');
       }
       else {
           $_SESSION['c_name']=$message['c_name'];
           $_SESSION['c_id']=$message['c_id'];
          $this->success("恭喜您，登录成功",U(Index/index));
       }
       }
       
       Public function loginOut() {
           $_SESSION=array();
           if (isset($_COOKIE[session_name()])){
               setcookie(session_name(),'',time()-1,'/');
           }
           session_destroy();
           $this->redirect('Index/index');
       }
       
       }