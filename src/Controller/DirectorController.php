<?php
/**
 * Director controller.
 */

namespace App\Controller;

use App\Entity\Director;
use App\Repository\DirectorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DirectorController.
 *
 * @Route("/rezyserzy")
 */
class DirectorController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request            HTTP request
     * @param \App\Repository\DirectorRepository        $directorRepository Director repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator          Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="director_index",
     * )
     */
    public function index(Request $request, DirectorRepository $directorRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $directorRepository->queryAll(),
            $request->query->getInt('page', 1),
            DirectorRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'director/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param \App\Entity\Director $director Director entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="director_show",
     *     requirements={"id": "[0-9]\d*"},
     * )
     */
    public function show(Director $director): Response
    {
        return $this->render(
            'director/show.html.twig',
            ['director' => $director]
        );
    }
}
