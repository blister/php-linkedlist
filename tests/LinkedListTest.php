<?php

declare(strict_types=1);

namespace Blister\LinkedList;

use PHPUnit\Framework\TestCase;

class LinkedListTest extends TestCase {
	public function testLinkedListOperations(): void {
		$list = new LinkedList();

		self::assertInstanceOf(LinkedList::class, $list);
		self::assertEquals($list->length, 0, 'New LL has zero length.');
		self::assertEquals(
			$list->push('Test Push'),
			1,
			'We can push onto the LL.',
		);
		self::assertEquals(
			$list->push('Test Push 2'),
			2,
			'We can push onto the LL.',
		);
		self::assertInstanceOf(
			LLNode::class,
			$list->head,
			'head is a LLNode.',
		);
		self::assertInstanceOf(
			LLNode::class,
			$list->tail,
			'tail is a LLNode.',
		);
		self::assertEquals(
			$list->pop(),
			'Test Push 2',
			'Pop returns our value from end of LL.',
		);
		self::assertEquals($list->length, 1, 'LL has decreased in size by 1.');
		self::assertEquals(
			$list->unshift('Test Unshift'),
			2,
			'unshift added an element to the front of the LL.',
		);
		self::assertEquals(
			$list->shift(),
			'Test Unshift',
			'shift removed the element from the front of our LL.',
		);
	}

	public function testLinkedListSearching(): void {
		$list = new LinkedList();

		self::assertInstanceOf(LinkedList::class, $list);
		$list->push('First Value');	
		$list->push('Second Value');
		$list->push('Third Value');

		// searching
		self::assertFalse(
			$list->find('Missing'),
			'find("Missing") did not find the value in the LL.',
		);
		self::assertTrue($list->find(
			'Third Value',
		), 'find("Third Value") is in the LL.');

		// searching for index
		self::assertEquals(
			$list->index('Third Value'),
			2,
			'index("Third Value") was 2.',
		);
		self::assertFalse($list->index(
			'Missing Value',
		), 'index("Missing Value") is false.');
	}

	public function testMidListOperations(): void {
		$list = new LinkedList();

		self::assertInstanceOf(LinkedList::class, $list);
		$list->push('First Value');	
		$list->push('Second Value');
		$list->push('Third Value');
		$list->push('Fourth Value');

		self::assertEquals($list->length, 4, 'LL has 4 elements.');
		self::assertEquals(
			$list->remove('Third Value'),
			'Third Value',
			'We pulled a specific element.',
		);
		self::assertEquals($list->length, 3, 'LL has 3 elements.');
		self::assertEquals(
			$list->removeAt(2),
			'Fourth Value',
			'We removed a specific element by index.',
		);

		self::assertEquals($list->length, 2, 'LL has 2 elements');
		self::assertFalse(
			$list->remove('Missing Element'),
			'Removing a missing node returns false.',
		);
		self::assertFalse(
			$list->removeAt(10),
			'Removing an illegal node index returns false.',
		);
		self::assertFalse(
			$list->removeAt(-4),
			'Removing an illegal node index returns false.',
		);
	}
}
