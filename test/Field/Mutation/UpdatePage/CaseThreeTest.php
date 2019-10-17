<?php

/**
 * If everything ok, updateSkyscraper should
 * update a skyscraper page
 */

namespace ProcessWire\GraphQL\Test\Field\Mutation\CreatePage;

use \ProcessWire\GraphQL\Utils;
use \ProcessWire\GraphQL\Test\GraphQLTestCase;

class UpdatePageCaseThreeTest extends GraphQLTestCase {

  const accessRules = [
    'login' => 'admin',
    'legalTemplates' => ['skyscraper'],
    'legalFields' => ['title', 'height', 'floors', 'body'],
  ];

	
  public function testValue()
  {
  	$skyscraper = Utils::pages()->get("template=skyscraper");
  	$query = 'mutation updatePage ($id: ID!, $page: SkyscraperUpdateInput!) {
  		skyscraper: updateSkyscraper (id: $id, page: $page) {
  			name
  			id
        title
        height
        floors
        body
  		}
  	}';
  	$variables = [
  		"page" => [
				"title" => "Updated Building Sky",
        "height" => 123,
        "floors" => 13,
        "body" => "Everyone has a plan until they get the first hit."
  		],
      "id" => $skyscraper->id
  	];
    $res = self::execute($query, $variables);
    $this->assertEquals($variables['page']['title'], $res->data->skyscraper->title, 'updateSkyscraper returns updated value of the `title`.');
  	$this->assertEquals($variables['page']['title'], $skyscraper->title, 'updateSkyscraper updates value of the `title`.');
  }

}