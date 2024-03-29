<?php

namespace App\Component;

use App\Entity\Fragment;
use App\Repository\FragmentRepository;
use Ramsey\Uuid\Uuid;

/**
 * Class FragmentManager
 * @package App\Component
 */
class FragmentManager
{
    /**
     * @param $response
     * @return Fragment
     * @throws \Exception
     */
    public function create($response)
    {
        $fragment = new Fragment();
        $fragment->setContent($response->content);

        //set uuid
        $uuid = Uuid::uuid4();
        $fragment->setUuid($uuid->toString());

        //set code
        $uniqid = uniqid();
        $fragment->setCode('FRAG_'.$uniqid);

        return $fragment;
    }

    /**
     * @param FragmentRepository $fragmentRepository
     * @return Fragment[]
     */
    public function getFragmentsCollection(FragmentRepository $fragmentRepository) {
        return $fragmentRepository->findAll();
    }
}