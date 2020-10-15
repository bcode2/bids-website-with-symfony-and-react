<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Asset controller.
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("admin/asset")
 */
class AssetController extends AbstractController
{
    /**
     * Lists all Asset entities.
     *
     * @Route("/", name="asset_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Assets = $em->getRepository('AppBundle:Asset')->findAll();

        return $this->render(
            'asset/list.html.twig',
            [
                'assets' => $Assets,
            ]
        );
    }

    /**
     * Creates a new Asset entity.
     *
     * @Route("/new", name="asset_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $asset = new Asset();
        $form = $this->createForm('AppBundle\Form\AssetType', $asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($asset);
            $em->flush();

            return $this->redirectToRoute('asset_show', ['id' => $asset->getId()]);
        }

        return $this->render(
            'asset/new.html.twig',
            [
                'asset' => $asset,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Finds and displays an Asset entity.
     *
     * @Route("/{id}", name="asset_show")
     * @Method("GET")
     */
    public function showAction(Asset $asset)
    {
        $deleteForm = $this->createDeleteForm($asset);

        return $this->render(
            'asset/show.html.twig',
            [
                'asset' => $asset,
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * Displays a form to edit an existing Asset entity.
     *
     * @Route("/{id}/edit", name="asset_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Asset $asset)
    {
        $deleteForm = $this->createDeleteForm($asset);
        $editForm = $this->createForm(AssetType::class, $asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('asset_edit', ['id' => $asset->getId()]);
        }

        return $this->render(
            'Asset/edit.html.twig',
            [
                'asset' => $asset,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ]
        );
    }

    /**
     * Deletes a Asset entity.
     *
     * @Route("/{id}/delete", name="asset_delete")
     * @Method("DELETE,POST,GET")
     */
    public function deleteAction(Request $request, Asset $asset)
    {
        /* check this  funtion  why is not  validating the form  DONT FORGET IT CARLOS*/
        $form = $this->createDeleteForm($asset);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->remove($asset);
        try {
            $em->flush();

            return $this->redirectToRoute('asset_list');
        } catch (\Exception $e) {
            $logger = $this->get('logger');
            $error = "Ha intentado  eliminar una subasta";
            $logger->error($error);

            return $this->redirectToRoute('asset_list');
        }
    }

    /**
     * Creates a form to delete a Asset entity.
     *
     * @param Asset $asset The Asset entity
     *
     * @return FormInterface The form
     */
    private function createDeleteForm(Asset $asset): FormInterface
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('Asset_delete', ['id' => $asset->getId()]))->setMethod('DELETE')->getForm();
    }
}
