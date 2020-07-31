<?php

namespace App\EventSubscriber;

use App\Event\RegisteredUserEvent;
use App\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Environment;
use Swift_Mailer;



class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var Mailer
    
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @param Mailer $mailer
    
     */
    public function __construct(Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
          $this->twig = $twig;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            RegisteredUserEvent::NAME => 'onUserRegister'
        ];
    }

    /**
     * @param RegisteredUserEvent $userRegisteredEvent
     * @throws \LoaderError
     * @throws \RuntimeError
     * @throws \SyntaxError
     * @throws \Environment
     */
    public function onUserRegister(RegisteredUserEvent $userRegisteredEvent)
    {
        $this->mailer->sendConfirmationMessage($userRegisteredEvent->getRegisteredUser());
    }
}