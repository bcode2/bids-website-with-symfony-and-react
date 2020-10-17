<?php

namespace App\Controller;

use App\Entity\Asset;
use App\Form\AssetType;
use App\Services\AssetService;
use AppBundle\Provider\Model\MessageList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


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
     * @param Security $security
     *
     * @return Response
     */
    public function indexAction(Security $security): Response
    {
        $em = $this->getDoctrine()->getManager();
        $assets = $em->getRepository('App:Asset')->findAll();
        //dump($assets[0]->getBids()->count());
        //dump($assets[0]->getBids()[0]->getUser()->getName());

        //$result=[];
        $costs = [];
        $bidArray = $assets[0]->getBids()->toArray();
        // dump($bidArray);

        $user = $security->getUser();
        dump($user);
        foreach ($bidArray as $bid) {
            array_push($costs, $bid->getBidAmount());
        }

        $result = array_column($assets[0]->getBids()->toArray(), 'bidAmount');

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
     * @param AssetService $assetService
     * @IsGranted("ROLE_ADMIN")
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request, AssetService $assetService)
    {
        $asset = new Asset();
        $form = $this->createAssetForm($asset);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assetService->create($asset);

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
     * @IsGranted("ROLE_ADMIN")
     * @param AssetService $assetService
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Asset $asset, AssetService $assetService)
    {
        $deleteForm = $this->createDeleteForm($asset);
        $editForm = $this->createForm(AssetType::class, $asset);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $assetService->update();
            $this->addFlash('success', 'La subasta ha sido actualizada correctamente');

            return $this->redirectToRoute('asset_edit', ['id' => $asset->getId()]);
        }

        return $this->render(
            'asset/edit.html.twig',
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
     * @param int $id
     * @IsGranted("ROLE_ADMIN")
     * @param AssetService $assetService
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, int $id, AssetService $assetService): RedirectResponse
    {
        $entity = $assetService->findOneById($id);

        if (!$entity) {
            $this->addFlash('warning', 'La subasta que desea borrar no existe');

            return $this->redirectToRoute('asset_list');
        }

        $assetService->delete($entity);
        $this->addFlash('success', 'La subasta ha sido borrada correctamente');

        return $this->redirectToRoute('asset_list');
    }

    /**
     * Creates a form to delete an Asset entity.
     *
     * @param Asset $asset The Asset entity
     *
     * @return FormInterface The form
     */
    private function createDeleteForm(Asset $asset): FormInterface
    {
        return $this->createFormBuilder()->setAction($this->generateUrl('asset_delete', ['id' => $asset->getId()]))->setMethod('DELETE')->getForm();
    }

    /**
     * @param Asset $asset
     *
     * @return FormInterface
     */
    private function createAssetForm(Asset $asset): FormInterface
    {
        return $this->createForm(
            AssetType::class,
            $asset,
            [
                'action' => $this->generateUrl('asset_new'),
                'method' => 'POST',
            ]
        );
    }
}
