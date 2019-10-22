<?php
class LoginAction extends Action{
    public function login(){
        $this->display();
    }
    public function doLogin(){
        if (!$this->isPost())halt('页面不正确');
        $validate=md5($_POST['validate']);
        if ($_SESSION['verify']!=$validate){
            $this->error('验证码不正确');
        }
        $u_name=$_POST['u_name'];
        $where['u_name']=$_POST['u_name'];
        $u_password=($_POST['u_password']);
        
        $user=M('user');
        $message=$user->where($where)->find();
        if (!$u_name||$message['u_password']!=$u_password) {
            $this->error('用户名或者账号不正确');
        }
        else {
            $_SESSION['u_name']=$message['u_name'];
            $_SESSION['u_id']=$message['u_id'];
            redirect(__APP__);
        }
    }
    Public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
    Public function loginOut() {
        $_SESSION=array();
        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-1,'/');
        }
        session_destroy();
        $this->redirect('Login/login');
    }
    
}