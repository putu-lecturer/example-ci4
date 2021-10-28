<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        if ($session->has('auth'))
        { 
            if ($request->uri->getPath() == 'login')
            {
                return redirect()->to('profile');
            }
            // if ($request->uri->getSegment(1) == 'admin')
            // {
            //      return redirect()->back();
            // }
        } 
        else
        {
            if ($request->uri->getPath() != 'login')
            {
                return redirect()->to('login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}