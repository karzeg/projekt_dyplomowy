<?php
/**
 * Comment controller.
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Musical;
use App\Entity\User;
use App\Form\CommentType;
use App\Service\CommentService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommentController.
 *
 * @IsGranted("ROLE_USER")
 */
class CommentController extends AbstractController
{
    /**
     * Comment service.
     *
     * @var \App\Service\CommentService
     */
    private $commentService;

    /**
     * CommentController constructor.
     *
     * @param \App\Service\CommentService $commentService Comment service
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Create action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Musical                       $musical Musical entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/dodaj-komentarz/{id}",
     *     methods={"GET", "POST"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="dodaj-komentarz",
     * )
     */
    public function create(Request $request, Musical $musical): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setMusical($musical);
            $comment->setAuthor($this->getUser());
            $comment->setDate(new \DateTime());
            $this->commentService->save($comment);
            $this->addFlash('success', 'comment_created_successfully');

            return $this->redirectToRoute('musical_show', ['id' => $musical->getId()]);
        }

        return $this->render(
            'comment/create.html.twig',
            [
                'form' => $form->createView(),
                'musical' => $musical->getId(),
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Comment                       $comment Comment entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/comment-delete/{id}",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="comment_delete",
     * )
     */
    public function delete(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(FormType::class, $comment, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if (!$form->isSubmitted() && $request->isMethod('DELETE')) {
            $form->submit($request->request->get($form->getName()));
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'message_comment_deleted_successfully');
            $this->commentService->delete($comment);
            $musical = $comment->getMusical();

            return $this->redirectToRoute('musical_show', ['id' => $musical->getId()]);
        }

        return $this->render(
            'comment/delete.html.twig',
            [
                'form' => $form->createView(),
                'comment' => $comment,
                'musical' => $comment->getMusical()->getId(),
            ]
        );
    }
}
