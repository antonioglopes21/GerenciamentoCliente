<?php

namespace Backend\Models;

use Backend\Models\Endereco;

use \PDO;

class Cliente
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

  private static $table = 'cliente';
  public static function select(int $id)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM CLIENTE C
            INNER JOIN ENDERECO E
            ON C.idCliente = E.idCliente
            WHERE C.idCliente = :id';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Nenhum usuário encontrado!");
    }
  }

  public static function verificaExiste(string $email)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM ' . self::$table . ' WHERE email = :email';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      throw new \Exception("Nenhum usuário encontrado!");
    }
  }

  public static function getLogin($data)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM ' . self::$table . ' WHERE email = :email and senha:senha';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':email', $data['email']);
    $stmt->bindValue(':senha', $data['senha']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return $stmt->fetch(\PDO::FETCH_ASSOC);
    } else {
      throw new \Exception("Usuário ou senha inválido");
    }
  }

  public static function selectAll()
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'SELECT * FROM CLIENTE C
            INNER JOIN ENDERECO E
            ON C.idCliente = E.idCliente';
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
    $exists = Cliente::verificaExiste($data['email']);
    if (!$exists) {
      Cliente::insertCliente($data);
    } else {
      $exists = Endereco::verifcaCliente($data['idCliente']);
      if (!$exists) {
        Endereco::insert($data);
      } else {
        return 'Cliente já existe !!';
      }
    }
  }

  public static function insertCliente($data)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'INSERT INTO ' . self::$table . ' (nome,datNascimento,cpf,rg,telefone,email, senha) VALUES (:no, :dt, :cpf,:rg, :tel, :eml, :se)';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':no', $data['nome']);
    $stmt->bindValue(':dt', $data['datNascimento']);
    $stmt->bindValue(':cpf', $data['cpf']);
    $stmt->bindValue(':rg', $data['rg']);
    $stmt->bindValue(':tel', $data['telefone']);
    $stmt->bindValue(':eml', $data['email']);
    $stmt->bindValue(':se', $data['senha']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      // try {
      //   Endereco::insert($data);
      // } catch (\Throwable $th) {
      //   return 'Cliente inserido mas houve erro ao inserir o endereço';
      // }

      return 'Cliente inserido com sucesso!';
    } else {
      throw new \Exception("Falha ao inserir cliente!");
    }
  }

  public static function update($data)
  {
    $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

    $sql = 'UPDATE ' . self::$table . ' SET idCliente =:id,nome =:no,datNascimento =:dt,cpf =:cpf,rg =:rg,telefone =:tel,email  =:eml, senha =:se';
    $stmt = $connPdo->prepare($sql);
    $stmt->bindValue(':id', $data['idCliente']);
    $stmt->bindValue(':no', $data['nome']);
    $stmt->bindValue(':dt', $data['datNascimento']);
    $stmt->bindValue(':cpf', $data['cpf']);
    $stmt->bindValue(':rg', $data['rg']);
    $stmt->bindValue(':tel', $data['telefone']);
    $stmt->bindValue(':eml', $data['email']);
    $stmt->bindValue(':se', $data['senha']);
    $stmt->execute();
    return $stmt->rowCount();
  }

  public static function delete($idCliente)
  {
    try {
      Endereco::delete($idCliente);
      $connPdo = new PDO(self::DRIVE . ':host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);

      $sql = 'DELETE FROM' . self::$table . 'WHERE idCliente =:fk';
      $stmt = $connPdo->prepare($sql);
      $stmt->bindValue(':fk', $idCliente);


      $stmt->execute();
      return 'Cliente deletado  com sucesso!';
    } catch (\Throwable $th) {
      return 'Erro ao deletar cliente';
    }
  }
}