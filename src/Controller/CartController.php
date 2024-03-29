<?php
 
namespace App\Controller;
 
use App\Classes\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
 
class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/cart", name="app_cart")
     */
    public function index(RequestStack $stack): Response
    {
        $cart = $stack->getSession()->get('cart', []);
        $cartComplete = [];

        foreach($cart as $id => $quantity){
            $cartComplete[] = [
                'product' => $this->entityManager->getRepository(Product::class)->findOneById($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cartComplete
        ]);
    }
 
    /**
     * @Route("/cart/add/{id}", name="app_add_to_cart")
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
 
       return $this->redirectToRoute('app_cart');
    }
 
    /**
     * @Route("/cart/remove", name="app_remove_my_cart")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();
 
        return $this->redirectToRoute('app_products');
    }
 
}