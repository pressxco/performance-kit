<?php
/**
 * Tests for the \PHP_CodeSniffer\Files\File:isReference method.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\File;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

class IsReferenceTest extends AbstractMethodUnitTest {



	/**
	 * Test correctly identifying whether a "bitwise and" token is a reference or not.
	 *
	 * @param string $identifier Comment which precedes the test case.
	 * @param bool   $expected   Expected function output.
	 *
	 * @dataProvider dataIsReference
	 *
	 * @return void
	 */
	public function testIsReference( $identifier, $expected ) {
		$bitwiseAnd = $this->getTargetToken( $identifier, T_BITWISE_AND );
		$result     = self::$phpcsFile->isReference( $bitwiseAnd );
		$this->assertSame( $expected, $result );

	}//end testIsReference()


	/**
	 * Data provider for the IsReference test.
	 *
	 * @see testIsReference()
	 *
	 * @return array
	 */
	public function dataIsReference() {
		return array(
			array(
				'/* testBitwiseAndA */',
				false,
			),
			array(
				'/* testBitwiseAndB */',
				false,
			),
			array(
				'/* testBitwiseAndC */',
				false,
			),
			array(
				'/* testBitwiseAndD */',
				false,
			),
			array(
				'/* testBitwiseAndE */',
				false,
			),
			array(
				'/* testBitwiseAndF */',
				false,
			),
			array(
				'/* testBitwiseAndG */',
				false,
			),
			array(
				'/* testBitwiseAndH */',
				false,
			),
			array(
				'/* testBitwiseAndI */',
				false,
			),
			array(
				'/* testFunctionReturnByReference */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceA */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceB */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceC */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceD */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceE */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceF */',
				true,
			),
			array(
				'/* testFunctionPassByReferenceG */',
				true,
			),
			array(
				'/* testForeachValueByReference */',
				true,
			),
			array(
				'/* testForeachKeyByReference */',
				true,
			),
			array(
				'/* testArrayValueByReferenceA */',
				true,
			),
			array(
				'/* testArrayValueByReferenceB */',
				true,
			),
			array(
				'/* testArrayValueByReferenceC */',
				true,
			),
			array(
				'/* testArrayValueByReferenceD */',
				true,
			),
			array(
				'/* testArrayValueByReferenceE */',
				true,
			),
			array(
				'/* testArrayValueByReferenceF */',
				true,
			),
			array(
				'/* testArrayValueByReferenceG */',
				true,
			),
			array(
				'/* testArrayValueByReferenceH */',
				true,
			),
			array(
				'/* testAssignByReferenceA */',
				true,
			),
			array(
				'/* testAssignByReferenceB */',
				true,
			),
			array(
				'/* testAssignByReferenceC */',
				true,
			),
			array(
				'/* testAssignByReferenceD */',
				true,
			),
			array(
				'/* testAssignByReferenceE */',
				true,
			),
			array(
				'/* testPassByReferenceA */',
				true,
			),
			array(
				'/* testPassByReferenceB */',
				true,
			),
			array(
				'/* testPassByReferenceC */',
				true,
			),
			array(
				'/* testPassByReferenceD */',
				true,
			),
			array(
				'/* testPassByReferenceE */',
				true,
			),
			array(
				'/* testPassByReferenceF */',
				true,
			),
			array(
				'/* testPassByReferenceG */',
				true,
			),
			array(
				'/* testPassByReferenceH */',
				true,
			),
			array(
				'/* testPassByReferenceI */',
				true,
			),
			array(
				'/* testPassByReferenceJ */',
				true,
			),
			array(
				'/* testNewByReferenceA */',
				true,
			),
			array(
				'/* testNewByReferenceB */',
				true,
			),
			array(
				'/* testUseByReference */',
				true,
			),
			array(
				'/* testArrowFunctionReturnByReference */',
				true,
			),
			array(
				'/* testArrowFunctionPassByReferenceA */',
				true,
			),
			array(
				'/* testArrowFunctionPassByReferenceB */',
				true,
			),
			array(
				'/* testClosureReturnByReference */',
				true,
			),
		);

	}//end dataIsReference()


}//end class
