<?php


namespace App\Security;


use App\Metin2Api\AuthApi;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;

class Metin2ApiAuthenticator implements SimpleFormAuthenticatorInterface {
    protected $authApi;
    public function __construct(AuthApi $api) {
        $this->authApi = $api;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey) {
        $userData = $this->authApi->getByCredentials($token->getUsername(),$token->getCredentials());
        if(!isset($userData['id'])) throw new CustomUserMessageAuthenticationException("Invalid username or password");
        $user = User::createFromMetin2Data($userData);
        return new UsernamePasswordToken(
            $user,
            $user->getPassword(),
            $providerKey,
            $user->getRoles()
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey) {
        return $token instanceof UsernamePasswordToken
            && $token->getProviderKey() === $providerKey;
    }

    public function createToken(Request $request, $username, $password, $providerKey) {
        return new UsernamePasswordToken($username, $password, $providerKey);
    }

}