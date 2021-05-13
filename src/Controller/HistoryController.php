<?php
/**
 * History Controller.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HistoryController.
 */
class HistoryController extends AbstractController
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/historia",
     *     name="historia",
     *     )
     */
    public function history(): Response
    {
        return $this->render('history/index.html.twig');
    }
}
