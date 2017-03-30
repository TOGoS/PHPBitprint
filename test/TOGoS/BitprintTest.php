<?php

class TOGoS_BitprintTest extends PHPUnit_Framework_TestCase
{
	public function testHelloWorldBitprint() {
		$this->assertEquals(
			"urn:bitprint:SQ5HALIG6NCZTLXB7DNI56PXFFQDDVUZ.276TET7NAXG7FVCDQWOENOX4VABJSZ4GBV7QATQ",
			TOGoS_Bitprint::bitprintUrn("Hello, world!") );
	}
	
	public function testA4096Bitprint() {
		$this->assertEquals(
			"urn:bitprint:RRI7W2QLLB7MSXFHJLH2IPPXKONUQYUX.HXIEJQ6V7RMFFB7BR2FHMBMOK65IH5DLVE56WMY",
			TOGoS_Bitprint::bitprintUrn(str_repeat('a',4096)) );
	}
	
	public function testA4097Bitprint() {
		$this->assertEquals(
			"urn:bitprint:GI2E4JPJDQFQPVJBNXSJMKHOEQ4BHQHN.ZFL5VCFN42QGFXBRZVRZ3P25UN7MQ2XCJDGQUWI",
			TOGoS_Bitprint::bitprintUrn(str_repeat('a',4097)) );
	}
}
