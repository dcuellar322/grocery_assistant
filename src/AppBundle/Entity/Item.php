<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ItemRepository")
 * @ORM\Table(name="item")
 */
class Item {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=false)
	 * @Assert\NotBlank()
	 */
	private $name;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="items")
	 * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
	 * @Assert\NotNull()
	 */
	private $category;
	
	/**
	 * @ORM\Column(type="decimal", precision=5, scale=2, nullable=false)
	 * @Assert\NotNull()
	 */
	private $price;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $unit;
	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Set name
	 *
	 * @param string $name        	
	 * @return Item
	 */
	public function setName($name) {
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Set price
	 *
	 * @param string $price        	
	 * @return Item
	 */
	public function setPrice($price) {
		$this->price = $price;
		
		return $this;
	}
	
	/**
	 * Get price
	 *
	 * @return string
	 */
	public function getPrice() {
		return $this->price;
	}
	
	/**
	 * Set unit
	 *
	 * @param string $unit        	
	 * @return Item
	 */
	public function setUnit($unit) {
		$this->unit = $unit;
		
		return $this;
	}
	
	/**
	 * Get unit
	 *
	 * @return string
	 */
	public function getUnit() {
		return $this->unit;
	}
	
	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Category $category        	
	 * @return Item
	 */
	public function setCategory(Category $category) {
		$this->category = $category;
		
		return $this;
	}
	
	/**
	 * Get category
	 *
	 * @return Category
	 */
	public function getCategory() {
		return $this->category;
	}
}
