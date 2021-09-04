<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
      // Do something here
      $uri = service('uri');
      $page = $uri->getSegment(1);
      if(!session()->get('islogged_in')) {
        if ($page == 'r') {
          return redirect()->to('r');
        } elseif($page == 'a') {
          return redirect()->to('a');
        }
      }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}