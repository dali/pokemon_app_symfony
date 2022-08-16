<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $itemsFile =  file_get_contents('%kernel.root_dir%/../data/items.json');
        $items = json_decode($itemsFile, true);
        
        
        foreach ($items as $value) {
            $item = new Item();
            // dd($value['name']['chinese']);
            
            if(isset($value['name']['japanese'])){
                $item->setJapanese($value['name']['japanese']);
            }
            if(isset($value['name']['chinese'])){
                $item->setChinese($value['name']['chinese']);
            }
            $item->setEnglish($value['name']['english']);
            
            $manager->persist($item);
        }

        $manager->flush();
    }
}
