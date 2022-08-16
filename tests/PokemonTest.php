<?php


namespace App\Tests;

use App\Entity\Type;
use App\Entity\Pokemon;
use App\Entity\BaseStats;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PokemonTest extends KernelTestCase
{
    
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel([
            'environment' => 'test',
            'debug'       => true,
        ]);
        DatabasePrimer::prime($kernel);

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }


    /* Initial test */
    // public function testIsWorks()
    // {
    //     $this->assertTrue(true);
    // }

    /**
     * @test 
     */ 
    public function a_pokemon_record_can_be_created_in_the_database()
    {
     

        $pokemon = new Pokemon();

        $pokemon->setName('Bulbasaur');
        
        $this->entityManager->persist($pokemon);


        $base = new BaseStats();
        $base->setHp(45)
             ->setAttack(49)
             ->setDefence(49)
             ->setSpAtk(65)
             ->setSpDef(65)
             ->setSpeed(45)
             ->setTotal(309)
             ;
        $base->setPokemon($pokemon);


        $type = new Type();
        $type->setName('Poison');
        $type->setName('Water');

        $this->entityManager->persist($type);

        $pokemon->addType($type);

        $this->entityManager->persist($base);
        
        $this->entityManager->flush();
        
  
        $pokemonRepository = $this->entityManager
                                ->getRepository(Pokemon::class);

        $pokemonRecord = $pokemonRepository->findOneBy([
                                    'name' => 'Bulbasaur'
                                    ]);

        $statsRepository = $this->entityManager
                                ->getRepository(BaseStats::class);

        $statsRecord = $statsRepository->findOneBy([
                                            'pokemon' => $pokemon->getId()
                                            ]);
        $typeRepository = $this->entityManager
                               ->getRepository(Type::class);
                               
        $typeRecord = $typeRepository->findOneBy([
                                'name' => 'Water'
                                ]);

        $this->assertEquals('Bulbasaur', $pokemonRecord->getName());                                   
        $this->assertEquals('Bulbasaur', $statsRecord->getPokemon()->getName());
        $this->assertEquals('Water', $typeRecord->getName());

    }

    
}