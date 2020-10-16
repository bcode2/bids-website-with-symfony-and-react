<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\UserType;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
        Request $request,
        AuthenticationUtils $authenticationUtils,
        UserPasswordEncoderInterface $encoder,
        UserService $userService
    ): Response {

        if ($this->getUser()) {
            return $this->redirectToRoute('asset_list');
        }

        $user = $userService->findOneByEmail('bcode@protonmail.com');
        dump($encoder->isPasswordValid($user, '12345'));
        //$authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // dump($authenticationUtils);
        dump($request->isMethod('POST'));

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        dump($lastUsername);
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


    /* /**
      * @Route("login", name="user_login")
      *
      * @param Request $request
      *
      * @param AuthenticationUtils $authenticationUtils
      *
      * @return RedirectResponse|Response
      *//*
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('asset_list');
        }

        $form = $this->createForm(
            LoginForm::class,
            [
                'last_username' => $authenticationUtils->getLastUsername(),
            ]
        );

        dump( $authenticationUtils->getLastAuthenticationError());

        return $this->render(
            'user/login.html.twig',
            [
                'form' => $form->createView(),
                'error' => $authenticationUtils->getLastAuthenticationError(),
            ]
        );
    }*/

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
}
