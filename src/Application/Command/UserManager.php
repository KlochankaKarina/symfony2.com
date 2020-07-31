<?php

declare(strict_types=1);

namespace App\Application\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Events;
use App\Repository\EventsRepository;

class UserManager extends AbstractController
{
    /** @var EventsRepository $eventsRepository */
    private $eventsRepository;
public $username;
public $data;
    public function __construct(EventsRepository $eventsRepository)
    {
        $this->eventsRepository = $eventsRepository;
    }
    public function recordEvent(string $username, string $body)
    {
        $events = new Events();
       $events->setUsername("$username");
       $events->setBody("$body");
       
       
        $em=$this->getDoctrine()->getManager();
            $em->persist($events);
            $em->flush();
            }
    
}