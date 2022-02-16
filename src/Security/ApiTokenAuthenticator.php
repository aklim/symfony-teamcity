<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class ApiTokenAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    /** Allowed authorization header name */
    private const AUTHORIZATION_HEADER_NAME = 'Authorization';

    public function supports(Request $request): ?bool
    {
        return $request->headers->has(self::AUTHORIZATION_HEADER_NAME);
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get(self::AUTHORIZATION_HEADER_NAME);

        if (null === $apiToken) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

//        $userBadge = new UserBadge($apiToken);
        return new SelfValidatingPassport(new UserBadge($apiToken));

//        $customCredentials = new CustomCredentials(function ($credentials, User $user) {
//            return $user->getApiToken() === $credentials;
//        }, $apiToken);
//
//        $passport = new Passport($userBadge, $customCredentials);
//
//        return $passport;
//
//        return new Passport(
//            new UserBadge($apiToken), new CustomCredentials(
//            // If this function returns anything else than `true`, the credentials
//            // are marked as invalid.
//            // The $credentials parameter is equal to the next argument of this class
//                function ($credentials, UserInterface $user) {
//                    return $user->getApiToken() === $credentials;
//                },
//
//                // The custom credentials
//                $apiToken
//            )
//        );
//
//        return new SelfValidatingPassport(new UserBadge($apiToken));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData()),

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        /*
         * If you would like this class to control what happens when an anonymous user accesses a
         * protected page (e.g. redirect to /login), uncomment this method and make this class
         * implement Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface.
         *
         * For more details, see https://symfony.com/doc/current/security/experimental_authenticators.html#configuring-the-authentication-entry-point
         */

        $data = [
            'message' => 'Authentication is required to access this resource.',

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}
