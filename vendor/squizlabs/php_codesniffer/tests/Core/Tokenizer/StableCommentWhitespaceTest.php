<?php
/**
 * Tests the comment tokenization.
 *
 * Comment have their own tokenization in PHPCS anyhow, including the PHPCS annotations.
 * However, as of PHP 8, the PHP native comment tokenization has changed.
 * Natively T_COMMENT tokens will no longer include a trailing newline.
 * PHPCS "forward-fills" the original tokenization to PHP 8.
 * This test file safeguards that.
 *
 * @author    Juliette Reinders Folmer <phpcs_nospam@adviesenzo.nl>
 * @copyright 2020 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Tokenizer;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;
use PHP_CodeSniffer\Util\Tokens;

class StableCommentWhitespaceTest extends AbstractMethodUnitTest {



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
				'/* testSingleLineStarComment */',
				array(
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* Single line star comment */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testSingleLineStarCommentTrailing */',
				array(
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* Comment */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testSingleLineStarAnnotation */',
				array(
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => '/* phpcs:ignore Stnd.Cat */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineStarComment */',
				array(
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* Comment1
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => ' * Comment2
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => ' * Comment3 */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineStarCommentWithIndent */',
				array(
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* Comment1
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => '         * Comment2
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => '         * Comment3 */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineStarCommentWithAnnotationStart */',
				array(
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => '/* @phpcs:ignore Stnd.Cat
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => ' * Comment2
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => ' * Comment3 */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineStarCommentWithAnnotationMiddle */',
				array(
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* Comment1
',
					),
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => ' * phpcs:ignore Stnd.Cat
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => ' * Comment3 */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineStarCommentWithAnnotationEnd */',
				array(
					array(
						'type'    => 'T_COMMENT',
						'content' => '/* Comment1
',
					),
					array(
						'type'    => 'T_COMMENT',
						'content' => ' * Comment2
',
					),
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => ' * phpcs:ignore Stnd.Cat */',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),

			array(
				'/* testSingleLineDocblockComment */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testSingleLineDocblockCommentTrailing */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testSingleLineDocblockAnnotation */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => 'phpcs:ignore Stnd.Cat.Sniff ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),

			array(
				'/* testMultiLineDocblockComment */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment1',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment2',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_TAG',
						'content' => '@tag',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineDocblockCommentWithIndent */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '     ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment1',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '     ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment2',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '     ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '     ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_TAG',
						'content' => '@tag',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '     ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineDocblockCommentWithAnnotation */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => 'phpcs:ignore Stnd.Cat',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_TAG',
						'content' => '@tag',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
',
					),
				),
			),
			array(
				'/* testMultiLineDocblockCommentWithTagAnnotation */',
				array(
					array(
						'type'    => 'T_DOC_COMMENT_OPEN_TAG',
						'content' => '/**',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_PHPCS_IGNORE',
						'content' => '@phpcs:ignore Stnd.Cat',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STAR',
						'content' => '*',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_TAG',
						'content' => '@tag',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_STRING',
						'content' => 'Comment',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => '
',
					),
					array(
						'type'    => 'T_DOC_COMMENT_WHITESPACE',
						'content' => ' ',
					),
					array(
						'type'    => 'T_DOC_COMMENT_CLOSE_TAG',
						'content' => '*/',
					),
					array(
						'type'    => 'T_WHITESPACE',
						'content' => '
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
