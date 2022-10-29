
export class Endereco {
  private _id!: string;
  public get id(): string {
    return this._id;
  }
  public set id(value: string) {
    this._id = value;
  }
  private _idCliente!: string;
  public get idCliente(): string {
    return this._idCliente;
  }
  public set idCliente(value: string) {
    this._idCliente = value;
  }
  private _cep!: string;
  public get cep(): string {
    return this._cep;
  }
  public set cep(value: string) {
    this._cep = value;
  }
  private _estado!: string;
  public get estado(): string {
    return this._estado;
  }
  public set estado(value: string) {
    this._estado = value;
  }
  private _cidade!: string;
  public get cidade(): string {
    return this._cidade;
  }
  public set cidade(value: string) {
    this._cidade = value;
  }
  private _bairro!: string;
  public get bairro(): string {
    return this._bairro;
  }
  public set bairro(value: string) {
    this._bairro = value;
  }
  private _rua!: string;
  public get rua(): string {
    return this._rua;
  }
  public set rua(value: string) {
    this._rua = value;
  }
  private _numero!: string;
  public get numero(): string {
    return this._numero;
  }
  public set numero(value: string) {
    this._numero = value;
  }
}
