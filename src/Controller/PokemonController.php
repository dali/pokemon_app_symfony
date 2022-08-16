<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\TypeRepository;
use App\Repository\PokemonRepository;
use Doctrine\DBAL\Types\TypeRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'app_pokemon')]
    public function index( PokemonRepository $pokemonRepository, TypeRepository $typeRepository): Response
    {
        
        $pokemons = $pokemonRepository->findAllPokemon();
        $types = $typeRepository->findAll();
        
        return $this->render('pokemon/index.html.twig',[
                        'pokemons' => $pokemons,
                        'types' => $types
                    ]);
    }

    #[Route('/pokemon/{id}', methods: ['GET'], name: 'pokemon_show')]
    public function show(Pokemon $pokemon): Response
    {

        return $this->render('pokemon/show.html.twig', [
                                                'pokemon' => $pokemon
                                            ]);
    }




    #[Route('/pokemon/filter', methods: ['POST'], name: 'pokemon_filter')]
    public function filterByType(Request $request, PokemonRepository $pokemonRepository)
    {
        $type_id = $request->request->get('type');
        $pokemons = $pokemonRepository->findPokemonByType($type_id);
        
        return $this->render('pokemon/filter_type.html.twig', [
                                                'pokemons' => $pokemons
                                            ]);
    }


    #[Route('/pokemon/compare', methods: ['POST'], name: 'pokemon_compare')]
    public function compare(Request $request, PokemonRepository $pokemonRepository)
    {
        $first_pokemon = $request->request->get('first_pokemon');
        $second_pokemon = $request->request->get('second_pokemon');

        if($first_pokemon === $second_pokemon ){
            return new Response(
                'You must select two diffrent pokemon'
            );
        }
        $pokemons = $pokemonRepository->findBy([
                                    'id' => [$first_pokemon, $second_pokemon]
        ]);

        return $this->render('pokemon/compare.html.twig', [
                                                'pokemons' => $pokemons
                                            ]);
    }

}
