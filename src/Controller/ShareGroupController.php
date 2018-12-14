<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ShareGroupController
 * @package App\Controller
 * @Route("/share_group")
 */
class ShareGroupController extends BaseController
{
    /**
     * @Route("/", name="share_group", methods="GET")
     */
    public function index()
    {
        return $this->render('share_group/index.html.twig', [
            'controller_name' => 'ShareGroupController',
        ]);
    }
}
