<?php

namespace abs\TemplateBundle\Services;

use Doctrine\ORM\EntityManager;

/**
 * Class Menu.
 */
class MenuExtention extends \Twig_Extension
{
    protected $em;
    protected $twig;

    /**
     * Menu constructor.
     *
     * @param EntityManager     $entityManager
     * @param \Twig_Environment $twig
     */
    public function __construct(EntityManager $entityManager, \Twig_Environment $twig)
    {
        $this->twig = $twig;
        $this->em = $entityManager;
    }

    /**
     * @return array available Twig functions
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('MenuBuilder', [$this, 'build'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function build()
    {
        //Add algos to set the menu dynamically
        return $this->twig->render('@absTemplate/Menu/builder.html.twig', []);
    }
}
