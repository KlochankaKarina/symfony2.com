<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(LoggerInterface $logger)
    {
         $logger->info('Look! I just used a service');
         return new Response('
            <!DOCTYPE html>
        <html>
        <head>
            <title>main</title>
        </head>
        <body>
        123
        </body>
        </html>
        ');
        //return new Response('123');
	   //echo "123";
       /* return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);*/
    }
}
