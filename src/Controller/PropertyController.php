<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertyShearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repo;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }
    /**
     * @Route("/biens", name="property.index") 
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PropertyShearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        $properties = $paginator->paginate(
            $this->repo->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('property/index.html.twig', [
            'menu_p' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    /**
     *@Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     *@param Property $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) {
            $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'menu_p' => 'properties'
        ]);
    }
}
       //$property[0]->setSold(true); changement bien vendu
        //$this->em->flush();


        /* $property = new Property();
        $property->setTitle('Bien test')
        ->setPrice(300000)
        ->setRooms(4)
        ->setBedrooms(3)
        ->setDescription('tjr un test')
        ->setSurface(80)
        ->setFloor(2)
        ->setCity('Massy')
        ->setPostal_code(91300)
        ->setAddress('10 rue las bas');

        $em = $this->getDoctrine()->getManager();
        $em->persist($property);
        $em->flush(); */

        /* $rep = $this->getDoctrine()->getRepository(Property::class);
        dump($rep); */
