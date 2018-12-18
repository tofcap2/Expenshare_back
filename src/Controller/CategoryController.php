<?php

/**
 *
 */
namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route("/category")
 */
class CategoryController extends BaseController
{
    /**
     * @Route("/{id}", name="category_get", methods="GET")
     */
    public function index(Category $category)
    {
        return $this->json($this->serialize($category));
    }

    /**
     * @Route("/", name="category_new", methods="POST")
     */
    public function new(Request $request)
    {
        $data = $request->getContent();

        $jsonData = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setId($jsonData["id"]);
        $category->setCreatedAt(new \DateTime());
        $category->setClosed(false);

        $em->persist($category);
        $em->flush();

        return $this->json($this->serialize($category));
    }
}
