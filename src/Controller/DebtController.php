<?php

namespace App\Controller;

use App\Entity\Debt;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DebtController
 * @package App\Controller
 * @Route("/debt")
 */
class DebtController extends BaseController
{
    /**
     * @Route("/{id}", name="debt_get", methods="GET")
     */
    public function index(Debt $debt)
    {
        return $this->json($this->serialize($debt));
    }

    /**
     * @Route("/", name="debt_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $debt = new Debt();
        $debt->setId($jsonData["id"]);
        $debt->setCreatedAt(new \DateTime());
        $debt->setClosed(false);

        $em->persist($debt);
        $em->flush();

        return $this->json($this->serialize($debt));
    }
}
