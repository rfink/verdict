<?php

/**
 * Abstract base class for composite filters for verdict interface.
 * @author  Ryan Fink <rfink@redventures.net>
 * @since   April 16, 2012
 */

namespace Verdict\Filter\Composite;

use Verdict\Filter\FilterInterface,
	ArrayIterator,
	InvalidArgumentException;

abstract class CompositeAbstract {
    /**
     *
     * @var type 
     */
	protected $items;

    /**
     *
     * @param ArrayIterator $items 
     */
	public function __construct(ArrayIterator $items = null) {
		if (isset($items)) {
			$this->setItems($items);
		} else {
			$this->items = new ArrayIterator();
		}
	}

    /**
     *
     * @param ArrayIterator $items
     * @return CompositeAbstract 
     */
	public function setItems(ArrayIterator $items) {
		if (!$items->count()) {
			throw new InvalidArgumentException('Items must contain at least one element');
		}
		// Iterate and type check our items
		foreach ($items as $item) {
			if (!($item instanceof FilterInterface)) {
				throw new InvalidArgumentException('Item must implement Verdict\Filter\FilterInterface');
			}
		}
		$this->items = $items;
		return $this;
	}

    /**
     *
     * @param FilterInterface $filter
     * @return CompositeAbstract 
     */
	public function addItem(FilterInterface $filter) {
		$this->items->append($filter);
		return $this;
	}
	
    /**
     *
     * @return type 
     */
	public function getItems() {
		return $this->items;
	}
}
