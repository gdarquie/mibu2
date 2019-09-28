<?php

namespace App\Controller;

use App\Entity\Fragment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FragmentController extends AbstractController
{
    /**
     * @Route("/fragments/{uuid}", name="get_fragment", methods={"GET","HEAD"})
     *
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param string $uuid
     * @return Response
     */
    public function getEntity(EntityManagerInterface $em, SerializerInterface $serializer, string $uuid)
    {
        $fragment = $em->getRepository(Fragment::class)->findOneByUuid($uuid);
        $fragment = $serializer->serialize($fragment,'json');

        return new Response($fragment);
    }

    /**
     * @Route("/fragments", name="get_fragement_collection", methods={"GET"})
     */
    public function getCollection(EntityManagerInterface $em)
    {
        $fragments = $em->getRepository(Fragment::class)->findAll();
        $fragmentsList = [];
        foreach ($fragments as $fragment) {
            $fragmentsList[] = $fragment;
        }

        $fragmentsList = json_encode($fragmentsList);
        return new Response($fragmentsList);
    }

    /**
     * @Route("/fragments/{id}", methods={"POST"})
     */
    public function createEntity(Request $request)
    {
//        $response = $request->getContent();
        //create entity

        return new Response(true);
    }

    /**
     * @Route("/fragments", methods={"PUT"})
     */
    public function updateEntity(Request $request)
    {
//        $response = $request->getContent();
        return new Response(true);
    }

    /**
     * @Route("/fragments", methods={"DELETE"})
     */
    public function deleteEntity(Request $request)
    {
//        $response = $request->getContent();
        return new Response(true);
    }
}
