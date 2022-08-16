<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $typesFile =  file_get_contents('%kernel.root_dir%/../data/types.json');
        $types = json_decode($typesFile, true);
        
        
        foreach ($types as $value) {
            $type = new Type();
            $type->setEnglish($value['english']);
            $type->setChinese($value['chinese']);
            $type->setJapanese($value['japanese']);
            $manager->persist($type);
        }
        

        $manager->flush();
    }
}
