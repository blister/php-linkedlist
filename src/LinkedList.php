<?php declare(strict_types=1);

namespace Blister\LinkedList;

class LinkedList {
	public $head = null;
	public $tail = null;

	public $length = 0;

	private $search_needle = null;
	private $search_index  = null;
	private $search_cache  = null;

	/**
	 * remove removes a specific node at index location.
	 *
	 * @param int The value at the index we want to remove.
	 *
	 * @return mixed Returns the found value at that index or false.
	 */
	public function removeAt(int $index): mixed {
		if ( $index >= $this->length ) {
			return false;
		}

		if ( $index === 0 ) {
			return $this->shift();
		}
	
		$cur = 0;
		$node = $this->head;
		while ( $cur <= $index ) {
			$cur++;
			$node = $node->next;

			if ( $cur === $index ) {
				$node->prev->next = $node->next;
				if ( $node->next ) {
					$node->next->prev = $node->prev;
				}
				$this->length--;

				return $node->value;
			}
		}

		return false;
	}
	/**
	 * remove removes a specific node by needle.
	 *
	 * @param mixed The needle we're searching for to remove.
	 *
	 * @return mixed Returns the found value or false.
	 */
	public function remove(mixed $needle): mixed {
		$node = $this->head;

		if ( $node->value === $needle ) {
			return $this->shift();
		}

		while ( $node->next ) {
			$node = $node->next;
			if ( $node->value === $needle ) {
				$node->prev->next = $node->next;
				if ( $node->next ) {
					$node->next->prev = $node->prev;
				}
				$this->length--;

				return $node->value;
			}
		}

		return false;
	}

	/**
	 * index traverses the LinkedList and returns the location where needle is found.
	 *
	 * @param mixed The value we're searching for.
	 *
	 * @return int The index of the node in the LinkedList
	 */
	public function index(mixed $needle): int|false {
		$cur = $this->head;

		$index = 0;

		if ( $cur->value === $needle ) {
			return $index;
		}
		
		while ( $cur->next ) {
			$index++;
			$cur = $cur->next;
			if ( $cur->value === $needle ) {
				return $index;
			}
		}

		return false;
	}

	/**
	 * find traverses the LinkedList for the needle. 
	 *
	 * find begins searching from the head, so it's slower if you're
	 * looking for things that were recently added via push. If you want to 
	 * search from the tail, use findFromTail()
	 *
	 * @param mixed The value of the node we're searching for.
	 *
	 * @return bool
	 */
	public function find(mixed $needle): bool {
		$cur = $this->head;

		$index = 0;
		if ( $cur->value === $needle ) {
			return true;
		}

		while ( $cur->next ) {
			$cur = $cur->next;
			$index++;
			if ( $cur->value === $needle ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * shift removes a node from the head of the LinkedList.
	 *
	 * @return mixed The value of the node removed or null.
	 */
	public function shift(): mixed {
		if ( $this->length === 0 ) {
			return null;
		}

		$this->length--;

		$node = $this->head;
		$this->head = $node->next;
		$this->head->prev = null;

		return $node->value;
	}

	/**
	 * unshift adds a new node to the head of the LinkedList
	 *
	 * @param mixed The value to put at the beginning of the LinkedList
	 *
	 * @return int The new length of the LinkedList
	 */
	public function unshift($value): int {
		$node = new LLNode($value);

		$this->length++;

		if ( ! $this->head ) {
			$this->head = $this->tail = $node;
			return $this->length;
		}

		$node->next = $this->head;
		$this->head->prev = $node;
		$this->head = $node;

		return $this->length;
	}

	/**
	 * push adds a new node to the end of the LinkedList.
	 *
	 * @param mixed The data value to add to the LinkedList.
	 *
	 * @return int The new length of the LinkedList
	 */
	public function push($value): int {
		$node = new LLNode($value);

		$this->length++;

		if ( ! $this->head ) {
			$this->head = $this->tail = $node;
			return $this->length;
		}

		$node->prev = $this->tail;
		$this->tail->next = $node;
		$this->tail = $node;

		return $this->length;
	}


	/**
	 * pop removes a node from the end of the LinkedList and returns it.
	 *
	 * @return LLNode The node removed.
	 */
	public function pop(): mixed {
		$node = $this->tail;
		$this->tail = $node->prev;
		$this->tail->next = null;

		$this->length--;

		return $node->value;
	}

	public function __construct(int $count = 0) {
		if ( $count ) {
			for ( $i = 0; $i < $count; ++$i ) {
				$this->push(null);
			}
		}
	}
}

class LLNode {
	public $prev = null;
	public $next = null;

	public $value = null;

	public function __construct(mixed $value) {
		$this->value = $value;
	}
}
