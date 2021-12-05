<?php
namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * 
 */
class PropertyController extends AbstractController
{
    private $repository;
    private $request;

    /**
     * Constructeur
     */
    public function __construct(PropertyRepository $repository, )
    {
        $this->repository = $repository;
    }
   
    /**
     * @Route("/biens", name="property.index")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        // Récupération de tous les biens dans la base.
        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12 /*limit per page*/
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
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
                    'slug' => $property->getSlug()
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