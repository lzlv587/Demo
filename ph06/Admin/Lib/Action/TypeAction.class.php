<?php
class TypeAction extends Action{
    //新闻分类列表页面
    Public function typeList(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
            $type=M('type');
            $count=$type->count('t_id');
            import('ORG.Util.Page');//
            $page=new page($count,7);
            $limit=$page->firstRow.','.$page->listRows;
            $list=$type->order('t_order ASC')->limit($limit)->select();
            $this->page=$page->show();
            $this->assign('list',$list);
            $this->display();
        }
    }
        //添加分类页面
      Public function addType(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        $this->display();
    }
    //添加过程
    Public function add(){
        if(!isset($_POST['t_name'])){
            $this->error('非法操作');
        }
        if(empty($_POST['t_name'])){
            $this->error('分类名称不能为空');
        }
        $type=M('type');
        $type->create();
        if($type->add()){
            $this->success('添加成功',U('typeList'));
        }
        else{
            $this->error('添加失败');
        }
    }
    //修改分类页面
    Public function updateType(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        if(!isset($_GET['t_id'])){
            $this->error('非法操作');
        }
        $type=M('type');
        $where['t_id']=$_GET['t_id'];
        $list=$type->where($where)->find();
        $this->assign('list',$list);
        $this->display();
    }
    //修改过程
    Public function update(){
        if(!isset($_POST['t_id'])){
            $this->error('非法操作');
        }
    if(empty($_POST['t_name'])){
        $this->error('分类名称不能为空');
    }
    $type=M('type');
    $type->create();
    $where['t_id']=$_POST['t_id'];
   if($type->where($where)->save()){
        $this->success('修改成功',U('typeList'));
    }
    else{
        $this->error('修改失败');
        }
     }
     //删除过程
     Public function delete(){
     if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
      if(!isset($_GET['t_id'])){
            $this->error('非法操作');
        }
        $type=M('type');
        $where['t_id']=$_GET['t_id'];
      if($type->where($where)->delete()){
          $this->success('删除成功',U('typeList'));
         }
      else{
        $this->error('删除失败');    
        }
     }
    }    