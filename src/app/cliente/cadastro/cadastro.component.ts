import { Component, OnInit } from '@angular/core';
import { Cliente } from "../../modelo/cliente";
import { ConsultaCepService } from '../../servicos/cep/consulta.cep.servico';
import { ClienteServico } from '../../servicos/cliente/cliente.servico';

@Component({
  selector: 'app-cadastro',
  templateUrl: './cadastro.component.html',
  styleUrls: ['./cadastro.component.css']
})
export class CadastroComponent implements OnInit {
  public cliente: Cliente;
  public ativar_spinner: boolean;
  public mensagem: string;
  public clienteCadastrado: boolean;

  constructor(private clienteServico: ClienteServico, private cepService: ConsultaCepService) {

  }

  ngOnInit(): void {
    var clienteSession = sessionStorage.getItem('clienteSession');
    if (clienteSession) {
      this.cliente = JSON.parse(clienteSession);
    }
    else {
      this.cliente = new Cliente();
    }
  }
  public cliente_administrador(): boolean {
    return this.clienteServico.cliente_administrador();
  }
  public cadastrar() {
    this.ativar_spinner = true;
    this.clienteServico.cadastrarCliente(this.cliente)
      .subscribe(
        sucess => {
          this.clienteCadastrado = true;
          this.mensagem = "";
          this.ativar_spinner = false;
        },
        err => {
          this.mensagem = err.error;
          this.ativar_spinner = false;
        }
      );
  }

  consultaCEP(cep, form) {
    // Nova variável "cep" somente com dígitos.
    cep = cep.replace(/\D/g, '');
    if (cep != null && cep !== '') {
      this.cepService.consultaCEP(cep)
        .subscribe(dados => {
          this.populaDadosForm(dados, form);
        });
    }
  }
  populaDadosForm(dados, formulario) {
    formulario.form.patchValue({
      estado: dados.uf,
      cidade: dados.localidade,
      bairro: dados.bairro,
      rua: dados.logradouro
    });
  }
}
