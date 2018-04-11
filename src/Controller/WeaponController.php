<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Weapon;
use Symfony\Component\HttpFoundation\Request;
use App\Form\WeaponType;
use App\Entity\WeaponLevel;
use Symfony\Component\HttpFoundation\Response;

class WeaponController extends Controller
{
    public function index(Request $request)
    {
        $weapons = $this->getDoctrine()->getManager()->getRepository(Weapon::class)->findAll();
        return $this->render('weapon/index.html.twig', [
            'weapons' => $weapons,
        ]);
    }

    public function new(Request $request)
    {
        $weapon = new Weapon();
        $form = $this->createForm(WeaponType::class, $weapon, array(
            'action' => $this->generateUrl('weapon_new'),
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weapon);
            $em->flush();

            if ($request->isXmlHttpRequest()) {
                return $this->json(array(
                    'value' => $weapon->getId(),
                    'text' => $weapon->getName(),
                ));
            }
            $this->addFlash('success', $this->get('translator')->trans('weapon.success.created', array('%name%' => $weapon->getName()), 'flash'));
            return $this->redirectToRoute('weapon_index');
        }

        return $this->render('weapon/new.html.twig', array(
            'weapon' => $weapon,
            'form' => $form->createView(),
        ));
    }

    public function show(Weapon $weapon, Request $request)
    {
        return $this->render('weapon/view.html.twig', array(
            'weapon' => $weapon,
        ));
    }

    public function edit(Weapon $weapon, Request $request)
    {
        $form = $this->createForm(WeaponType::class, $weapon);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($weapon);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('weapon.success.edited', array('%name%' => $weapon->getName()), 'flash'));
            return $this->redirectToRoute('weapon_index');
        }

        return $this->render('weapon/edit.html.twig', array(
            'weapon' => $weapon,
            'form' => $form->createView(),
            'delete_form' => $this->createDeleteForm($weapon)->createView(),
        ));
    }

    private function createDeleteForm(Weapon $weapon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('weapon_delete', array('id' => $weapon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function delete(Weapon $weapon, Request $request)
    {
        $form = $this->createDeleteForm($weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($weapon);
            $em->flush();
            $this->addFlash('success', $this->get('translator')->trans('weapon.success.deleted', array(), 'flash'));
        } else {
            $this->addFlash('success', $this->get('translator')->trans('weapon.error.deleted', array(), 'flash'));
        }

        return $this->redirectToRoute('weapon_index');
    }

    public function change(WeaponLevel $weapon, $item, $change)
    {
        $levels = $weapon->getArts();

        if (!empty($levels[$item]) && $levels[$item] + $change > 0) {
            $weapon->setArt($item, $levels[$item] + $change);
            $em = $this->getDoctrine()->getManager();
            $em->persist($weapon);
            $em->flush();
            $response = new Response($levels[$item] + $change);
        } else {
            $response = new Response(null, Response::HTTP_NO_CONTENT);
        }

        return $response;
    }
}
