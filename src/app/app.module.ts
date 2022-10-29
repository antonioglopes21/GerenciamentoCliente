import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './cliente/login/login.component';
import { CadastroComponent } from './cliente/cadastro/cadastro.component';
import { PesquisaClienteComponent } from './cliente/pesquisa/pesquisa.usuario.component';
import { GuardaRotas } from './autorizacao/guarda.rotas';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    RouterModule.forRoot([
      { path: '', component: HomeComponent, pathMatch: 'full' },
      { path: 'entrar', component: LoginComponent },
      { path: 'cadastro-cliente', component: CadastroComponent },
      { path: 'pesquisar-cliente', component: PesquisaClienteComponent, canActivate: [GuardaRotas] },
    ])
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
