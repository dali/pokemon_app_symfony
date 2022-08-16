<?php

namespace App\DataFixtures;

use App\Entity\Move;
use App\Repository\TypeRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MoveFixtures extends Fixture
{

    public function __construct(TypeRepository $typeRepository)
    {
       $this->typeRepository =  $typeRepository;
    }
    
    public function load(ObjectManager $manager): void
    {
        $movesFile =  file_get_contents('%kernel.root_dir%/../data/moves.json');
        $moves = json_decode($movesFile, true);
        
        
        foreach ($moves as $value) {
            $move = new Move();
            $move->setAccuracy($value['accuracy']);
            $move->setCategory($value['category']);
            $move->setCname($value['cname']);
            $move->setEname($value['ename']);
            $move->setJname($value['jname']);
            $move->setPower($value['power']);
            $move->setPp($value['pp']);
            if(isset($value['tm'])){
                $move->setTm($value['tm']);
            }

            $type = $this->typeRepository->findOneBy([
                'english' => $value['type']
            ]);
            $move->setType($type);
            $manager->persist($move);
        }
        

        $manager->flush();
    }
}
