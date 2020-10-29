<?php
/**
 * Tests the backfilling of numeric seperators to PHP < 7.4.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2019 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Tests\Core\Tokenizer;

use PHP_CodeSniffer\Tests\Core\AbstractMethodUnitTest;

class BackfillNumericSeparatorTest extends AbstractMethodUnitTest {



	/**
	 * Test that numbers using numeric seperators are tokenized correctly.
	 *
	 * @param array $testData The data required for the specific test case.
	 *
	 * @dataProvider dataTestBackfill
	 * @covers       PHP_CodeSniffer\Tokenizers\PHP::tokenize
	 *
	 * @return void
	 */
	public function testBackfill( $testData ) {
		$tokens = self::$phpcsFile->getTokens();
		$number = $this->getTargetToken( $testData['marker'], array( T_LNUMBER, T_DNUMBER ) );

		$this->assertSame( constant( $testData['type'] ), $tokens[ $number ]['code'] );
		$this->assertSame( $testData['type'], $tokens[ $number ]['type'] );
		$this->assertSame( $testData['value'], $tokens[ $number ]['content'] );

	}//end testBackfill()


	/**
	 * Data provider.
	 *
	 * @see testBackfill()
	 *
	 * @return array
	 */
	public function dataTestBackfill() {
		$testHexType = 'T_LNUMBER';
		if ( PHP_INT_MAX < 0xCAFEF00D ) {
			$testHexType = 'T_DNUMBER';
		}

		$testHexMultipleType = 'T_LNUMBER';
		if ( PHP_INT_MAX < 0x42726F776E ) {
			$testHexMultipleType = 'T_DNUMBER';
		}

		$testIntMoreThanMaxType = 'T_LNUMBER';
		if ( PHP_INT_MAX < 10223372036854775807 ) {
			$testIntMoreThanMaxType = 'T_DNUMBER';
		}

		return array(
			array(
				array(
					'marker' => '/* testSimpleLNumber */',
					'type'   => 'T_LNUMBER',
					'value'  => '1_000_000_000',
				),
			),
			array(
				array(
					'marker' => '/* testSimpleDNumber */',
					'type'   => 'T_DNUMBER',
					'value'  => '107_925_284.88',
				),
			),
			array(
				array(
					'marker' => '/* testFloat */',
					'type'   => 'T_DNUMBER',
					'value'  => '6.674_083e-11',
				),
			),
			array(
				array(
					'marker' => '/* testFloat2 */',
					'type'   => 'T_DNUMBER',
					'value'  => '6.674_083e+11',
				),
			),
			array(
				array(
					'marker' => '/* testFloat3 */',
					'type'   => 'T_DNUMBER',
					'value'  => '1_2.3_4e1_23',
				),
			),
			array(
				array(
					'marker' => '/* testHex */',
					'type'   => $testHexType,
					'value'  => '0xCAFE_F00D',
				),
			),
			array(
				array(
					'marker' => '/* testHexMultiple */',
					'type'   => $testHexMultipleType,
					'value'  => '0x42_72_6F_77_6E',
				),
			),
			array(
				array(
					'marker' => '/* testHexInt */',
					'type'   => 'T_LNUMBER',
					'value'  => '0x42_72_6F',
				),
			),
			array(
				array(
					'marker' => '/* testBinary */',
					'type'   => 'T_LNUMBER',
					'value'  => '0b0101_1111',
				),
			),
			array(
				array(
					'marker' => '/* testOctal */',
					'type'   => 'T_LNUMBER',
					'value'  => '0137_041',
				),
			),
			array(
				array(
					'marker' => '/* testIntMoreThanMax */',
					'type'   => $testIntMoreThanMaxType,
					'value'  => '10_223_372_036_854_775_807',
				),
			),
		);

	}//end dataTestBackfill()


	/**
	 * Test that numbers using numeric seperators which are considered parse errors and/or
	 * which aren't relevant to the backfill, do not incorrectly trigger the backfill anyway.
	 *
	 * @param string $testMarker     The comment which prefaces the target token in the test file.
	 * @param array  $expectedTokens The token type and content of the expected token sequence.
	 *
	 * @dataProvider dataNoBackfill
	 * @covers       PHP_CodeSniffer\Tokenizers\PHP::tokenize
	 *
	 * @return void
	 */
	public function testNoBackfill( $testMarker, $expectedTokens ) {
		$tokens = self::$phpcsFile->getTokens();
		$number = $this->getTargetToken( $testMarker, array( T_LNUMBER, T_DNUMBER ) );

		foreach ( $expectedTokens as $key => $expectedToken ) {
			$i = ( $number + $key );
			$this->assertSame( $expectedToken['code'], $tokens[ $i ]['code'] );
			$this->assertSame( $expectedToken['content'], $tokens[ $i ]['content'] );
		}

	}//end testNoBackfill()


	/**
	 * Data provider.
	 *
	 * @see testBackfill()
	 *
	 * @return array
	 */
	public function dataNoBackfill() {
		return array(
			array(
				'/* testInvalid1 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '100',
					),
					array(
						'code'    => T_STRING,
						'content' => '_',
					),
				),
			),
			array(
				'/* testInvalid2 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '1',
					),
					array(
						'code'    => T_STRING,
						'content' => '__1',
					),
				),
			),
			array(
				'/* testInvalid3 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '1',
					),
					array(
						'code'    => T_STRING,
						'content' => '_',
					),
					array(
						'code'    => T_DNUMBER,
						'content' => '.0',
					),
				),
			),
			array(
				'/* testInvalid4 */',
				array(
					array(
						'code'    => T_DNUMBER,
						'content' => '1.',
					),
					array(
						'code'    => T_STRING,
						'content' => '_0',
					),
				),
			),
			array(
				'/* testInvalid5 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '0',
					),
					array(
						'code'    => T_STRING,
						'content' => 'x_123',
					),
				),
			),
			array(
				'/* testInvalid6 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '0',
					),
					array(
						'code'    => T_STRING,
						'content' => 'b_101',
					),
				),
			),
			array(
				'/* testInvalid7 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '1',
					),
					array(
						'code'    => T_STRING,
						'content' => '_e2',
					),
				),
			),
			array(
				'/* testInvalid8 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '1',
					),
					array(
						'code'    => T_STRING,
						'content' => 'e_2',
					),
				),
			),
			array(
				'/* testInvalid9 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '107_925_284',
					),
					array(
						'code'    => T_WHITESPACE,
						'content' => ' ',
					),
					array(
						'code'    => T_DNUMBER,
						'content' => '.88',
					),
				),
			),
			array(
				'/* testInvalid10 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '107_925_284',
					),
					array(
						'code'    => T_COMMENT,
						'content' => '/*comment*/',
					),
					array(
						'code'    => T_DNUMBER,
						'content' => '.88',
					),
				),
			),
			array(
				'/* testCalc1 */',
				array(
					array(
						'code'    => T_LNUMBER,
						'content' => '667_083',
					),
					array(
						'code'    => T_WHITESPACE,
						'content' => ' ',
					),
					array(
						'code'    => T_MINUS,
						'content' => '-',
					),
					array(
						'code'    => T_WHITESPACE,
						'content' => ' ',
					),
					array(
						'code'    => T_LNUMBER,
						'content' => '11',
					),
				),
			),
			array(
				'/* test Calc2 */',
				array(
					array(
						'code'    => T_DNUMBER,
						'content' => '6.674_08e3',
					),
					array(
						'code'    => T_WHITESPACE,
						'content' => ' ',
					),
					array(
						'code'    => T_PLUS,
						'content' => '+',
					),
					array(
						'code'    => T_WHITESPACE,
						'content' => ' ',
					),
					array(
						'code'    => T_LNUMBER,
						'content' => '11',
					),
				),
			),
		);

	}//end dataNoBackfill()


}//end class
