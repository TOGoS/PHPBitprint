<?php

class TOGoS_Bitprint_CalcState implements TOGoS_Hash_Hashing
{
	protected $sha1Hashing;
	protected $tigerTreeHashing;
	
	public function __construct() {
		$this->sha1Hashing = new TOGoS_Hash_NativeHashing('sha1');
		$this->tigerTreeHashing = TOGoS_TreeHasher::tigerTree()->newHashing();
	}
	
	public function reset() {
		$this->sha1Hashing->reset();
		$this->tigerTreeHashing->reset();
	}
	
	public function update( $data ) {
		$this->sha1Hashing->update( $data );
		$this->tigerTreeHashing->update( $data );
	}
	
	public function digest() {
		return $this->sha1Hashing->digest().$this->tigerTreeHashing->digest();
	}
}
