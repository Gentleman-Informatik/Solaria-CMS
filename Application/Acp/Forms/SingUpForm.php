<?php
namespace Solaria\Application\Acp\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Element\Input;
use Solaria\Framework\View\Forms\Element\Button;

class SingUpForm extends Form {

  public function __construct($method = "POST", $action = "") {
    parent::__construct($method, $action);
    $this->add(new Input('username', 'text', array('placeholder' => 'Username')));
    $this->add(new Button('Register'));
  }

}
