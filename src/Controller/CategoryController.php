<?php

/**
 *
 */
namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 */
class CategoryController extends BaseController
{
    /**
     * @Route("/", name="category", methods="GET")
     */
    public function index(Request $request): Response
    {
        $category = $this->getDoctrine()->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->getQuery()
            ->getArrayResult();

        if ($request->isXmlHttpRequest()){
            return $this->json($category);
        }
    }
}
