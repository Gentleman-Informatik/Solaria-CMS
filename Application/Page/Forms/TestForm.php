<?php
namespace Solaria\Application\Page\Forms;

use Solaria\Framework\View\Forms\Form;
use Solaria\Framework\View\Forms\Element\Input;
use Solaria\Framework\View\Forms\Element\Button;

class TestForm {


  public function __construct() {
    $form = new Form();
    $form->add(new Input());
    $form->add(new Button());
    $form->render();
  }

}
