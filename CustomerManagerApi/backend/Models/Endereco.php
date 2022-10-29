<?php

namespace Backend\Models;

use \PDO;

class Endereco
{
  /**
   * Nome do drive de conexão
   * @var string
   */
  const DRIVE = 'mysql';
  /**
   * Host de conexão com o banco de dados
   * @var string
   */
  const HOST = 'localhost';

  /**
   * Nome do banco de dados
   * @var string
   */
  const NAME = 'customermanagerdb';

  /**
   * Usuário do banco
   * @var string
   */
  const USER = 'root';

  /**
   * Senha de acesso ao banco de dados
   * @var string
   */
  const PASS = '';

  private static $table = 'endereco';
  public static function select(int $id)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM ' . self::$table . ' WHERE idEndereco = :id';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum endereco encontrado!");
    }
  }

  public static function verifcaCliente(int $id)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM ' . self::$table . ' WHERE idCliente = :id';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      throw new \Exception("Nenhum cliente encontrado!");
    }
  }

  public static function selectAll()
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM ' . self::$table;
    $stmt = $connPdo->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum usuário encontrado!");
    }
  }

  public static function insert($data)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'INSERT INTO ' . self::$table . ' (idCliente,cep,estado,cidade,bairro,rua,numero) VALUES (:id,:cep, :uf, :cid,:bar, :rua, :num)';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $data['idCliente']);
    $stmt->bindValue(':cep', $data['cep']);
    $stmt->bindValue(':uf', $data['estado']);
    $stmt->bindValue(':cid', $data['cidade']);
    $stmt->bindValue(':bar', $data['bairro']);
    $stmt->bindValue(':rua', $data['rua']);
    $stmt->bindValue(':num', $data['numero']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

      return 'Usuário(a) inserido com sucesso!';
    } else {
      throw new \Exception("Falha ao inserir usuário(a)!");
    }
  }

  public static function update($data)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'UPDATE ' . self::$table . ' SET idEndereco =:id,idCliente =:fk,cep =:cep,uf =:estado,cid =:cidade,bar =:bairro,rua =:rua,num =:numero';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $data['idEndereco']);
    $stmt->bindValue(':fk', $data['idCliente']);
    $stmt->bindValue(':cep', $data['cep']);
    $stmt->bindValue(':uf', $data['estado']);
    $stmt->bindValue(':cid', $data['cidade']);
    $stmt->bindValue(':bar', $data['bairro']);
    $stmt->bindValue(':rua', $data['rua']);
    $stmt->bindValue(':num', $data['numero']);
    $stmt->execute();
    return $stmt->rowCount();
  }

  public static function delete($idCliente)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'DELETE FROM' . self::$table . 'WHERE idCliente =:fk';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':fk', $idCliente);

    try {
      $stmt->execute();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public static function deleteEnderco($id)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'DELETE FROM' . self::$table . 'WHERE idEndereco =:id';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $id);

    try {
      $stmt->execute();
      return 'Endereço deletado com sucesso!';
    } catch (\Throwable $th) {
      return 'Erro ao deletar endereço';
    }
  }
}