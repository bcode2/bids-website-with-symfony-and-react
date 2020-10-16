<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Asset controller.
 * @Route("asset")
 */
class AssetController extends AbstractController
{
    /**
     * Lists all Asset entities.
     *
     * @Route("/list", name="asset_list",methods={"GET"})
     */
    public function indexAction(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $assets = $em->getRepository('App:Asset')->findAll();

        return $this->render(
            'asset/list.html.twig',
            [
                'assets' => $assets,
            ]
        );
    }

    /**
     * Creates a new Asset entity.
     *
     * @Route("/new", name="asset_new")
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $asset = new Asset();
        $form = $this->createForm(AssetType::class, $asset);
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
     * @param Asset $asset
     *
     * @return Response
     */
    public function showAction(Asset $asset): Response
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
     * @param Request $request
     * @param Asset $asset
     *
     * @return RedirectResponse|Response
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
     * @param Request $request
     * @param Asset $asset
     *
     * @return RedirectResponse
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
            /* $logger = $this->get('logger');
             $error = "Ha intentado  eliminar una subasta";
             $logger->error($error);*/

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
        return $this->createFormBuilder()->setAction($this->generateUrl('asset_delete', ['id' => $asset->getId()]))->setMethod('DELETE')->getForm();
    }
}
