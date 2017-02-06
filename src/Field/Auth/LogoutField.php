<?php

namespace ProcessWire\GraphQL\Field\Auth;

use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Execution\ResolveInfo;
use ProcessWire\GraphQL\Type\Object\AuthResponseType;
use ProcessWire\WireData;
use ProcessWire\Session;

class LogoutField extends AbstractField {

  public function getType()
  {
    return new NonNullType(new AuthResponseType());
  }

  public function getName()
  {
    return 'logout';
  }

  public function getDescription()
  {
    return 'Allows you to logout from the app.';
  }

  public function resolve($value, array $args, ResolveInfo $info)
  {
    $session = \ProcessWire\wire('session');
    $session = $session->logout();
    $response = new WireData();
    if ($session instanceof Session) {
      $response->statusCode = 200;
      $response->message = 'Successful logout!';
    } else {
      $response->statusCode = 500;
      $response->message = 'Could not logout.';
    }
    return $response;
  }

}