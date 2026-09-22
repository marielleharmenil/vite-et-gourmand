<?php

namespace App\Controller;

use App\Entity\CustomerOrder;
use App\Repository\CustomerOrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/employee')]
#[IsGranted('ROLE_EMPLOYEE')]
class EmployeeController extends AbstractController
{
    #[Route('/orders', name: 'app_employee_orders', methods: ['GET'])]
    public function orders(CustomerOrderRepository $orderRepository): Response
    {
        return $this->render('employee/index.html.twig', [
            'orders' => $orderRepository->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/orders/{id}/status', name: 'app_employee_order_status', methods: ['POST'])]
    public function updateStatus(
        CustomerOrder $order,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if (!$this->isCsrfTokenValid(
            'order-status-' . $order->getId(),
            (string) $request->request->get('_token')
        )) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $allowedStatuses = [
            'en attente',
            'acceptée',
            'en préparation',
            'en livraison',
            'livrée',
            'en attente de matériel',
            'terminée',
        ];

        $status = (string) $request->request->get('status');

        if (!in_array($status, $allowedStatuses, true)) {
            $this->addFlash('error', 'Statut invalide.');

            return $this->redirectToRoute('app_employee_orders');
        }

        $order->setStatus($status);
        $entityManager->flush();

        $this->addFlash('success', 'Statut de la commande mis à jour.');

        return $this->redirectToRoute('app_employee_orders');
    }
}