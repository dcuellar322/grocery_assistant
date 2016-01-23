<?php

namespace AppBundle\Controller;

use AppBundle\Form\CategoryType;
use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller {
	/**
	 * @Route("/categories", name="list_categories")
	 */
	public function listAction(Request $request) {
		$categories = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category')->findAllOrderedByName();
		
		return $this->render('category/list.html.twig', array (
				'categories' => $categories 
		));
	}
	
	/**
	 * @Route("/category/add", name="add_category")
	 */
	public function addAction(Request $request) {
		$category = new Category();
		$form = $this->createForm(CategoryType::class, $category);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($category);
			$em->flush();
			
			$this->addFlash(
					'notice',
					'Category was added!'
					);
			
			return $this->redirectToRoute('list_categories');
		}
		
		return $this->render('category/add.html.twig', array (
				'form' => $form->createView() 
		));
	}
}