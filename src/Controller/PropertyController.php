<?php
namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;

/**
 * 
 */
class PropertyController extends AbstractController
{
    private $repository;

    /**
     * Constructeur
     */
    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     */
    public function index(): Response
    {
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
            ]
        );
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[0-9a-z\-]*"})
     */
    public function show(Property $property, string $slug) : Response
    {
        if($property->getSlug() !== $slug) 
        {
            return $this->redirectToRoute(
                'property.show', 
                [
                    'id' => $property->getId(),
                    'slug' =>  $property->getSlug()
                ], 
                301
            );
        }

        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
            ]
        );
    }
}