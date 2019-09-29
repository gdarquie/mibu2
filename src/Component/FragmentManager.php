<?php

namespace App\Component;

use App\Entity\Fragment;
use Ramsey\Uuid\Uuid;

/**
 * Class FragmentManager
 * @package App\Component
 */
class FragmentManager
{
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
}