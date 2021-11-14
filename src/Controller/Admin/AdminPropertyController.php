<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     */
    public function index() : Response
    {
        $properties = $this->repository->findAll();
        return $this->render('admin/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/admin/{id}", name="admin.property.edit")
     */
    public function edit(Property $property) : Response
    {
        $form = $this->createForm(PropertyType::class, $property);
        return $this->render('admin/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
}