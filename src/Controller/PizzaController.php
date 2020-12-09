<?php

namespace App\Controller;

use App\Entity\Alumno;
use App\Entity\Signature;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PizzaController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
    /**
     * @Route("/pizza", name="pizza")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PizzaController.php',
        ]);
    }

    /**
     * @Route("/pizza/add", name="pizza_add")
     */
    public function addSignature(): Response
    {
        /** @var Alumno $alumno */
        $alumno = $this->em->getRepository(Alumno::class)->find(1);
        /** @var Signature $signature */
        $signature = $this->em->getRepository(Signature::class)->find(2);

        $alumno->addSignature($signature);

        $this->em->persist($alumno);
        $this->em->flush();

        return $this->json([
            'message' => 'A new Alumno was signatured',
        ]);


    }

    /**
     * @Route("/pizza/read", name="pizza_read")
     */
    public function readSignature(): Response
    {
        /** @var Alumno $alumno */
        $alumno = $this->em->getRepository(Alumno::class)->find(1);

        $signatures = '';
        foreach ($alumno->getSignature() as $signature)
        {
            $signatures .= $signature->getName() . PHP_EOL;
        }

        $status = 'El alumno ' . $alumno->getName() . ' está matriculado en : ' . $signatures;

        return new Response($status);


    }
}
