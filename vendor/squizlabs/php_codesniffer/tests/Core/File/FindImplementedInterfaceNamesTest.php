<?php
/**
 * Tests for the \PHP_CodeSniffer\Files\File:findImplementedInterfaceNames method.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\File;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

class FindImplementedInterfaceNamesTest extends AbstractMethodUnitTest {



	/**
	 * Test retrieving the name(s) of the interfaces being implemented by a class.
	 *
	 * @param string $identifier Comment which precedes the test case.
	 * @param bool   $expected   Expected function output.
	 *
	 * @dataProvider dataImplementedInterface
	 *
	 * @return void
	 */
	public function testFindImplementedInterfaceNames( $identifier, $expected ) {
		$OOToken = $this->getTargetToken( $identifier, array( T_CLASS, T_ANON_CLASS, T_INTERFACE ) );
		$result  = self::$phpcsFile->findImplementedInterfaceNames( $OOToken );
		$this->assertSame( $expected, $result );

	}//end testFindImplementedInterfaceNames()


	/**
	 * Data provider for the FindImplementedInterfaceNames test.
	 *
	 * @see testFindImplementedInterfaceNames()
	 *
	 * @return array
	 */
	public function dataImplementedInterface() {
		return array(
			array(
				'/* testImplementedClass */',
				array( 'testFIINInterface' ),
			),
			array(
				'/* testMultiImplementedClass */',
				array(
					'testFIINInterface',
					'testFIINInterface2',
				),
			),
			array(
				'/* testNamespacedClass */',
				array( '\PHP_CodeSniffer\Tests\Core\File\testFIINInterface' ),
			),
			array(
				'/* testNonImplementedClass */',
				false,
			),
			array(
				'/* testInterface */',
				false,
			),
			array(
				'/* testClassThatExtendsAndImplements */',
				array(
					'InterfaceA',
					'\NameSpaced\Cat\InterfaceB',
				),
			),
			array(
				'/* testClassThatImplementsAndExtends */',
				array(
					'\InterfaceA',
					'InterfaceB',
				),
			),
		);

	}//end dataImplementedInterface()


}//end class
