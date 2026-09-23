<?php

namespace App\Controller;

use App\Entity\CustomerOrder;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $user = $this->getUser();
        $orders = $user->getCustomerOrders();

        $form = $this->createForm(ProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Vos informations ont été mises à jour.');

            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/index.html.twig', [
            'user' => $user,
            'orders' => $orders,
            'profileForm' => $form,
        ]);
    }

    #[Route('/account/order/{id}/cancel', name: 'app_account_order_cancel', methods: ['POST'])]
    public function cancelOrder(
        CustomerOrder $order,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($order->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($order->getStatus() !== 'en attente') {
            $this->addFlash('error', 'Cette commande ne peut plus être annulée.');

            return $this->redirectToRoute('app_account');
        }

        if (!$this->isCsrfTokenValid(
            'cancel-order-'.$order->getId(),
            $request->request->get('_token')
        )) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $order->setStatus('annulée');
        $entityManager->flush();

        $this->addFlash('success', 'Votre commande a été annulée.');

        return $this->redirectToRoute('app_account');
    }
}