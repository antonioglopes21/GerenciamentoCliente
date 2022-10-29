import { Component, OnInit, ViewChild } from "@angular/core";
import { Cliente } from "../../modelo/cliente";
import { ClienteServico } from "../../servicos/cliente/cliente.servico";
import { Router } from "@angular/router";
@Component({
  selector: "pesquisa-cliente",
  templateUrl: "./pesquisa.cliente.component.html",
  styleUrls: ["./pesquisa.cliente.component.css"]
})
export class PesquisaClienteComponent implements OnInit{

  public clientes: Cliente[];

    ngOnInit(): void {

  }

  constructor(private clienteServico: ClienteServico, private router: Router) {
    this.clienteServico.obterTodosClientes()
      .subscribe(
        clientes => {
          this.clientes = clientes
          console.log(clientes);
      },
        e => {
          console.log(e.error);

        });
  }

  public adicionarCliente() {
    sessionStorage.setItem('clienteSession', "");
    this.router.navigate(['/cadastro-cliente']);
  }

  public deletarCliente(cliente: Cliente) {
    this.clienteServico.deletar(cliente).subscribe(
      clientes => {
        this.clientes = clientes;

      }, e => {
        console.log(e.errors);
      });
  }

  public editarCliente(cliente: Cliente) {
    sessionStorage.setItem('clienteSession', JSON.stringify(cliente));
    this.router.navigate(['/cadastro-cliente']);
  }
}
