<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Expense;

/**
 * Class ExpenseController
 * @package App\Controller
 * @Route("/expense")
 */
class ExpenseController extends BaseController
{
    /**
     * @Route("/{id}", name="expense_get", methods="GET")
     */
    public function index(Expense $expense)
    {
        return $this->json($this->serialize($expense));
    }

    /**
     * @Route("/", name="expense_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $expense = new Expense();
        $expense->setId($jsonData["id"]);
        $expense->setCreatedAt(new \DateTime());
        $expense->setClosed(false);

        $em->persist($expense);
        $em->flush();

        return $this->json($this->serialize($expense));
    }
}
