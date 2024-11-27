<?php

namespace App\Controller;

use App\Service\LanguageSwitcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    private LanguageSwitcher $languageSwitcher;

    public function __construct(LanguageSwitcher $languageSwitcher)
    {
        $this->languageSwitcher = $languageSwitcher;
    }

    #[Route('/switch-language/{locale}', name: 'switch_language')]
    public function switchLanguage(string $locale): RedirectResponse
    {
        $this->languageSwitcher->switchLanguage($locale);
        return $this->redirectToRoute('app_index');
    }
}