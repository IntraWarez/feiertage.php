<?php

include_once __DIR__."/../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use intrawarez\feiertage\Feiertage;
use intrawarez\feiertage\Feiertag;

class FeiertageTest extends TestCase {
	
	public function testJahr () {
		
		$date = new \DateTime();
		
		$this->assertEquals(intval($date->format("Y")), Feiertage::Jahr());
		
		$date = new \DateTime("666-06-06");
		
		$this->assertEquals(intval($date->format("Y")), Feiertage::Jahr($date));
		$this->assertEquals(666, Feiertage::Jahr($date));
		
	}
	
	public function testOf () {
		
		$date = new \DateTime();
		$jahr = intval($date->format("Y"));
		
		$feiertage = Feiertage::of();
		
		$this->assertEquals($jahr, $feiertage->getJahr());
		
		$feiertage = Feiertage::of(666);
		
		$this->assertEquals(666, $feiertage->getJahr());
		
	}
	
	public function testCheck () {

		$this->assertFalse(Feiertage::check(123456789));
		$this->assertTrue(Feiertage::check(Feiertag::Allerheiligen(2016)));
		
		$date = new \DateTime();
		$feiertage = Feiertage::of(Feiertage::Jahr($date));
		
		$this->assertEquals($feiertage->contains($date), Feiertage::check($date));
		
	}
	
	public function testWhich () {
		
		$jahr = Feiertage::Jahr();
		
		$expected = Feiertag::Allerheiligen($jahr);
		
		$optional = Feiertage::which(Feiertag::Allerheiligen($jahr));
		$this->assertTrue($optional->isPresent());
		$this->assertFalse($optional->isAbsent());
		$this->assertEquals($expected, $optional->get());
		
		$optional = Feiertage::which(Feiertag::Allerheiligen($jahr)->getDate());
		$this->assertTrue($optional->isPresent());
		$this->assertFalse($optional->isAbsent());
		$this->assertEquals($expected, $optional->get());
		
		$optional = Feiertage::which(123456789);
		$this->assertTrue($optional->isAbsent());
		$this->assertFalse($optional->isPresent());
		
	}
	
	/**
	 * Tests holidays for 2016.
	 * Also checks ArrayAccess implementation.
	 */
	public function test2016 () {
		
		$ft = Feiertage::of(2016);
		
		$this->assertEquals($ft[Feiertag::NEUJAHRSTAG]->getDate(), 			date_create("2016-01-01"));
		$this->assertEquals($ft[Feiertag::HEILIGEDREIKOENIGE]->getDate(), 	date_create("2016-01-06"));
		$this->assertEquals($ft[Feiertag::GRUENDONNERSTAG]->getDate(),		date_create("2016-03-24"));
		$this->assertEquals($ft[Feiertag::KARFREITAG]->getDate(), 			date_create("2016-03-25"));
		$this->assertEquals($ft[Feiertag::OSTERSONNTAG]->getDate(), 			date_create("2016-03-27"));
		$this->assertEquals($ft[Feiertag::OSTERMONTAG]->getDate(), 			date_create("2016-03-28"));
		$this->assertEquals($ft[Feiertag::TAGDERARBEIT]->getDate(), 			date_create("2016-05-01"));
		$this->assertEquals($ft[Feiertag::CHRISTIHIMMELFAHRT]->getDate(), 	date_create("2016-05-05"));
		$this->assertEquals($ft[Feiertag::PFINGSTSONNTAG]->getDate(), 		date_create("2016-05-15"));
		$this->assertEquals($ft[Feiertag::PFINGSTMONTAG]->getDate(), 			date_create("2016-05-16"));
		$this->assertEquals($ft[Feiertag::FRONLEICHNAM]->getDate(), 			date_create("2016-05-26"));
		$this->assertEquals($ft[Feiertag::AUGSBURGERFRIEDENSFEST]->getDate(), date_create("2016-08-08"));
		$this->assertEquals($ft[Feiertag::MARIAEHIMMELFAHRT]->getDate(), 		date_create("2016-08-15"));
		$this->assertEquals($ft[Feiertag::TAGDERDEUTSCHENEINHEIT]->getDate(), date_create("2016-10-03"));
		$this->assertEquals($ft[Feiertag::REFORMATIONSTAG]->getDate(), 		date_create("2016-10-31"));
		$this->assertEquals($ft[Feiertag::ALLERHEILIGEN]->getDate(), 			date_create("2016-11-01"));
		$this->assertEquals($ft[Feiertag::BUSSUNDBETTAG]->getDate(), 			date_create("2016-11-16"));
		$this->assertEquals($ft[Feiertag::ERSTERWEIHNACHTSTAG]->getDate(), 	date_create("2016-12-25"));
		$this->assertEquals($ft[Feiertag::ZWEITERWEIHNACHTSTAG]->getDate(),	date_create("2016-12-26"));
				
	}

	/**
	 * Tests if IteratorAggregate works properly
	 */
	public function testIteratorAggregate () {
		
		foreach (Feiertage::of(2016) as $key => $value) {
			
			$this->assertTrue(is_int($key));
			$this->assertTrue($value instanceof Feiertag);
			
		}
		
		
	}
	
	/**
	 * Tests the immutability of a Feiertage instance
	 */
	public function testImmutability () {
		
		$ft = Feiertage::of(2016);
		
		$this->assertEquals($ft[Feiertag::NEUJAHRSTAG]->getDate(), date_create("2016-01-01"));
		
		$ft[Feiertag::NEUJAHRSTAG] = date_create("2016-01-01");
		
		$this->assertEquals($ft[Feiertag::NEUJAHRSTAG]->getDate(), date_create("2016-01-01"));
		
		unset($ft[Feiertag::NEUJAHRSTAG]);

		$this->assertEquals($ft[Feiertag::NEUJAHRSTAG]->getDate(), date_create("2016-01-01"));
		
	}
	
// 	public function testWhich () {
		
// 		$which = Feiertage::which(new DateTime("2016-08-08"));
		
// 		$this->assertTrue($which->isPresent());
// 		$this->assertEquals(Feiertag::AUGSBURGERFRIEDENSFEST, $which->get()->getKey());
		
// 	}
	
}

?>