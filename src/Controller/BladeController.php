<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Blade;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BladeType;
use App\Form\BladeSearchType;
use Symfony\Component\HttpFoundation\Response;

class BladeController extends Controller
{
    public function index(Request $request)
    {
        $blades = $this->getDoctrine()->getManager()->getRepository(Blade::class)->findAll();
        return $this->render('blade/index.html.twig', [
            'blades' => $blades,
        ]);
    }

    public function new(Request $request)
    {
        $blade = new Blade();
        $form = $this->createForm(BladeType::class, $blade);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blade);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('blade.success.created', array('%name%' => $blade->getName()), 'flash'));
            return $this->redirectToRoute('blade_index');
        }

        return $this->render('blade/new.html.twig', array(
            'blade' => $blade,
            'form' => $form->createView(),
        ));
    }

    public function show(Blade $blade, Request $request)
    {
        return $this->render('blade/show.html.twig', array(
            'blade' => $blade,
            'delete_form' => $this->createDeleteForm($blade)->createView(),
        ));
    }

    public function edit(Blade $blade, Request $request)
    {
        $form = $this->createForm(BladeType::class, $blade);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blade);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('blade.success.edited', array('%name%' => $blade->getName()), 'flash'));
            return $this->redirectToRoute('blade_index');
        }

        return $this->render('blade/edit.html.twig', array(
            'blade' => $blade,
            'form' => $form->createView(),
            'delete_form' => $this->createDeleteForm($blade)->createView(),
        ));
    }

    public function trust(Blade $blade)
    {
        if ($blade->getTrustLevel() < 16) {
            $blade->setTrustLevel($blade->getTrustLevel() + 1);
            $this->getDoctrine()->getManager()->flush();
            $response = new Response($this->get('translator')->trans('blade.trustLevels.' . $blade->getTrustLevel()));
        } else {
            $response = new Response(null, Response::HTTP_NO_CONTENT);
        }
        return $response;
    }

    private function createDeleteForm(Blade $blade)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blade_delete', array('id' => $blade->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function delete(Blade $blade, Request $request)
    {
        $form = $this->createDeleteForm($blade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blade);
            $em->flush();
            $this->addFlash('success', $this->get('translator')->trans('blade.success.deleted', array(), 'flash'));
        } else {
            $this->addFlash('danger', $this->get('translator')->trans('blade.error.deleted', array(), 'flash'));
        }

        return $this->redirectToRoute('blade_index');
    }

    public function search(Request $request)
    {
        $blades = array();
        $form = $this->createForm(BladeSearchType::class)
            ->handleRequest($request);
        $nbCriteria = 0;
        if (count($request->query->get('blade_search', array()))) {
            $nbCriteria = count(array_filter(preg_split('`(^|\?|&).*?=`', $_SERVER['QUERY_STRING'])));
            $blades = $this->getDoctrine()->getManager()->getRepository(Blade::class)
                ->search($request->query->get('blade_search'));
            if (count($request->query->get('blade_search')['gender'])) {
                $nbCriteria -= count($request->query->get('blade_search')['gender']) - 1;
            }
        }
        return $this->render('blade/search.html.twig', [
            'blades' => $blades,
            'form'   => $form->createView(),
            'nb_criteria' => $nbCriteria,
        ]);
    }
}
