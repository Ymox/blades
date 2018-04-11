<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Element;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ElementType;

class ElementController extends Controller
{
    public function index(Request $request)
    {
        $elements = $this->getDoctrine()->getManager()->getRepository(Element::class)->findAll();
        return $this->render('element/index.html.twig', [
            'elements' => $elements,
        ]);
    }

    public function new(Request $request)
    {
        $element = new Element();
        $form = $this->createForm(ElementType::class, $element);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('element.success.created', array('%name%' => $element->getName()), 'flash'));
            return $this->redirectToRoute('element_index');
        }

        return $this->render('element/new.html.twig', array(
            'element' => $element,
            'form' => $form->createView(),
        ));
    }

    public function show(Element $element, Request $request)
    {
        return $this->render('element/show.html.twig', array(
            'element' => $element,
            'delete_form' => $this->createDeleteForm($element)->createView(),
        ));
    }

    public function edit(Element $element, Request $request)
    {
        $form = $this->createForm(ElementType::class, $element);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($element);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('element.success.edited', array('%name%' => $element->getName()), 'flash'));
            return $this->redirectToRoute('element_index');
        }

        return $this->render('element/edit.html.twig', array(
            'element' => $element,
            'form' => $form->createView(),
            'delete_form' => $this->createDeleteForm($element)->createView(),
        ));
    }

    private function createDeleteForm(Element $element)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('element_delete', array('id' => $element->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function delete(Element $element, Request $request)
    {
        $form = $this->createDeleteForm($element);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($element);
            $em->flush();
            $this->addFlash('success', $this->get('translator')->trans('element.success.deleted', array(), 'flash'));
        } else {
            $this->addFlash('danger', $this->get('translator')->trans('element.error.deleted', array(), 'flash'));
        }

        return $this->redirectToRoute('element_index');
    }
}
