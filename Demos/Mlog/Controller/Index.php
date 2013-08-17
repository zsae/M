<?php
/**
 * @link https://github.com/MaGuowei/M
 * @copyright 2013 maguowei.com
 * @author Ma Guowei <imaguowei@gmail.com>
 */
namespace Mlog\Controller;

use Mlog\Model\Post;
use Mlog\Model\User;

class Index extends Common
{
    public $data = array(
        'controller' => 'Index',
        'title' => '首页',
    );

    protected $layout = 'test';

    public function index()
    {
        $post = new Post();
        $post->orderBy('id','desc')->limit(0,5);
        $post = $post->select();
        $this->assign('post',$post);
        $this->display('Index/index');
    }

    public function login()
    {
        if(isset($_POST['login']))
        {
            $user = new User();

            $user->get_Post();

            $result = $user->login();

            if($result)
            {
                $this->success($_SESSION['username'].'登录成功',array('Index','index'));
            }
            else
            {
                $this->error('登录失败');
            }

        }
        else
        {
            $this->display('Index/login');
        }
    }

    public function reg()
    {
        if(isset($_POST['reg']))
        {
            $user = new User();

            $user->get_Post();
            $result = $user->save();

            if($result)
            {
                $this->success('注册成功',array('Index','index'));
            }
            else
            {
                $this->error('注册失败');
            }
        }
        else
        {
            $this->data['title'] = 'Reg';
            $this->display('Index/reg');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->success('退出成功',array('Index','index'));
    }
}