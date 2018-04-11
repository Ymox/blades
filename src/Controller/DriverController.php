<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Driver;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DriverType;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $drivers = $this->getDoctrine()->getManager()->getRepository(Driver::class)->findAll();
        return $this->render('driver/index.html.twig', [
            'drivers' => $drivers,
        ]);
    }

    public function new(Request $request)
    {
        $driver = new Driver();
        $form = $this->createForm(DriverType::class, $driver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('driver.success.created', array('%name%' => $driver->getName()), 'flash'));
            return $this->redirectToRoute('driver_index');
        }

        return $this->render('driver/new.html.twig', array(
            'driver' => $driver,
            'form' => $form->createView(),
        ));
    }

    public function show(Driver $driver, Request $request)
    {
        return $this->render('driver/show.html.twig', array(
            'driver' => $driver,
            'delete_form' => $this->createDeleteForm($driver)->createView(),
        ));
    }

    public function edit(Driver $driver, Request $request)
    {
        $form = $this->createForm(DriverType::class, $driver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('driver.success.edited', array('%name%' => $driver->getName()), 'flash'));
            return $this->redirectToRoute('driver_index');
        }

        return $this->render('driver/edit.html.twig', array(
            'driver' => $driver,
            'form' => $form->createView(),
            'delete_form' => $this->createDeleteForm($driver)->createView(),
        ));
    }

    private function createDeleteForm(Driver $driver)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('driver_delete', array('id' => $driver->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function delete(Driver $driver, Request $request)
    {
        $form = $this->createDeleteForm($driver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($driver);
            $em->flush();
            $this->addFlash('success', $this->get('translator')->trans('driver.success.deleted', array(), 'flash'));
        } else {
            $this->addFlash('success', $this->get('translator')->trans('driver.error.deleted', array(), 'flash'));
        }

        return $this->redirectToRoute('driver_index');
    }
}
