<?php

include_once __DIR__."/../vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use intrawarez\feiertage\Feiertag;

class FeiertagTest extends TestCase {
	
	public function test2016 () {
	
		$jahr = 2016;
		
		$this->assertEquals(Feiertag::Neujahrstag($jahr)->getDate(), 			date_create("2016-01-01"));
		$this->assertEquals(Feiertag::HeiligeDreiKoenige($jahr)->getDate(), 	date_create("2016-01-06"));
		$this->assertEquals(Feiertag::GruenDonnerstag($jahr)->getDate(),		date_create("2016-03-24"));
		$this->assertEquals(Feiertag::Karfreitag($jahr)->getDate(), 			date_create("2016-03-25"));
		$this->assertEquals(Feiertag::OsterSonntag($jahr)->getDate(), 			date_create("2016-03-27"));
		$this->assertEquals(Feiertag::OsterMontag($jahr)->getDate(), 			date_create("2016-03-28"));
		$this->assertEquals(Feiertag::TagDerArbeit($jahr)->getDate(), 			date_create("2016-05-01"));
		$this->assertEquals(Feiertag::ChristiHimmelfahrt($jahr)->getDate(), 	date_create("2016-05-05"));
		$this->assertEquals(Feiertag::PfingstSonntag($jahr)->getDate(), 		date_create("2016-05-15"));
		$this->assertEquals(Feiertag::PfingstMontag($jahr)->getDate(), 			date_create("2016-05-16"));
		$this->assertEquals(Feiertag::Fronleichnam($jahr)->getDate(), 			date_create("2016-05-26"));
		$this->assertEquals(Feiertag::AugsburgerFriedensfest($jahr)->getDate(), date_create("2016-08-08"));
		$this->assertEquals(Feiertag::MariaeHimmelfahrt($jahr)->getDate(), 		date_create("2016-08-15"));
		$this->assertEquals(Feiertag::TagDerDeutschenEinheit($jahr)->getDate(), date_create("2016-10-03"));
		$this->assertEquals(Feiertag::Reformationstag($jahr)->getDate(), 		date_create("2016-10-31"));
		$this->assertEquals(Feiertag::Allerheiligen($jahr)->getDate(), 			date_create("2016-11-01"));
		$this->assertEquals(Feiertag::BussUndBettag($jahr)->getDate(), 			date_create("2016-11-16"));
		$this->assertEquals(Feiertag::ErsterWeihnachtstag($jahr)->getDate(), 	date_create("2016-12-25"));
		$this->assertEquals(Feiertag::ZweiterWeihnachtstag($jahr)->getDate(),	date_create("2016-12-26"));
		
	}
	
	
}