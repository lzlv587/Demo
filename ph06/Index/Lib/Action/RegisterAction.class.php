<?php
class RegisterAction extends Action{
    public function register(){
        $this->display();
    }
    
    
    public function doRegister(){
        if(emoty($_POST['c_name'])){
            $this->error('注册失败');
        }
        $customer=M('customer');
        $data['c_name']=$_POST['c_name'];
       
        $data['c_password']=($_POST['c_password']);
        $data['c_register_time']=time();
       $data['c_status']='1';
       
        if (!$lastid=$customer->add($data)){
            $this->success("注册成功",U('Login/login'));
        }
        else {
           $this->error('注册失败!');
        }
    }
 Public function checkName() {
        $where['c_name']=$_POST['c_name'];
        $customer=M('customer');
        $id=$customer->where($where)->getField('c_id');
        if (isset($id)){
            $data['result']=0;
            echo json_encode($data);exit;
        }else {
            $data['result']=1;
        
        echo json_encode($data);exit;
    }}
}
