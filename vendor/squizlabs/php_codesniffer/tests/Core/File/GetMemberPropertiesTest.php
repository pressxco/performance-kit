<?php
/**
 * Tests for the \PHP_CodeSniffer\Files\File::getMemberProperties method.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\File;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

class GetMemberPropertiesTest extends AbstractMethodUnitTest {



	/**
	 * Test the getMemberProperties() method.
	 *
	 * @param string $identifier Comment which precedes the test case.
	 * @param bool   $expected   Expected function output.
	 *
	 * @dataProvider dataGetMemberProperties
	 *
	 * @return void
	 */
	public function testGetMemberProperties( $identifier, $expected ) {
		$variable = $this->getTargetToken( $identifier, T_VARIABLE );
		$result   = self::$phpcsFile->getMemberProperties( $variable );

		$this->assertArraySubset( $expected, $result, true );

	}//end testGetMemberProperties()


	/**
	 * Data provider for the GetMemberProperties test.
	 *
	 * @see testGetMemberProperties()
	 *
	 * @return array
	 */
	public function dataGetMemberProperties() {
		return array(
			array(
				'/* testVar */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testVarType */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => false,
					'type'            => '?int',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testPublic */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPublicType */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => 'string',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testProtected */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testProtectedType */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => 'bool',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPrivate */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPrivateType */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => 'array',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testStatic */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testStaticType */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => true,
					'type'            => '?string',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testStaticVar */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testVarStatic */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPublicStatic */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testProtectedStatic */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPrivateStatic */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPublicStaticWithDocblock */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testProtectedStaticWithDocblock */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPrivateStaticWithDocblock */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupType 1 */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => 'float',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupType 2 */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => 'float',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupNullableType 1 */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '?string',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testGroupNullableType 2 */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '?string',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testNoPrefix */',
				array(
					'scope'           => 'public',
					'scope_specified' => false,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupProtectedStatic 1 */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupProtectedStatic 2 */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupProtectedStatic 3 */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 1 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 2 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 3 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 4 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 5 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 6 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testGroupPrivate 7 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testMessyNullableType */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '?array',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testNamespaceType */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '\MyNamespace\MyClass',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testNullableNamespaceType 1 */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '?ClassName',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testNullableNamespaceType 2 */',
				array(
					'scope'           => 'protected',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '?Folder\ClassName',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testMultilineNamespaceType */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '\MyNamespace\MyClass\Foo',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPropertyAfterMethod */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testInterfaceProperty */',
				array(),
			),
			array(
				'/* testNestedProperty 1 */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testNestedProperty 2 */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPHP8MixedTypeHint */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => true,
					'type'            => 'miXed',
					'nullable_type'   => false,
				),
			),
			array(
				'/* testPHP8MixedTypeHintNullable */',
				array(
					'scope'           => 'private',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '?mixed',
					'nullable_type'   => true,
				),
			),
			array(
				'/* testNamespaceOperatorTypeHint */',
				array(
					'scope'           => 'public',
					'scope_specified' => true,
					'is_static'       => false,
					'type'            => '?namespace\Name',
					'nullable_type'   => true,
				),
			),
		);

	}//end dataGetMemberProperties()


	/**
	 * Test receiving an expected exception when a non property is passed.
	 *
	 * @param string $identifier Comment which precedes the test case.
	 *
	 * @expectedException        PHP_CodeSniffer\Exceptions\RuntimeException
	 * @expectedExceptionMessage $stackPtr is not a class member var
	 *
	 * @dataProvider dataNotClassProperty
	 *
	 * @return void
	 */
	public function testNotClassPropertyException( $identifier ) {
		$variable = $this->getTargetToken( $identifier, T_VARIABLE );
		$result   = self::$phpcsFile->getMemberProperties( $variable );

	}//end testNotClassPropertyException()


	/**
	 * Data provider for the NotClassPropertyException test.
	 *
	 * @see testNotClassPropertyException()
	 *
	 * @return array
	 */
	public function dataNotClassProperty() {
		return array(
			array( '/* testMethodParam */' ),
			array( '/* testImportedGlobal */' ),
			array( '/* testLocalVariable */' ),
			array( '/* testGlobalVariable */' ),
			array( '/* testNestedMethodParam 1 */' ),
			array( '/* testNestedMethodParam 2 */' ),
		);

	}//end dataNotClassProperty()


	/**
	 * Test receiving an expected exception when a non variable is passed.
	 *
	 * @expectedException        PHP_CodeSniffer\Exceptions\RuntimeException
	 * @expectedExceptionMessage $stackPtr must be of type T_VARIABLE
	 *
	 * @return void
	 */
	public function testNotAVariableException() {
		$next   = $this->getTargetToken( '/* testNotAVariable */', T_RETURN );
		$result = self::$phpcsFile->getMemberProperties( $next );

	}//end testNotAVariableException()


}//end class
