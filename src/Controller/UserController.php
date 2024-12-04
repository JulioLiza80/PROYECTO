<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    // public function show(User $user): Response
    // {
    //     return $this->render('user/show.html.twig', [
    //         'user' => $user,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {


        $form = $this->createForm(UserType::class, $user);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->flush();

            return $this->redirectToRoute('app_user_config', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('cuenta.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, TokenStorageInterface $tokenStorage, SessionInterface $session, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {

            // Eliminamos el token de autenticación y cerramos la sesión para que pueda redirigir a Inicio después de eliminar el usuario
            $tokenStorage->setToken(null);
            $session->invalidate();

            $entityManager->remove($user);
            $entityManager->flush();
        }


        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }

    // área personal
    // #[Route('/mi-cuenta', name: 'app_user_personal', methods: ['GET', 'POST'])]
    // public function ir_areaPersonal(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $activeTab = 'cuenta';
    //     $user = $this->getUser();
    //     $form = $this->createForm(UserType::class, $user);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_user_personal');
    //     }

    //     return $this->render('cuenta.html.twig', [
    //         'activeTab' => $activeTab,
    //         'user' => $user,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // Configuración
    #[Route('/configuracion', name: 'app_user_config', methods: ['GET'])]
    public function configuration(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activeTab = $request->query->get('activeTab', 'cuenta');
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_config');
        }
        return $this->render('configuracion.html.twig', [
            'activeTab' => $activeTab,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
