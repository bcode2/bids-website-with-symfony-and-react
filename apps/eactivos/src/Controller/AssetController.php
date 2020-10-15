<?php

namespace App\Controller;

use App\Entity\Asset;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Asset controller.
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("admin/Asset")
 */
class AssetController extends AbstractController
{
    /**
     * Lists all Asset entities.
     *
     * @Route("/", name="Asset_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Assets = $em->getRepository('AppBundle:Asset')->findAll();

        return $this->render('Asset/list.html.twig', array(
            'Assets' => $Assets,
        ));
    }

    /**
     * Creates a new Asset entity.
     *
     * @Route("/new", name="Asset_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $Asset = new Asset();
        $form = $this->createForm('AppBundle\Form\AssetType', $Asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Asset);
            $em->flush();

            return $this->redirectToRoute('Asset_show', array('id' => $Asset->getId()));
        }

        return $this->render('Asset/new.html.twig', array(
            'Asset' => $Asset,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays an Asset entity.
     *
     * @Route("/{id}", name="Asset_show")
     * @Method("GET")
     */
    public function showAction(Asset $Asset)
    {
        $deleteForm = $this->createDeleteForm($Asset);

        return $this->render('Asset/show.html.twig', array(
            'Asset' => $Asset,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Asset entity.
     *
     * @Route("/{id}/edit", name="Asset_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Asset $Asset)
    {
        $deleteForm = $this->createDeleteForm($Asset);
        $editForm = $this->createForm('AppBundle\Form\AssetType', $Asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Asset_edit', array('id' => $Asset->getId()));
        }

        return $this->render('Asset/edit.html.twig', array(
            'Asset' => $Asset,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Asset entity.
     *
     * @Route("/{id}/delete", name="Asset_delete")
     * @Method("DELETE,POST,GET")
     */
    public function deleteAction(Request $request, Asset $Asset)
    {
        /* check this  funtion  why is not  validating the form  DONT FORGET IT CARLOS*/
        $form = $this->createDeleteForm($Asset);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->remove($Asset);
        try {
            $em->flush();
            return $this->redirectToRoute('Asset_list');
        } catch (\Exception $e) {
            $logger = $this->get('logger');
            $error= "Ha intentado  eliminar una subasta";
            $logger->error( $error);
            /*OENDIENTE  LE PREGUNTE A XAVI COMO  PASO  ESTA VARIABLE A LA OTRA RUTA  ¿POR GET PODRIA?*/
            return $this->redirectToRoute('Asset_list');
        }
    }

    /**
     * Creates a form to delete a Asset entity.
     *
     * @param Asset $Asset The Asset entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Asset $Asset)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Asset_delete', array('id' => $Asset->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
