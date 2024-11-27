<?php

namespace App\EventListener;

use App\Service\LanguageSwitcher;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface
{
    private LanguageSwitcher $languageSwitcher;

    public function __construct(LanguageSwitcher $languageSwitcher)
    {
        $this->languageSwitcher = $languageSwitcher;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if ($request->hasSession()) {
            $locale = $this->languageSwitcher->getLocale();
            $request->setLocale($locale);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}