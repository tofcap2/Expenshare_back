<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DebtController
 * @package App\Controller
 * @Route("/debt")
 */
class DebtController extends BaseController
{
    /**
     * @Route("/", name="debt", methods="GET")
     */
    public function index()
    {
        return $this->render('debt/index.html.twig', [
            'controller_name' => 'DebtController',
        ]);
    }
}
