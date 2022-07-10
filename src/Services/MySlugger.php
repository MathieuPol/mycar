<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger
{
    /**
     * instance of SluggerInterface
     * @var SluggerInterface
     */
    private $slugger;

    /**
     * Parametrage du service: active le lower
     * @var bool
     */
    private $paramLower;


    public function __construct(SluggerInterface $slugger, ContainerBagInterface $params, $lower)
    {
        $this->slugger = $slugger;
        $valeurServicesYaml = $params->get('myslugger.lower');

        $this->paramLower = ($valeurServicesYaml === 'true') ? true : false;
    }

    /**
     * Renvoi un slug du paramètre $toSlug
     * @param string $toSlug
     * @return string
     */
    public function slug(string $toSlug): string
    {

        $slug = $this->slugger->slug($toSlug);
        if ($this->paramLower) {
            $slug = strtolower($slug);
        }
        return $slug;
    }
}