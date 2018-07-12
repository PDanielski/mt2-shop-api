<?php


namespace App\EventListener;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PlayerIdCatcher {
    protected $request;
    protected $user;
    public function __construct(RequestStack $requestStack, TokenStorageInterface $storage){
        $this->request = $requestStack->getCurrentRequest();
        if($storage->getToken())
        $this->user = $storage->getToken()->getUser();
    }
    public function onKernelController(FilterControllerEvent $event){
        if($this->request->cookies->get("playerId")){
            if($this->user != "anon." && $this->user){
                $playerId = $this->request->cookies->get("playerId");
                if(!$this->user->getPlayer($playerId)) throw new AccessDeniedHttpException();
                $this->user->setCurrentPlayerId($playerId);
            }
        }
    }
}