<?php
class CommentAction extends Action{
    public function commentList(){
        if(!isset($_SESSION['u_id'])){
            $this->redirect('Login/login');
        }
        $comments=D('CommentView');
        $count=$comments->count('co_id');
        import('ORG.Util.Page');
        $page=new page($count,10);
        $limit=$page->firstRow.','.$page->listRows;
        $list=$comments->order('co_status DESC co_addtime DESC')->limit($limit)->select();
        $this->page=$page->show();
        $this->assign('list',$list);
        $this->display();
        }
        Public function update(){
            if(!isset($_SESSION['u_id'])){
                $this->redirect('Login/login');
                
            }
            if(!isset($_POST['co_id'])||!isset($_GET['co_status'])){
                $this->error('非法操作');
                
            }
            $comment=M('comment');
            $where['co_id']=$_GET['co_id'];
            if($_GET['co_status']==1){
                $data['co_status']=0;
            }else{
                $data['co_status']=1;
            }
            if ($comment->data($data)->where($where)->save()) {
                   $this->success('更改成功',U('commentList'));
               }
               else {
                   $this->error('更改失败');
               }
   
         }
         Public function delete(){
             if(!isset($_SESSION['u_id'])){
                 $this->redirect('Login/login');
             }
           
             if(!isset($_GET['co_id'])){
                 $this->error('非法操作');
             }
             $comment=M('comment');
             $where['co_id']=$_GET['co_id'];
             if($comment->where($where)->delet()){
                 $this->success('删除成功',U('commentList'));
             }
             else {
                 $this->error('删除失败');
             }
         
         
        }
}