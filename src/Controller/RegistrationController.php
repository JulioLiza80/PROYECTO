<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RequestVerifyUserEmailFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $emailVerifiedMessage1 = null;
        $emailVerifiedMessage2 = null;
        $showForm = true;

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();
            /** @var string $passwordConfirm */
            $passwordConfirm = $form->get('passwordConfirm')->getData();  // Get password confirm

            // Validate that passwords match
            if ($plainPassword !== $passwordConfirm) {
                $this->addFlash('error', 'Las contraseñas no coinciden');
                return $this->redirectToRoute('app_register');
            }

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('opticanovaproyecto@gmail.com', 'Nova Opticos'))
                    ->to((string) $user->getEmail())
                    ->subject('Confirma tu email en Nova Opticos')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // do anything else you need here, like send an email

            // If the user is registered successfully, show a message to verify the email
            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(),
                'showForm' => false,
                'emailVerifiedMessage1' => 'Se ha enviado un email de verificación a la cuenta de correo electrónico indicada.',
                'emailVerifiedMessage2' => 'Por favor, comprueba tu bandeja de entrada y verifica tu email antes de iniciar sesión.'
            ]);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
            'emailVerifiedMessage1' => $emailVerifiedMessage1,
            'emailVerifiedMessage2' => $emailVerifiedMessage2,
            'showForm' => $showForm
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->query->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Su email ha sido verificado.');

        return $this->redirectToRoute('app_home');
    }


    #[Route('/request-verify-email', name: 'app_request_verify_email')]
    public function requestVerifyUserEmail(Request $request,UserRepository $userRepository): Response {

        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(RequestVerifyUserEmailFormType::class);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // generar una URL firmada y enviarla por correo electrónico al usuario
            $user =  $userRepository->findOneByEmail($form->get('email')->getData());
            if ($user) {
                $this->emailVerifier->sendEmailConfirmation(
                    'app_verify_email',
                    $user,
                    (new TemplatedEmail())
                        ->from(new Address('opticanovaproyecto@gmail.com', 'Nova Opticos'))
                        ->to($user->getEmail())
                        ->subject('Confirma tu email en Nova Opticos')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );
                //Haz cualquier otra cosa que necesites aquí, como un mensaje flash.

                $this->addFlash('success', 'blabla.');
                return $this->redirectToRoute('app_home');
            } else {
                $this->addFlash('error',  'Email inconnu.');
            }
        }
        return $this->render('/registration/confirmation_page.html.twig', [
            'requestForm' => $form->createView(),
             ]);

        
    }
}
