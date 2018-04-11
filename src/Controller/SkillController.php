<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Skill;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SkillType;
use App\Entity\SkillLevel;
use Symfony\Component\HttpFoundation\Response;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $skills = $this->getDoctrine()->getManager()->getRepository(Skill::class)->findAll();
        return $this->render('skill/index.html.twig', [
            'skills' => $skills,
        ]);
    }

    public function new(Request $request)
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill, array(
            'action' => $this->generateUrl('skill_new'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            if ($request->isXmlHttpRequest()) {
                return $this->json(array(
                    'value' => $skill->getId(),
                    'text' => $skill->getName(),
                ));
            }
            $this->addFlash('success', $this->get('translator')->trans('skill.success.created', array('%name%' => $skill->getName()), 'flash'));
            return $this->redirectToRoute('skill_index');
        }

        return $this->render('skill/new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    public function show(Skill $skill, Request $request)
    {
        return $this->render('skill/view.html.twig', array(
            'skill' => $skill,
        ));
    }

    public function edit(Skill $skill, Request $request)
    {
        $form = $this->createForm(SkillType::class, $skill);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('skill.success.edited', array('%name%' => $skill->getName()), 'flash'));
            return $this->redirectToRoute('skill_index');
        }

        return $this->render('skill/edit.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
            'delete_form' => $this->createDeleteForm($skill)->createView(),
        ));
    }

    private function createDeleteForm(Skill $skill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('skill_delete', array('id' => $skill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function delete(Skill $skill, Request $request)
    {
        $form = $this->createDeleteForm($skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush();
            $this->addFlash('success', $this->get('translator')->trans('skill.success.deleted', array(), 'flash'));
        } else {
            $this->addFlash('success', $this->get('translator')->trans('skill.error.deleted', array(), 'flash'));
        }

        return $this->redirectToRoute('skill_index');
    }

    public function change(SkillLevel $skill, $change)
    {
        $level = $skill->getLevel();

        if ($level + $change > 0) {
            $skill->setLevel($level + $change);
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush();
            $response = new Response($skill->getLevel());
        } else {
            $response = new Response(null, Response::HTTP_NO_CONTENT);
        }

        return $response;
    }
}
