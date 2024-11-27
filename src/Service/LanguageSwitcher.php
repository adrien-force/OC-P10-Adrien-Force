<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionFactory;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LanguageSwitcher
{
    private RequestStack $requestStack;
    private SessionInterface $session;
    private string $defaultLocale;

    public function __construct(RequestStack $requestStack, SessionFactory $sessionFactory, string $defaultLocale = 'fr')
    {
        $this->requestStack = $requestStack;
        $this->session = $sessionFactory->createSession();
        $this->defaultLocale = $defaultLocale;
    }

    public function switchLanguage(string $locale): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request) {
            $request->setLocale($locale);
            $this->session->set('_locale', $locale);
        }
    }

    public function getLocale(): string
    {
        return $this->session->get('_locale', $this->defaultLocale);
    }
}