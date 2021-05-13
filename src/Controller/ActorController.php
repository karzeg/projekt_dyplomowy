<?php
/**
 * Composer controller.
 */

namespace App\Controller;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ActorController.
 *
 * @Route("/aktorzy")
 */
class ActorController extends AbstractController
{
    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request         HTTP request
     * @param \App\Repository\ActorRepository           $actorRepository Actor repository
     * @param \Knp\Component\Pager\PaginatorInterface   $paginator       Paginator
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     methods={"GET"},
     *     name="actor_index",
     * )
     */
    public function index(Request $request, ActorRepository $actorRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $actorRepository->queryAll(),
            $request->query->getInt('page', 1),
            ActorRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render(
            'actor/index.html.twig',
            ['pagination' => $pagination]
        );
    }

    /**
     * Show action.
     *
     * @param \App\Entity\Actor $actor Actor entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET"},
     *     name="actor_show",
     *     requirements={"id": "[0-9]\d*"},
     * )
     */
    public function show(Actor $actor): Response
    {
        return $this->render(
            'actor/show.html.twig',
            ['actor' => $actor]
        );
    }
}
