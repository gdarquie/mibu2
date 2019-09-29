<?php

namespace App\Controller;

use App\Component\FragmentManager;
use App\Entity\Fragment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FragmentController extends AbstractController
{
    /**
     * @Route("/fragments/{uuid}", name="get_fragment", methods={"GET","HEAD"})
     *
     * @param SerializerInterface $serializer
     * @param string $uuid
     * @return Response
     */
    public function getEntity(SerializerInterface $serializer, string $uuid)
    {
        $fragment = $this->getDoctrine()->getRepository(Fragment::class)->findOneBy(['uuid' => $uuid]);
        $fragment = $serializer->serialize($fragment,'json');

        return new Response($fragment);
    }

    /**
     * @Route("/fragments", name="get_fragement_collection", methods={"GET"})
     */
    public function getCollection()
    {
        $fragments = $this->getDoctrine()->getRepository(Fragment::class)->findAll();
        $fragmentsList = [];
        foreach ($fragments as $fragment) {
            $fragmentsList[] = $fragment;
        }

        $fragmentsList = json_encode($fragmentsList);
        return new Response($fragmentsList);
    }

    /**
     * @Route("/fragments", methods={"POST"})
     */
    public function createEntity(Request $request, FragmentManager $fragmentManager, SerializerInterface $serializer)
    {
        $content = json_decode($request->getContent());

        $fragment = $fragmentManager->create($content);
        $this->getDoctrine()->getManager()->persist($fragment);
        $this->getDoctrine()->getManager()->flush();

        $fragment = $serializer->serialize($fragment,'json');
        return new Response($fragment);
    }

    /**
     * @Route("/fragments/{uuid}", methods={"PUT"})
     */
    public function updateEntity(Request $request)
    {
//        $response = $request->getContent();
        return new Response(true);
    }

    /**
     * @Route("/fragments", methods={"DELETE"})
     */
    public function deleteEntity(Request $request, SerializerInterface $serializer)
    {
        // get fragment
        $content = json_decode($request->getContent());
        if (!$fragment = $this->getDoctrine()->getRepository(Fragment::class)->findOneBy(['uuid' => $content->uuid])){
            throw new BadRequestHttpException('No fragment with uuid '.$content->uuid.' found!');
        }

        // delete fragment
        $this->getDoctrine()->getManager()->remove($fragment);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('Fragment has been completely destroyed!!');
    }
}
