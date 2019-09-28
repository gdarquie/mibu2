<?php

namespace App\Controller;

use App\Entity\Fragment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FragmentController extends AbstractController
{
    /**
     * @Route("/fragments/{id}", name="get_fragment", methods={"GET","HEAD"})
     *
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @param string $id
     * @return Response
     */
    public function getEntity(EntityManagerInterface $em, SerializerInterface $serializer, string $id)
    {
        $fragment = $em->getRepository(Fragment::class)->findOneById($id);
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
    public function createEntity()
    {
        return new Response(true);
    }

    /**
     * @Route("/fragments", methods={"PUT"})
     */
    public function updateEntity()
    {
        return new Response(true);
    }

    /**
     * @Route("/fragments", methods={"DELETE"})
     */
    public function deleteEntity()
    {
        return new Response(true);
    }
}
