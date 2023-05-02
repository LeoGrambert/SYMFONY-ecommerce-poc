<?php
 
namespace App\Classes;
 
use Symfony\Component\HttpFoundation\RequestStack;
 
class Cart
{
    private $stack;
 
    public function __construct(RequestStack $stack)
    {
        return $this->stack = $stack;
    }
 
    public function add($id)
    {
        $session = $this->stack->getSession();
        $cart = $session->get('cart', []);
 
        if(!empty($cart[$id])){
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
 
        $session->set('cart', $cart);
    }
 
    public function get()
    {
        return $this->stack->getSession()->get('cart');
    }
 
    public function remove()
    {
        return $this->stack->getSession()->remove('cart');
    }
}