<?php
namespace Solaria\Application\Acp\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Element\Input;
use Solaria\Framework\View\Forms\Element\Button;

class SingUpForm extends Form {

  public function __construct() {
    parent::__construct("POST", 'acp/user/sing-up');
    $this->add(new Input('username', 'text', array('placeholder' => 'Username')));
    $this->add(new Input('email', 'text', array('placeholder' => 'Email')));
    $this->add(new Input('password', 'password', array('placeholder' => 'Password')));
    $this->add(new Button('Register'));
  }

}
