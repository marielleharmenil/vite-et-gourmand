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
    public function orders(
        CustomerOrderRepository $orderRepository,
        Request $request
    ): Response {
        $orders = $orderRepository->findBy([], ['createdAt' => 'DESC']);

        $statusFilter = trim((string) $request->query->get('status'));
        $clientFilter = mb_strtolower(trim((string) $request->query->get('client')));

        if ($statusFilter !== '') {
            $orders = array_filter(
                $orders,
                static fn (CustomerOrder $order): bool =>
                    $order->getStatus() === $statusFilter
            );
        }

        if ($clientFilter !== '') {
            $orders = array_filter(
                $orders,
                static function (CustomerOrder $order) use ($clientFilter): bool {
                    $user = $order->getUser();

                    $searchableClient = mb_strtolower(
                        $user->getFirstName() . ' ' .
                        $user->getLastName() . ' ' .
                        $user->getEmail()
                    );

                    return str_contains($searchableClient, $clientFilter);
                }
            );
        }

        return $this->render('employee/index.html.twig', [
            'orders' => $orders,
            'statusFilter' => $statusFilter,
            'clientFilter' => (string) $request->query->get('client'),
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