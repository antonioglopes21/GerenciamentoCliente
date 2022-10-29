<?php

namespace Backend\Services;

use Backend\Models\Endereco;

class EnderecoService
{
  public function update()
  {
    $data = $_POST;

    return Endereco::update($data);
  }

  public function delete($id)
  {
    return Endereco::delete($id);
  }
}