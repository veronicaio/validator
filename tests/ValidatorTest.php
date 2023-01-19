<?php


/**
 * 
 * Test class for Veronica Validator
 *
 * @version 5.0.0
 * 
 */

use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    
    public function testLength()
    {
        $this->assertEquals(validator::length('user@example.com'), 16);
        $this->assertEquals(validator::length(123456), 6);
        $this->assertEquals(validator::length(array(
            'a' => 1,
            'b' => 2,
            'c' => 3
        )), 3);
        $this->assertEquals(validator::length(new stdClass()), 0);
        $this->assertEquals(validator::length(null), 0);
        $this->assertEquals(validator::length(false), 0);
        $this->assertEquals(validator::length(true), 0);
        $this->assertEquals(validator::length(0.123), 5);
    }
    
    public function testIsString()
    {
        $this->assertEquals(validator::isstring('user@example.com'), true);
        $this->assertEquals(validator::isstring(''), false);
        $this->assertEquals(validator::isstring(123456), false);
        $this->assertEquals(validator::isstring(4.56), false);
        $this->assertEquals(validator::isstring(true), false);
        $this->assertEquals(validator::isstring(false), false);
        $this->assertEquals(validator::isstring(null), false);
        $this->assertEquals(validator::isstring(array(
            'a' => 1,
            'b' => 2
        )), false);
        $this->assertEquals(validator::isstring(new stdClass()), false);
    }
    
    public function testIsEmail()
    {
        $this->assertEquals(validator::isemail('user@example.com'), true);
        $this->assertEquals(validator::isemail('user-example.com'), false);
        $this->assertEquals(validator::isemail(''), false);
        $this->assertEquals(validator::isemail(123456), false);
        $this->assertEquals(validator::isemail(4.56), false);
        $this->assertEquals(validator::isemail(true), false);
        $this->assertEquals(validator::isemail(false), false);
        $this->assertEquals(validator::isemail(null), false);
        $this->assertEquals(validator::isemail(array(
            'a' => 1,
            'b' => 2
        )), false);
        $this->assertEquals(validator::isemail(new stdClass()), false);
    }
    
    public function testIsArray()
    {
        $this->assertEquals(validator::isarray(array(
            'a' => 1,
            'b' => 2
        )), true);
        $this->assertEquals(validator::isarray(array()), false);
        $this->assertEquals(validator::isarray('user@example.com'), false);
        $this->assertEquals(validator::isarray(''), false);
        $this->assertEquals(validator::isarray(123456), false);
        $this->assertEquals(validator::isarray(4.56), false);
        $this->assertEquals(validator::isarray(true), false);
        $this->assertEquals(validator::isarray(false), false);
        $this->assertEquals(validator::isarray(null), false);
        $this->assertEquals(validator::isarray(new stdClass()), false);
    }
    
    public function testIsNumeric()
    {
        $this->assertEquals(validator::isnumeric(123456), true);
        $this->assertEquals(validator::isnumeric(4.56), true);
        $this->assertEquals(validator::isnumeric('123456'), true);
        $this->assertEquals(validator::isnumeric('4.56'), true);
        $this->assertEquals(validator::isnumeric(array()), false);
        $this->assertEquals(validator::isnumeric('user@example.com'), false);
        $this->assertEquals(validator::isnumeric(''), false);
        $this->assertEquals(validator::isnumeric(true), false);
        $this->assertEquals(validator::isnumeric(false), false);
        $this->assertEquals(validator::isnumeric(null), false);
        $this->assertEquals(validator::isnumeric(array(
            'a' => 1,
            'b' => 2
        )), false);
        $this->assertEquals(validator::isnumeric(new stdClass()), false);
    }
    
    public function testSubStr()
    {
        $this->assertEquals(validator::substr('abcdefj', 0, 3), 'abc');
        $this->assertEquals(validator::substr('abcdefj', 0, 3, '...'), 'abc...');
        $this->assertEquals(validator::substr(123456, 0, 3), '123');
        $this->assertEquals(validator::substr(12.56, 0, 3), '12.');
        $this->assertEquals(validator::substr('123456', 0), '123456');
        $this->assertEquals(validator::substr('123456'), '123456');
        $this->assertEquals(validator::substr('123456', 0, -45), '123456');
        $this->assertEquals(validator::substr('123456', -99, 100), '123456');
        $this->assertEquals(validator::substr(array()), '');
        $this->assertEquals(validator::substr(array(
            'a' => 'b'
        )), '');
        $this->assertEquals(validator::substr(null), '');
        $this->assertEquals(validator::substr(new stdClass()), '');
        $this->assertEquals(validator::substr(false), '');
        $this->assertEquals(validator::substr(true), '');
        $this->assertEquals(validator::substr(123456, null, null), '123456');
    }
    
    public function testTruncate()
    {
        $this->assertEquals(validator::truncate('abcdefj', 3, false), 'abc');
        $this->assertEquals(validator::truncate('abcdefj', 3), 'abc...');
        $this->assertEquals(validator::truncate('abcdefj', 3, 47), 'abc47');
        $this->assertEquals(validator::truncate('abcdefj', 3, null), 'abc');
        $this->assertEquals(validator::truncate(array(
            'a' => 'b'
        ), 0), '');
        $this->assertEquals(validator::truncate(new stdClass(), 0), '');
        $this->assertEquals(validator::truncate(null, 0), '');
        $this->assertEquals(validator::truncate(123456, 3), '123...');
        $this->assertEquals(validator::truncate(12.3456, 5), '12.34...');
        $this->assertEquals(validator::truncate(12.3456, 5, '--'), '12.34--');
        $this->assertEquals(validator::truncate(false, 5, '--'), '');
        $this->assertEquals(validator::truncate(true, 5, '--'), '');
    }
    
    public function testIsTelephone()
    {
        $this->assertEquals(validator::istelephone('0675005588'), true);
        $this->assertEquals(validator::istelephone('(067)500-55-88'), true);
        $this->assertEquals(validator::istelephone(675005588), true);
        $this->assertEquals(validator::istelephone('abcdefj'), false);
        $this->assertEquals(validator::istelephone(null), false);
        $this->assertEquals(validator::istelephone(false), false);
        $this->assertEquals(validator::istelephone(true), false);
        $this->assertEquals(validator::istelephone(array()), false);
        $this->assertEquals(validator::istelephone(new stdClass()), false);
        $this->assertEquals(validator::istelephone(1234.56), false);
    }
    
    public function testIsSkype()
    {
        $this->assertEquals(validator::isskype('0675005588'), true);
        $this->assertEquals(validator::isskype('skypeuser'), true);
        $this->assertEquals(validator::isskype(675005588), true);
        $this->assertEquals(validator::isskype('abcdefj'), true);
        $this->assertEquals(validator::isskype(null), false);
        $this->assertEquals(validator::isskype(false), false);
        $this->assertEquals(validator::isskype(true), false);
        $this->assertEquals(validator::isskype(array()), false);
        $this->assertEquals(validator::isskype(new stdClass()), false);
        $this->assertEquals(validator::isskype(1234.56), true);
    }
    
    public function testToLowwer()
    {
        $this->assertEquals(validator::tolower('ABCDEFG'), 'abcdefg');
        $this->assertEquals(validator::tolower(123456), 123456);
        $this->assertEquals(validator::tolower(false), '');
        $this->assertEquals(validator::tolower(true), '');
        $this->assertEquals(validator::tolower(array()), '');
        $this->assertEquals(validator::tolower(null), '');
        $this->assertEquals(validator::tolower(12.46), 12.46);
        $this->assertEquals(validator::tolower(new stdClass()), '');
    }
    
    public function testToUpper()
    {
        $this->assertEquals(validator::toupper('abcdefg'), 'ABCDEFG');
        $this->assertEquals(validator::toupper(123456), 123456);
        $this->assertEquals(validator::toupper(false), '');
        $this->assertEquals(validator::toupper(true), '');
        $this->assertEquals(validator::toupper(array()), '');
        $this->assertEquals(validator::toupper(null), '');
        $this->assertEquals(validator::toupper(12.46), 12.46);
        $this->assertEquals(validator::toupper(new stdClass()), '');
    }
    
    public function testForSms()
    {
        $this->assertEquals(validator::forsms('Привет мир!'), 'Privet mir!');
        $this->assertEquals(validator::forsms(123456), 123456);
        $this->assertEquals(validator::toupper(false), '');
        $this->assertEquals(validator::toupper(true), '');
        $this->assertEquals(validator::toupper(array()), '');
        $this->assertEquals(validator::toupper(null), '');
        $this->assertEquals(validator::toupper(12.46), 12.46);
        $this->assertEquals(validator::toupper(new stdClass()), '');
    }
    
    public function testIsTime()
    {
        $this->assertEquals(validator::istime('12:56'), true);
        $this->assertEquals(validator::istime(12.56), true);
        $this->assertEquals(validator::istime('00:00'), true);
        $this->assertEquals(validator::istime('44:56'), false);
        $this->assertEquals(validator::istime(32.56), false);
        $this->assertEquals(validator::istime(array()), false);
        $this->assertEquals(validator::istime(null), false);
        $this->assertEquals(validator::istime(false), false);
        $this->assertEquals(validator::istime(true), false);
        $this->assertEquals(validator::istime(1232344), false);
        $this->assertEquals(validator::istime('1232344'), false);
        $this->assertEquals(validator::istime(new stdClass()), false);
    }
    
    public function testToAscii()
    {
        $this->assertEquals(validator::toascii('Б'), 1041);
        $this->assertEquals(validator::toascii(4), 52);
        $this->assertEquals(validator::toascii(4.55), 52);
        $this->assertEquals(validator::toascii(array()), 0);
        $this->assertEquals(validator::toascii(null), 0);
        $this->assertEquals(validator::toascii(false), 0);
        $this->assertEquals(validator::toascii(true), 0);
        $this->assertEquals(validator::toascii(new stdClass()), 0);
    }
    
    public function testByAscii()
    {
        $this->assertEquals(validator::byascii(1041), 'Б');
        $this->assertEquals(validator::byascii(52), 4);
        $this->assertEquals(validator::byascii(52.56), 4);
        $this->assertEquals(validator::byascii(array()), '');
        $this->assertEquals(validator::byascii(null), '');
        $this->assertEquals(validator::byascii(false), '');
        $this->assertEquals(validator::byascii(true), '');
        $this->assertEquals(validator::byascii(new stdClass()), '');
    }
    
    public function testConvertHtml()
    {
        $this->assertEquals(validator::convertHtml('<a href="yandex.ua">yandex.ua</a>'), '&lt;a href=&quot;yandex.ua&quot;&gt;yandex.ua&lt;/a&gt;');
        $this->assertEquals(validator::convertHtml(123456), '123456');
        $this->assertEquals(validator::convertHtml(12.3456), '12.3456');
        $this->assertEquals(validator::convertHtml(array()), '');
        $this->assertEquals(validator::convertHtml(null), '');
        $this->assertEquals(validator::convertHtml(false), '');
        $this->assertEquals(validator::convertHtml(true), '');
        $this->assertEquals(validator::convertHtml(new stdClass()), '');
    }
    
    public function testRemoveHtml()
    {
        $this->assertEquals(validator::removeHtml('<a href="yandex.ua">yandex.ua</a>'), 'yandex.ua');
        $this->assertEquals(validator::removeHtml(123456), '123456');
        $this->assertEquals(validator::removeHtml(12.3456), '12.3456');
        $this->assertEquals(validator::removeHtml(array()), '');
        $this->assertEquals(validator::removeHtml(null), '');
        $this->assertEquals(validator::removeHtml(false), '');
        $this->assertEquals(validator::removeHtml(true), '');
        $this->assertEquals(validator::removeHtml(new stdClass()), '');
    }
    
    public function testUnRemoveHtml()
    {
        $this->assertEquals(validator::unremoveHtml('&lt;a href=&quot;yandex.ua&quot;&gt;yandex.ua&lt;/a&gt;'), '<a href="yandex.ua">yandex.ua</a>');
        $this->assertEquals(validator::unremoveHtml(123456), '123456');
        $this->assertEquals(validator::unremoveHtml(12.3456), '12.3456');
        $this->assertEquals(validator::unremoveHtml(array()), '');
        $this->assertEquals(validator::unremoveHtml(null), '');
        $this->assertEquals(validator::unremoveHtml(false), '');
        $this->assertEquals(validator::unremoveHtml(true), '');
        $this->assertEquals(validator::unremoveHtml(new stdClass()), '');
    }
    
    public function testName()
    {
        $this->assertEquals(validator::name('иВаНоВ СерГЕЙ виКтоРович'), 'Иванов Сергей Викторович');
        $this->assertEquals(validator::name('иВаНоВ-петров СерГЕЙ виКтоРович'), 'Иванов-Петров Сергей Викторович');
        $this->assertEquals(validator::name(12.3456), '12.3456');
        $this->assertEquals(validator::name(array()), '');
        $this->assertEquals(validator::name(null), '');
        $this->assertEquals(validator::name(false), '');
        $this->assertEquals(validator::name(true), '');
        $this->assertEquals(validator::name(new stdClass()), '');
    }
    
    public function testIsMbString() 
    {
        $this->assertEquals(extension_loaded('mbstring') , true);
    }
    
}


