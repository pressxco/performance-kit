<?php
/**
 * Tests the comment tokenization with Windows line endings.
 *
 * Basically the same as the StableCommentWhitespaceTest, but now for
 * Windows line endings.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2020 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Tokenizer;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;
use PHP_CodeSniffer\Util\Tokens;

class StableCommentWhitespaceWinTest extends AbstractMethodUnitTest {



	/**
	 * Test that comment tokenization with new lines at the end of the comment is stable.
	 *
	 * @param string $testMarker     The comment prefacing the test.
	 * @param array  $expectedTokens The tokenization expected.
	 *
	 * @dataProvider dataCommentTokenization
	 * @covers       PHP_CodeSniffer\Tokenizers\PHP::tokenize
	 *
	 * @return void
	 */
	public function testCommentTokenization( $testMarker, $expectedTokens ) {
		$tokens  = self::$phpcsFile->getTokens();
		$comment = $this->getTargetToken( $testMarker, Tokens::$commentTokens );

		foreach ( $expectedTokens as $key => $tokenInfo ) {
			$this->assertSame( constant( $tokenInfo['type'] ), $tokens[ $comment ]['code'] );
			$this->assertSame( $tokenInfo['type'], $tokens[ $comment ]['type'] );
			$this->assertSame( $tokenInfo['content'], $tokens[ $comment ]['content'] );

			++$comment;
		}

	}//end testCommentTokenization()


	/**
	 * Data provider.
	 *
	 * @see testCommentTokenization()
	 *
	 * @return array
	 */
	public function dataCommentTokenization() {
		 return array(
			 array(
				 '/* testSingleLineSlashComment */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testSingleLineSlashCommentTrailing */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testSingleLineSlashAnnotation */',
				 array(
					 array(
						 'type'    => 'T_PHPCS_DISABLE',
						 'content' => '// phpcs:disable Stnd.Cat
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineSlashComment */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment1
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment2
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment3
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineSlashCommentWithIndent */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment1
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '    ',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment2
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '    ',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment3
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineSlashCommentWithAnnotationStart */',
				 array(
					 array(
						 'type'    => 'T_PHPCS_IGNORE',
						 'content' => '// phpcs:ignore Stnd.Cat
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment2
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment3
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineSlashCommentWithAnnotationMiddle */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment1
',
					 ),
					 array(
						 'type'    => 'T_PHPCS_IGNORE',
						 'content' => '// @phpcs:ignore Stnd.Cat
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment3
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineSlashCommentWithAnnotationEnd */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment1
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Comment2
',
					 ),
					 array(
						 'type'    => 'T_PHPCS_IGNORE',
						 'content' => '// phpcs:ignore Stnd.Cat
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testSingleLineSlashCommentNoNewLineAtEnd */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '// Slash ',
					 ),
					 array(
						 'type'    => 'T_CLOSE_TAG',
						 'content' => '?>
',
					 ),
				 ),
			 ),
			 array(
				 '/* testSingleLineHashComment */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testSingleLineHashCommentTrailing */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineHashComment */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment1
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment2
',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment3
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testMultiLineHashCommentWithIndent */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment1
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '    ',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment2
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '    ',
					 ),
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Comment3
',
					 ),
					 array(
						 'type'    => 'T_WHITESPACE',
						 'content' => '
',
					 ),
				 ),
			 ),
			 array(
				 '/* testSingleLineHashCommentNoNewLineAtEnd */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '# Hash ',
					 ),
					 array(
						 'type'    => 'T_CLOSE_TAG',
						 'content' => '?>
',
					 ),
				 ),
			 ),
			 array(
				 '/* testCommentAtEndOfFile */',
				 array(
					 array(
						 'type'    => 'T_COMMENT',
						 'content' => '/* Comment',
					 ),
				 ),
			 ),
		 );

	}//end dataCommentTokenization()


}//end class
