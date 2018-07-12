<?php


namespace App\Security;


use App\Metin2Api\AccountApi;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface {
    protected $api;
    public function __construct(AccountApi $api){
        $this->api = $api;
    }
    public function loadUserByUsername($username) {
        $data = $this->api->getByUsername($username);
        if($data){
            return User::createFromMetin2Data($data);
        }
        throw new UsernameNotFoundException();
    }

    public function refreshUser(UserInterface $user) {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        if(!$class instanceof User) return false;
        return true;
    }

}