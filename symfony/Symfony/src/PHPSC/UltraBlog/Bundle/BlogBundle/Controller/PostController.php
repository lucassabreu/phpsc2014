<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PHPSC\UltraBlog\Bundle\BlogBundle\Controller;

use Doctrine\ORM\EntityManager;
use PHPSC\UltraBlog\Bundle\BlogBundle\Entity\Post;
use PHPSC\UltraBlog\Bundle\BlogBundle\Form\PostType;
use PHPSC\UltraBlog\Repository\PostRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PostController
 *
 * @author Lucas dos Santos Abreu <lucas.s.abreu@gmail.com>
 */
class PostController extends Controller {

    /** @return PostRepositoryInterface $repository */
    protected function getRepository() {
        return $this->getDoctrine()->getRepository("PHPSCUltraBlogBundle:Post");
    }

    public function listAction() {
        $repository = $this->getRepository();

        return $this->render('PHPSCUltraBlogBundle:Post:list.html.twig', array(
            'posts' => $repository->findLatestThree(),
        ));
    }

    public function showAction($id) {
        $repository = $this->getRepository();

        $post = $repository->find($id);

        if (is_null($post)) {
            $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('post.does_not_exist'));
            throw $this->createNotFoundException();
        }

        return $this->render('PHPSCUltraBlogBundle:Post:show.html.twig', array(
            'post' => $post,
        ));
    }

    public function newAction(Request $request) {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                /** @var EntityManager $em */
                $em = $this->get('doctrine.orm.entity_manager');

                $em->persist($post);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notice', $this->get('translator')->trans('post.form.success'));
                return $this->redirect($this->generateUrl("phpsc_ultra_blog_post_list"));
            }
        }

        return $this->render('PHPSCUltraBlogBundle:Post:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id) {
        $repository = $this->getRepository();

        $post = $repository->find($id);

        if (is_null($post)) {
            $this->get('session')->getFlashBag()->add('error', $this->get('translator')->trans('post.does_not_exist'));
            throw $this->createNotFoundException();
        }

        /** @var EntityManager $em */
        $em = $this->get('doctrine.orm.entity_manager');

        $em->remove($post);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', $this->get('translator')->trans('post.delete_succefully'));

        return $this->redirect($this->generateUrl("phpsc_ultra_blog_post_list"));
    }

}
