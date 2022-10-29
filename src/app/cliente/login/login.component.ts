import { Component, OnInit } from '@angular/core';
import { Cliente } from "../../modelo/cliente";
import { Router, ActivatedRoute } from "@angular/router";
import { ClienteServico } from "../../servicos/cliente/cliente.servico";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  public cliente;
  public returnUrl: string;
  public mensagem: string;
  public ativar_spinner: boolean;
  constructor(private router: Router, private activatedRouter: ActivatedRoute, private clienteServico: ClienteServico) {
  }
  ngOnInit(): void {
    this.returnUrl = this.activatedRouter.snapshot.queryParams['returnUrl'];
    this.cliente = new Cliente();
  }
  entrar() {
    this.ativar_spinner = true;
    this.clienteServico.verificaCliente(this.cliente).subscribe(cliente_json => {
      this.clienteServico.cliente = cliente_json;
      //sessionStorage.setItem("cliente autenticado", "1");
      //sessionStorage.setItem("email-cliente", clienteRetorno.email);
      if (this.returnUrl == null) {
        this.router.navigate(['/']);
      }
      else {
        this.router.navigate([this.returnUrl]);
      }
    }, err => {
      console.log(err.error);
      this.mensagem = err.error;
      this.ativar_spinner = false;
    });
  }
}
