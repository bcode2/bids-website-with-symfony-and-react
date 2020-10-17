<?php

namespace App\Controller;

use App\Services\BidService;
use AppBundle\Provider\Model\MessageList;
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
        $this->addFlash('success', 'Su puja ha sido borrada correctamente');

        return $this->redirectToRoute('asset_list');
    }
}
