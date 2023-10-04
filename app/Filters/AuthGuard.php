<?php 

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLogin'))
        {
            return redirect()
                ->to('/login');
        }
        else
        {
            $uri = \Config\Services::uri();
            $model = new \App\Models\Querymenu();

            $role_id = session()->get('role');
            $menu = $uri->getSegment(1);
            
            if($menu == 'admin')
            {
                $menu_id = 1;
            }
            else
            {
                $menu_id = 2;
            }
            $queryMenu = $model->get_where($role_id,$menu_id);

            if(!$queryMenu)
            {
                return redirect()->to('/blocked');
            }  
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
?>