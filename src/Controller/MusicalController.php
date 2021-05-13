<?php
/**
 * Musical controller.
 */

namespace App\Controller;

use App\Entity\Musical;
use App\Repository\MusicalRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MusicalController.
 *
 * @Route("/")
 */
class MusicalController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request           HTTP request
     * @param \App\Repository\MusicalRepository         $musicalRepository Musical repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator         Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="musical_index",
     * )
     */
    public function index(Request $request, MusicalRepository $musicalRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $musicalRepository->queryAll(),
            $request->query->getInt('page', 1),
            MusicalRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'musical/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param \App\Entity\Musical $musical Musical entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="musical_show",
     *     requirements={"id": "[0-9]\d*"},
     * )
     */
    public function show(Musical $musical): Response
    {
        return $this->render(
            'musical/show.html.twig',
            ['musical' => $musical]
        );
    }
}
