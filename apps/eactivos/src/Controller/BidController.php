<?php

namespace App\Controller;

use App\Services\AssetService;
use App\Services\BidService;
use App\Services\UserService;
use AppBundle\Provider\Model\MessageList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Bid controller.
 * @Route("bid")
 */
class BidController extends AbstractController
{
    /**
     * Deletes a Bid entity.
     *
     * @Route("/{id}/delete", name="bid_delete")
     * @param Request $request
     * @param int $id
     * @param BidService $bidService
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, int $id, BidService $bidService): RedirectResponse
    {
        $entity = $bidService->findOneById($id);

        if (!$entity) {
            $this->addFlash('warning', 'La puja que desea borrar no existe');

            return $this->redirectToRoute('asset_list');
        }

        $bidService->delete($entity);
        $this->addFlash('success', "Su **ÚLTIMA** puja ha sido borrada correctamente");

        return $this->redirectToRoute('asset_list');
    }

    /**
     * Creates a new Bid entity.
     *
     * @Route("/new", name="bid_new")
     * @param Request $request
     *
     * @param BidService $bidService
     *
     * @param UserService $userService
     * @param AssetService $assetService
     *
     * @return RedirectResponse|Response
     * @IsGranted("ROLE_USER")
     */
    public function newAction(Request $request, BidService $bidService, UserService $userService, AssetService $assetService)
    {
        $asset = $assetService->findOneById($request->request->get('asset_id'));
        $user = $userService->findOneById($request->request->get('user_id'));
        $bidAmount = $request->request->get('bidAmount');

        if ($asset && $user && $bidAmount) {
            $bidService->createNewBid($asset, $user, $bidAmount);
            $this->addFlash('success', 'Su puja se ha registrado en el sistema');
        } else {
            $this->addFlash('success', 'Ha ocurrido un error. Inténtelo nuevamente');
        }

        return $this->redirectToRoute('asset_list');
    }
}
