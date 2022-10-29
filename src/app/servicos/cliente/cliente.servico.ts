import { Injectable, Inject } from "@angular/core";
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Observable } from "rxjs";
import { Cliente } from "../../modelo/cliente";

@Injectable({
  providedIn: "root"
})

export class ClienteServico {

  private baseURL: string;
  private _cliente: Cliente;

  set cliente(cliente: Cliente) {
    sessionStorage.setItem("cliente-autenticado", JSON.stringify(cliente));
    this._cliente = cliente;
  }

  get cliente(): Cliente {
    let cliente_json = sessionStorage.getItem("cliente-autenticado");
    this._cliente = JSON.parse(cliente_json);
    return this._cliente;
  }

  public cliente_autenticado(): boolean {
    return this._cliente != null && this._cliente.email != "" && this._cliente.senha != "";
  }

  public limpa_sessao() {
    sessionStorage.setItem("cliente-autenticado", "");
    this._cliente = null;
  }

  get headers(): HttpHeaders {
    return new HttpHeaders().set('content-type', 'application/json');
  }

  constructor(private http: HttpClient, @Inject('BASE_URL') baseUrl: string) {
    this.baseURL = 'http://localhost/CustomerManagerApi/public_html/';
  }
  public verificaCliente(cliente: Cliente): Observable<Cliente> {
    const headers = new HttpHeaders().set('content-type', 'application/json');

    var body = {
      email: cliente.email,
      senha: cliente.senha
    }

    return this.http.post<Cliente>(this.baseURL + "api/cliente/VerficarCliente", body, { headers })
  }

  public cadastrarCliente(cliente: Cliente): Observable<Cliente> {

    return this.http.post<Cliente>(this.baseURL + "api/cliente", JSON.stringify(cliente), { headers: this.headers });
  }
  public atualizar(cliente: Cliente): Observable<Cliente> {

    return this.http.post<Cliente>(this.baseURL + "api/cliente/update", JSON.stringify(cliente), { headers: this.headers });
  }

  public deletar(cliente: Cliente): Observable<Cliente[]> {

    return this.http.post<Cliente[]>(this.baseURL + "api/cliente/delete", JSON.stringify(cliente), { headers: this.headers });
  }

  public obterTodosClientes(): Observable<Cliente[]> {
    return this.http.get<Cliente[]>(this.baseURL + "api/cliente");
  }
}
