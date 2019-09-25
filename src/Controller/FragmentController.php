<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FragmentController extends AbstractController
{
    /**
     * @Route("/fragments/{id}", name="get_fragment")
     *
     * @param string $id
     * @return object|Response
     */
    public function get($id)
    {
        return new Response(true);
    }

    /**
     * @Route("/fragments", name="get_fragement_collection")
     */
    public function getCollection()
    {
        return new Response('Ok!');
    }


    public function create()
    {
        return new Response(true);
    }
    
    public function update()
    {
        return new Response(true);
    }

    public function delete()
    {
        return new Response(true);
    }
}
