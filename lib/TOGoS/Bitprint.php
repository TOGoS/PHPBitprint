<?php

/**
 * Instance is a HashAlgorithm.
 * also has handy static functions.
 */
class TOGoS_Bitprint implements TOGoS_Hash_HashAlgorithm {
	public static function getInstance() {
		return new self();
	}
	
	public function newHashing() {
		return new TOGoS_Bitprint_CalcState();
	}
	
	public static function hashToUrn( $hash ) {
		if( $hash instanceof TOGoS_Bitprint_CalcState ) {
			$hash = $hash->digest();
		}
		if( !is_string($hash) ) {
			throw new Exception("Don't know how to interpret ".gettype($hash)." as bitprint data");
		}
		if( strlen($hash) != 44 ) {
			throw new Exception("Expected 44 bytes, but got ".strlen($hash));
		}
		return "urn:bitprint:".TOGoS_Base32::encode(substr($hash,0,20)).".".TOGoS_Base32::encode(substr($hash,20));
	}
	
	public static function bitprint( $data ) {
		$calcState = new TOGoS_Bitprint_CalcState();
		if( $data instanceof Nife_Blob ) {
			$data->writeTo( array($calcState,'update') );
		} else if( is_scalar($data) ) {
			$calcState->update( (string)$data );
		} else if( method_exists($data,'__toString') ) {
			$calcState->update( $data->__toString() );
		} else {
			throw new Exception("Don't know how to hash this ".gettype($data));
		}
		return $calcState->digest();
	}
	
	public static function bitprintUrn( $data ) {
		return self::hashToUrn( self::bitprint($data) );
	}
}
