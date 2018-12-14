<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExpenseController
 * @package App\Controller
 * @Route("/expense")
 */
class ExpenseController extends BaseController
{
    /**
     * @Route("/", name="expense", methods="GET")
     */
    public function index()
    {
        return $this->render('expense/index.html.twig', [
            'controller_name' => 'ExpenseController',
        ]);
    }
}
