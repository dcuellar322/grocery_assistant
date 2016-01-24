<?php

namespace AppBundle\Controller;

use AppBundle\Form\ItemType;
use AppBundle\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ItemController extends Controller {
	/**
	 * @Route("/items", name="list_items")
	 */
	public function listAction(Request $request) {
		$items = $this->getDoctrine()->getManager()->getRepository('AppBundle:Item')->findAll();
		
		return $this->render('item/list.html.twig', array (
				'items' => $items 
		));
	}
	
	/**
	 * @Route("/item/add", name="add_item")
	 */
	public function addAction(Request $request) {
		$item = new Item();
		$form = $this->createForm(ItemType::class, $item);
		$form = $form->add('category', ChoiceType::class,
						['choices' => $this->getDoctrine()->getManager()->getRepository('AppBundle:Category')
								->findAllOrderedByName(),
						'choices_as_values' => true,
						'choice_label' => function ($category, $key, $index) {
							return $category->getName();
						}]);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($item);
			$em->flush();
			
			$this->addFlash(
					'notice',
					'Item was added!'
					);
			
			return $this->redirectToRoute('list_items');
		}
		
		return $this->render('item/add.html.twig', array (
				'form' => $form->createView() 
		));
	}
}