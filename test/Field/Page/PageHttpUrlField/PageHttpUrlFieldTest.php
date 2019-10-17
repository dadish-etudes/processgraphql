<?php

namespace ProcessWire\GraphQL\Test\Field\Page\Fieldtype;

use \ProcessWire\GraphQL\Utils;
use \ProcessWire\GraphQL\Test\GraphQLTestCase;

class PageHttpUrlFieldTest extends GraphQLTestCase {

  const accessRules = [
    'login' => 'admin',
    'legalTemplates' => ['skyscraper'],
    'legalPageFields' => ['httpUrl'],
  ];

	
  public function testValue()
  {
  	$skyscraper = Utils::pages()->get("template=skyscraper");
  	$query = "{
  		skyscraper (s: \"id=$skyscraper->id\") {
  			list {
  				httpUrl
  			}
  		}
  	}";
  	$res = self::execute($query);
  	$this->assertEquals($skyscraper->httpUrl, $res->data->skyscraper->list[0]->httpUrl, 'Retrieves `httpUrl` field of the page.');
  }

}