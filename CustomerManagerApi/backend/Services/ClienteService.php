<?php

namespace Backend\Services;

use Backend\Models\Cliente;

class ClienteService
{
  public function get($id = null)
  {
    if ($id) {
      return Cliente::select($id);
    } else {
      return Cliente::selectAll();
    }
  }

  public function verficarcliente()
  {
    $data = $_POST;

    return Cliente::getLogin($data);
  }

  public function post()
  {
    $data = $_POST;

    return Cliente::insert($data);
  }

  public function update()
  {
    $data = $_POST;

    return Cliente::update($data);
  }

  public function delete($id)
  {
    return Cliente::delete($id);
  }
}