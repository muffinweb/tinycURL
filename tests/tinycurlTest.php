<?php



use Muffinweb\tinyCURL;
use Muffinweb\tinyCURLException;
use PHPUnit\Framework\TestCase;


class tinycurlTest extends TestCase
{
    public function testIfCanTinyCurlCreateRequest(){
        try {
            $curl = new tinyCURL();
            $info = $curl->get('https://ntv.com.tr')->info();
            $this->assertTrue($info['http_code'] == 200, "Request successfully created");
        } catch (tinyCURLException $e){
            $this->assertTrue(false, "Url entered invalid");
        }
    }
}
