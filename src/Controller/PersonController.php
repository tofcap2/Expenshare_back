<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\ShareGroup;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PersonController
 * @package App\Controller
 * @Route("/person")
 */
class PersonController extends BaseController
{
    /**
     * @Route("/group/{slug}", name="person", methods="GET")
     */
    public function index(ShareGroup $shareGroup)
    {
        $persons = $this->getDoctrine()->getRepository(Person::class)
            ->createQueryBuilder('p')
            ->select('p', 'e')
            ->leftJoin('p.expenses', 'e')
            ->where('p.shareGroup = :group')
            ->setParameter(':group', $shareGroup)
            ->getQuery()
            ->getArrayResult()
        ;

        return $this->json($persons);
    }

    /**
     * @Route("/", name="person_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $person = new Person();
        $person->setId($jsonData["id"]);
        $person->setCreatedAt(new \DateTime());
        $person->setClosed(false);

        $em->persist($person);
        $em->flush();

        return $this->json($this->serialize($person));
    }

}