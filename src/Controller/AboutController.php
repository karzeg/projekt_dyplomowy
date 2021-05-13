<?php
/**
 * About Controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AboutController.
 */
class AboutController extends AbstractController
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/o-serwisie",
     *     name="o-serwisie",
     *     )
     */
    public function about(): Response
    {
        return $this->render('about/index.html.twig');
    }
}
