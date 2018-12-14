<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 * @package App\Controller
 * @Route("/person")
 */
class PersonController extends BaseController
{
    /**
     * @Route("/", name="person", methods="GET")
     */
    public function index()
    {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }
}
