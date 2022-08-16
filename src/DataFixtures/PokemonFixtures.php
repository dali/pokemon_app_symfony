<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\Pokemon;
use App\Entity\BaseStats;
use App\Repository\TypeRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PokemonFixtures extends Fixture
{


    private $typeRepository;

    public function __construct(TypeRepository $typeRepository)
    {
       $this->typeRepository =  $typeRepository;
    }

    public function load(ObjectManager $manager): void
    {


        $pokedexFile =  file_get_contents('%kernel.root_dir%/../data/pokedex.json');
        $pokedex = json_decode($pokedexFile, true);
        
        foreach ($pokedex as $key => $value) {
            $pokemon = new Pokemon();

            $pokemon->setEnglish($value['name']['english']);
            $pokemon->setJapanese($value['name']['japanese']);
            $pokemon->setChinese($value['name']['chinese']);
            $pokemon->setFrench($value['name']['french']);
            $manager->persist($pokemon);
            
            for ($i=0; $i < count($value['type']); $i++) { 
                $name = $value['type'][$i];
                $typeRecord = $this->typeRepository->findOneBy([
                                    'english' => $name
                                ]);
                $pokemon->getTypes()->add($typeRecord);
            }
            
            $base = new BaseStats();
            $total = array_sum([
                $value['base']['HP'],
                $value['base']['Attack'], 
                $value['base']['Defense'],
                $value['base']["Sp. Attack"],
                $value['base']["Sp. Defense"],
                $value['base']['Speed']
                ]
            );
            $base->setHp($value['base']['HP'])
                 ->setAttack($value['base']['Attack'])
                 ->setDefence($value['base']['Defense'])
                 ->setSpAtk($value['base']["Sp. Attack"])
                 ->setSpDef($value['base']["Sp. Defense"])
                 ->setSpeed($value['base']['Speed'])
                 ->setTotal($total)
                 ;
            $base->setPokemon($pokemon);
            $manager->persist($base);
        }

        $manager->flush();
    }
}
