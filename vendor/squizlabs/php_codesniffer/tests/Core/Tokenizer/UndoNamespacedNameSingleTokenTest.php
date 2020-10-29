<?php
/**
 * Tests the tokenization of identifier names.
 *
 * As of PHP 8, identifier names are tokenized differently, depending on them being
 * either fully qualified, partially qualified or relative to the current namespace.
 *
 * This test file safeguards that in PHPCS 3.x this new form of tokenization is "undone"
 * and the tokenization of these identifier names is the same in all PHP versions
 * based on how these names were tokenized in PHP 5/7.
 *
 * {@link https://wiki.php.net/rfc/namespaced_names_as_token}
 * {@link https://github.com/squizlabs/PHP_CodeSniffer/issues/3041}
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2020 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Tokenizer;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

class UndoNamespacedNameSingleTokenTest extends AbstractMethodUnitTest {



	/**
	 * Test that identifier names are tokenized the same across PHP versions, based on the PHP 5/7 tokenization.
	 *
	 * @param string $testMarker     The comment prefacing the test.
	 * @param array  $expectedTokens The tokenization expected.
	 *
	 * @dataProvider dataIdentifierTokenization
	 * @covers       PHP_CodeSniffer\Tokenizers\PHP::tokenize
	 *
	 * @return void
	 */
	public function testIdentifierTokenization( $testMarker, $expectedTokens ) {
		$tokens     = self::$phpcsFile->getTokens();
		$identifier = $this->getTargetToken( $testMarker, constant( $expectedTokens[0]['type'] ) );

		foreach ( $expectedTokens as $key => $tokenInfo ) {
			$this->assertSame( constant( $tokenInfo['type'] ), $tokens[ $identifier ]['code'] );
			$this->assertSame( $tokenInfo['type'], $tokens[ $identifier ]['type'] );
			$this->assertSame( $tokenInfo['content'], $tokens[ $identifier ]['content'] );

			++$identifier;
		}

	}//end testIdentifierTokenization()


	/**
	 * Data provider.
	 *
	 * @see testIdentifierTokenization()
	 *
	 * @return array
	 */
	public function dataIdentifierTokenization() {
		return array(
			array(
				'/* testNamespaceDeclaration */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Package',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testNamespaceDeclarationWithLevels */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'SubLevel',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Domain',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testUseStatement */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testUseStatementWithLevels */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Domain',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testFunctionUseStatement */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'function',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testFunctionUseStatementWithLevels */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'function',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_in_ns',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testConstantUseStatement */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'const',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'CONSTANT_NAME',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testConstantUseStatementWithLevels */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'const',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'OTHER_CONSTANT',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testMultiUseUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'UnqualifiedClassName',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
				),
			),
			array(
				'/* testMultiUsePartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Sublevel',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'PartiallyClassName',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testGroupUseStatement */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_OPEN_USE_GROUP',
						'content' => '{',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'AnotherDomain',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_grouped',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'const',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'CONSTANT_GROUPED',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Sub',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'YetAnotherDomain',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'SubLevelA',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_grouped_too',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'const',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'SubLevelB',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'CONSTANT_GROUPED_TOO',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_CLOSE_USE_GROUP',
						'content' => '}',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testClassName */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'MyClass',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testExtendedFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'FQN',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testImplementsRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
				),
			),
			array(
				'/* testImplementsFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Fully',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Qualified',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
				),
			),
			array(
				'/* testImplementsUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Unqualified',
					),
					array(
						'type'    => 'T_COMMA',
						'content' => ',',
					),
				),
			),
			array(
				'/* testImplementsPartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Sub',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testFunctionName */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testTypeDeclarationRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					// TODO: change this to T_TYPE_UNION when #3032 is merged.
					array(
						'type'    => 'T_BITWISE_OR',
						'content' => '|',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'object',
					),
				),
			),
			array(
				'/* testTypeDeclarationFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Fully',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Qualified',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testTypeDeclarationUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Unqualified',
					),
					// TODO: change this to T_TYPE_UNION when #3032 is merged.
					array(
						'type'    => 'T_BITWISE_OR',
						'content' => '|',
					),
					array(
						'type'    => 'T_FALSE',
						'content' => 'false',
					),
				),
			),
			array(
				'/* testTypeDeclarationPartiallyQualified */',
				array(
					array(
						'type'    => 'T_NULLABLE',
						'content' => '?',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Sublevel',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testReturnTypeFQN */',
				array(
					array(
						'type'    => 'T_NULLABLE',
						'content' => '?',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testFunctionCallRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'NameSpace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testFunctionCallFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Package',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testFunctionCallUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testFunctionPartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testCatchRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'SubLevel',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Exception',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testCatchFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Exception',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testCatchUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Exception',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testCatchPartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Exception',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testNewRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testNewFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Vendor',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testNewUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testNewPartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testDoubleColonRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_DOUBLE_COLON',
						'content' => '::',
					),
				),
			),
			array(
				'/* testDoubleColonFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_DOUBLE_COLON',
						'content' => '::',
					),
				),
			),
			array(
				'/* testDoubleColonUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_DOUBLE_COLON',
						'content' => '::',
					),
				),
			),
			array(
				'/* testDoubleColonPartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Level',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_DOUBLE_COLON',
						'content' => '::',
					),
				),
			),
			array(
				'/* testInstanceOfRelative */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testInstanceOfFQN */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Full',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_CLOSE_PARENTHESIS',
						'content' => ')',
					),
				),
			),
			array(
				'/* testInstanceOfUnqualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
				),
			),
			array(
				'/* testInstanceOfPartiallyQualified */',
				array(
					array(
						'type'    => 'T_STRING',
						'content' => 'Partially',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'ClassName',
					),
					array(
						'type'    => 'T_SEMICOLON',
						'content' => ';',
					),
				),
			),
			array(
				'/* testInvalidInPHP8Whitespace */',
				array(
					array(
						'type'    => 'T_NAMESPACE',
						'content' => 'namespace',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Sublevel',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '          ',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'function_name',
					),
					array(
						'type'    => 'T_OPEN_PARENTHESIS',
						'content' => '(',
					),
				),
			),
			array(
				'/* testInvalidInPHP8Comments */',
				array(
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Fully',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => '// phpcs:ignore Stnd.Cat.Sniff -- for reasons
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Qualified',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* comment */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '    ',
					),
					array(
						'type'    => 'T_NS_SEPARATOR',
						'content' => '\\',
					),
					array(
						'type'    => 'T_STRING',
						'content' => 'Name',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
		);

	}//end dataIdentifierTokenization()


}//end class
