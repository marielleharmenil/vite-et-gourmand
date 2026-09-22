<?php

namespace App\Controller;

use App\Entity\CustomerOrder;
use App\Entity\Menu;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    #[Route('/commander/{id}', name: 'app_order', methods: ['GET', 'POST'])]
    public function order(
        Menu $menu,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        /** @var User $user */
        $user = $this->getUser();

        $error = null;

        if ($request->isMethod('POST')) {
            if (($menu->getStock() ?? 0) <= 0) {
    $error = 'Ce menu n’est plus disponible à la commande.';
            }
            if (!$this->isCsrfTokenValid(
                'order_menu_' . $menu->getId(),
                (string) $request->request->get('_token')
            )) {
                throw $this->createAccessDeniedException('Jeton CSRF invalide.');
            }

            $people = (int) $request->request->get('people');
            $deliveryAddress = trim((string) $request->request->get('deliveryAddress'));
            $deliveryPostalCode = trim((string) $request->request->get('deliveryPostalCode'));
            $deliveryCity = trim((string) $request->request->get('deliveryCity'));
            $distanceKm = max(0, (float) $request->request->get('distanceKm'));

            $deliveryDateValue = (string) $request->request->get('deliveryDate');
            $deliveryTimeValue = (string) $request->request->get('deliveryTime');

            if (
                $people < $menu->getMinPeople()
                || $deliveryAddress === ''
                || $deliveryPostalCode === ''
                || $deliveryCity === ''
                || $deliveryDateValue === ''
                || $deliveryTimeValue === ''
            ) {
                $error = 'Merci de compléter tous les champs et de respecter le nombre minimum de personnes.';
            } else {
                try {
                    $deliveryDate = new \DateTime($deliveryDateValue);
                    $deliveryTime = new \DateTime($deliveryTimeValue);
                } catch (\Exception) {
                    $deliveryDate = null;
                    $deliveryTime = null;
                    $error = 'La date ou l’heure de livraison est invalide.';
                }

            if ($deliveryDate && $deliveryTime && !$error) {
                $deliveryDateTime = new \DateTime(
                $deliveryDate->format('Y-m-d') . ' ' . $deliveryTime->format('H:i:s')
                );

            $minimumDeliveryDate = new \DateTime('+48 hours');

            if ($deliveryDateTime < $minimumDeliveryDate) {
                $error = 'La commande doit être passée au minimum 48 heures avant la livraison.';
                    }
                }

            if ($error === null) {
                $isBordeaux = mb_strtolower(trim($deliveryCity)) === 'bordeaux';

            if (!$isBordeaux && $distanceKm <= 0) {
                $error = 'Pour une livraison hors Bordeaux, merci d’indiquer une distance supérieure à 0 km.';
                    }
                }

                if ($error === null && $deliveryDate !== null && $deliveryTime !== null) {
                    /*
                     * Le prix du menu correspond au nombre minimum de personnes.
                     * On calcule donc un prix proportionnel pour le nombre demandé.
                     */
                    $baseMenuPrice = (float) $menu->getPrice();
                    $pricePerPerson = $baseMenuPrice / $menu->getMinPeople();
                    $menuPrice = round($pricePerPerson * $people, 2);

                    /*
                     * CDC : réduction de 10 % lorsque la commande compte
                     * au moins 5 personnes de plus que le minimum du menu.
                     */
                    $discount = 0.0;

                    if ($people >= ($menu->getMinPeople() + 5)) {
                        $discount = round($menuPrice * 0.10, 2);
                    }

                    /*
                     * Livraison : 5 € de base.
                     * Hors Bordeaux, ajout de 0,59 € par kilomètre.
                     */
                    $isBordeaux = mb_strtolower(trim($deliveryCity)) === 'bordeaux';
                
                    $deliveryFee = 5.0;

                    if (!$isBordeaux) {
                        $deliveryFee += round($distanceKm * 0.59, 2);
                    }

                    $totalPrice = round($menuPrice - $discount + $deliveryFee, 2);

                    $order = new CustomerOrder();
                    $order->setUser($user);
                    $order->setMenu($menu);
                    $order->setPeople($people);
                    $order->setDeliveryDate($deliveryDate);
                    $order->setDeliveryTime($deliveryTime);
                    $order->setDeliveryAddress($deliveryAddress);
                    $order->setDeliveryPostalCode($deliveryPostalCode);
                    $order->setDeliveryCity($deliveryCity);
                    $order->setDistanceKm($distanceKm);
                    $order->setMenuPrice($menuPrice);
                    $order->setDiscount($discount);
                    $order->setDeliveryFee($deliveryFee);
                    $order->setTotalPrice($totalPrice);
                    $order->setStatus('en attente');

                    $entityManager->persist($order);
                    $menu->setStock($menu->getStock() - 1);
                    $entityManager->flush();

                    $this->addFlash(
                        'success',
                        sprintf(
                            'Commande enregistrée. Total : %.2f €',
                            $totalPrice
                        )
                    );

                    return $this->redirectToRoute('app_order_success', [
                        'id' => $order->getId(),
                    ]);
                }
            }
        }

        return $this->render('order/index.html.twig', [
            'menu' => $menu,
            'user' => $user,
            'error' => $error,
        ]);
    }

    #[Route('/commande/confirmation/{id}', name: 'app_order_success', methods: ['GET'])]
    public function success(CustomerOrder $order): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($order->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('order/success.html.twig', [
            'order' => $order,
        ]);
    }
}