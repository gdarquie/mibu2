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
        $fragment = $this->findFragment('uuid', $uuid);
        $fragment = $serializer->serialize($fragment,'json');

        return new Response($fragment);
    }

    /**
     * @Route("/fragments", name="get_fragement_collection", methods={"GET"})
     *
     * @return Response
     */
    public function getCollection()
    {
        //todo : upgrade this function + use pagination
        $fragments = $this->getDoctrine()->getRepository(Fragment::class)->findAll();
        $fragmentsList = [];
        foreach ($fragments as $fragment) {
            $fragmentsList[] = $fragment;
        }

        return new Response(json_encode($fragmentsList));
    }

    /**
     * @Route("/fragments", methods={"POST"})
     *
     * @param Request $request
     * @param FragmentManager $fragmentManager
     * @param SerializerInterface $serializer
     * @return Response
     * @throws \Exception
     */
    public function createEntity(Request $request, FragmentManager $fragmentManager, SerializerInterface $serializer)
    {
        // get data
        $content = json_decode($request->getContent());

        // hydrate entity
        $fragment = $fragmentManager->create($content);

        // save entity
        $this->getDoctrine()->getManager()->persist($fragment);
        $this->getDoctrine()->getManager()->flush();

        return new Response($serializer->serialize($fragment,'json'));
    }

    /**
     * @Route("/fragments", methods={"PUT"})
     *
     * @param Request $request
     * @param FragmentManager $fragmentManager
     * @param SerializerInterface $serializer
     * @return Response
     * @throws \Exception
     */
    public function updateEntity(Request $request, FragmentManager $fragmentManager, SerializerInterface $serializer)
    {
        // get fragment
        $content = json_decode($request->getContent());
        $fragment = $this->findFragment('uuid', $content->uuid);

        // hydrate entity
        $fragment = $fragmentManager->create($content);

        // update fragment
        $this->getDoctrine()->getManager()->persist($fragment);
        $this->getDoctrine()->getManager()->flush();

        return new Response($serializer->serialize($fragment,'json'));
    }

    /**
     * @Route("/fragments", methods={"DELETE"})
     *
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function deleteEntity(Request $request, SerializerInterface $serializer)
    {
        // get fragment
        $content = json_decode($request->getContent());
        $fragment = $this->findFragment('uuid', $content->uuid);

        // delete fragment
        $this->getDoctrine()->getManager()->remove($fragment);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('Fragment has been completely destroyed!!');
    }

    /**
     * @param $type
     * @param $value
     * @return Fragment|object|null
     */
    private function findFragment($type, $value)
    {
        if (!$fragment = $this->getDoctrine()->getRepository(Fragment::class)->findOneBy([$type => $value])){
            throw new BadRequestHttpException('No fragment with uuid '.$value.' found!');
        }

        return $fragment;
    }
}
