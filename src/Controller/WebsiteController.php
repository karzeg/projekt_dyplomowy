<?php
/**
 * Website controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WebsiteController.
 *
 * @Route("/")
 */
class WebsiteController extends AbstractController
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse RedirectResponse
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="redirect",
     * )
     */
    public function index(): RedirectResponse
    {
        return $this->redirectToRoute('musical_index');
    }
}
