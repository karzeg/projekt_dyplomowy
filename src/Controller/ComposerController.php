<?php
/**
 * Composer controller.
 */

namespace App\Controller;

use App\Entity\Composer;
use App\Repository\ComposerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ComposerController.
 *
 * @Route("/tworcy")
 */
class ComposerController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request            HTTP request
     * @param \App\Repository\ComposerRepository        $composerRepository Composer repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator          Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="composer_index",
     * )
     */
    public function index(Request $request, ComposerRepository $composerRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $composerRepository->queryAll(),
            $request->query->getInt('page', 1),
            ComposerRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'composer/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param \App\Entity\Composer $composer Composer entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="composer_show",
     *     requirements={"id": "[0-9]\d*"},
     * )
     */
    public function show(Composer $composer): Response
    {
        return $this->render(
            'composer/show.html.twig',
            ['composer' => $composer]
        );
    }
}
