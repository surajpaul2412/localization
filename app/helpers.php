<?php

use Illuminate\Http\Request;
use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;

function switchCurrency($amt) {
	$changeCurr = Session::get('currency')??'INR';
	$currencyObj = Currency::convert()->from('INR')->to($changeCurr)->amount($amt)->round(2)->get();
	return $currencyObj;
}

function dynamicLang($word){
	$selectedLang = App::getLocale()??'en';
	return GoogleTranslate::trans($word, $selectedLang , 'en');
}

function currencies() {
	$currencies = DB::table('currencies')->whereStatus(1)->get();
	return $currencies;
}

function languages() {
	$languages = DB::table('languages')->whereStatus(1)->get();
	return $languages;
}

?>