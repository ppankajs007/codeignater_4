<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class isLogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    	$session = \Config\Services::session();
        if( !$session->get('userData') ){
        	return redirect('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}