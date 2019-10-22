<?php
class NewsViewModel extends ViewModel{
    protected $viewFields=array(
        'news'=>array( 'n_id','n_title','n_addtime','n_nums','n_message','n_status',
            '_type'=>'LEFT'
        ),
        'type'=>array(
            't_name'=>'n_type',
            '_on'=>'news.n_type=type.t_id'
        ),
        'user'=>array(
            'u_name'=>'n_author',
            '_on'=>'news.n_author=user.u_id'
        ),
    );
}