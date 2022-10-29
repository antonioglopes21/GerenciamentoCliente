import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Cliente } from '../modelo/cliente';
import { ClienteServico } from '../servicos/cliente/cliente.servico';

@Component({
  selector: 'app-nav-menu',
  templateUrl: './nav-menu.component.html',
  styleUrls: ['./nav-menu.component.css']
})
export class NavMenuComponent implements OnInit {
  isExpanded = false;

  ngOnInit(): void {
  }
  constructor(private router: Router, private clienteServico: ClienteServico) {

  }
  public clienteLogado(): boolean {
    return this.clienteServico.cliente_autenticado();
  }

  public cliente_administrador(): boolean {
    return this.clienteServico.cliente_administrador();
  }

  sair() {
    this.clienteServico.limpa_sessao();
    this.router.navigate(['/']);
  }

  get cliente() {
    return this.clienteServico.cliente;
  }

  collapse() {
    this.isExpanded = false;
  }

  toggle() {
    this.isExpanded = !this.isExpanded;
  }

  public editar() {
    sessionStorage.setItem('clienteSession', JSON.stringify(this.cliente));
    this.router.navigate(['/cadastro-cliente']);
  }
}
