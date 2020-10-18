<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\UserType;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


/**
 * User controller.
 *
 * @Route("user/")
 */
class UserController extends AbstractController
{
    /**
     * @Route("login", name="user_login",methods={"POST","GET"})
     * @param Request $request
     *
     * @param AuthenticationUtils $authenticationUtils
     * @param UserPasswordEncoderInterface $encoder
     *
     * @param UserService $userService
     *
     * @return Response
     */
    public function loginAction(
        AuthenticationUtils $authenticationUtils,
        UserPasswordEncoderInterface $encoder,
        UserService $userService
    ): Response {

        if ($this->getUser()) {
            return $this->redirectToRoute('asset_list');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(
            LoginForm::class,
            [
                'last_username' => $lastUsername,
                'error' => $error,
            ]
        );

        return $this->render(
            'user/login.html.twig',
            [
                'form' => $form->createView(),
                'error' => $error,
            ]
        );
    }

    /**
     * @Route("logout", name="user_logout",methods={"GET"})
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function logoutAction(Request $request): RedirectResponse
    {
        $this->get('security.token_storage')->setToken(null);
        $this->addFlash('success', 'Se ha deslogeado correctamente');

        return $this->redirectToRoute('asset_list');
    }

    /**
     * @Route("register", name="user_registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @param UserService $userService
     *
     * @return Response
     */
    public function registerAction(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        UserService $userService
    ): Response {
        $user = new User();
        $user->setIsAdmin();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->addFlash('error', 'Ha habido un error al procesar su solicitud de alta');

            return $this->render(
                'user/registro.html.twig',
                ['form' => $form->createView()]
            );
        }

        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $this->addFlash('success', 'Se ha dado de alta correctamente en el sistema');
        $userService->create($user);

        return $this->redirectToRoute('asset_list');
    }

    /**
     *
     * @Route("ajax-bids-count", name="user_bids_by_ajax", methods={"POST","GET"})
     *
     * @param UserInterface $user
     *
     * @return JsonResponse
     */
    public function countUserBids(UserInterface $user): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->headers->set('Access-Control-Allow-Origin', '*');
        $jsonResponse->setData($user->getBids()->count());

        return $jsonResponse;
    }
}
