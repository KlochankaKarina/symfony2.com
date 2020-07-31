<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestTwigController extends AbstractController
{
    /**
     * @Route("/test/twig", name="test_twig")
     */
    public function index()
    {
       $tests = [
        'post_1'=>['title'=>'test1', 'text'=>'test2'],
        'post_2'=>['title'=>'test3', 'text'=>'test3'],
    ];
       //dd($test);
        return $this->render('test_twig/index.html.twig', [
            'tests' => $tests
        ]);
    }
}
