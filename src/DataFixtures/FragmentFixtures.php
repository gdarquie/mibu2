<?php

namespace App\DataFixtures;

use App\Entity\Fragment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class FragmentFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $fragment = new Fragment();
        $fragment->setContent('Exemple de contenu de fragment prédéfini!');
        $fragment->setUuid('76d3cee3-e3f5-4149-8db6-5dc1d3b58dc4');
        $fragment->setCode('Alpha');
        $manager->persist($fragment);

        for ($i = 0; $i < 10; $i++) {
            $fragment = new Fragment();
            $fragment->setCode($i);
            $fragment->setContent('Exemple de contenu');
            $uuid4 = Uuid::uuid4();
            $fragment->setUuid($uuid4->toString());
            $manager->persist($fragment);
        }

        $manager->flush();
    }
}
