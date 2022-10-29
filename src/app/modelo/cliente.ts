import {Endereco } from './endereco';
export class Cliente {
  private _id!: number;
  public get id(): number {
    return this._id;
  }
  public set id(value: number) {
    this._id = value;
  }
  private _dtNascimento!: Date;
  public get dtNascimento(): Date {
    return this._dtNascimento;
  }
  public set dtNascimento(value: Date) {
    this._dtNascimento = value;
  }
  private _cpf!: string;
  public get cpf(): string {
    return this._cpf;
  }
  public set cpf(value: string) {
    this._cpf = value;
  }
  private _rg!: string;
  public get rg(): string {
    return this._rg;
  }
  public set rg(value: string) {
    this._rg = value;
  }
  private _telefone!: string;
  public get telefone(): string {
    return this._telefone;
  }
  public set telefone(value: string) {
    this._telefone = value;
  }
  private _email!: string;
  public get email(): string {
    return this._email;
  }
  public set email(value: string) {
    this._email = value;
  }
  private _senha!: string;
  public get senha(): string {
    return this._senha;
  }
  public set senha(value: string) {
    this._senha = value;
  }
  endereco: Endereco;

  constructor() {
    this.endereco = new Endereco();
  }
}
