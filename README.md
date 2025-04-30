# 🛠️ Auditoria de Gravações de atendimento de Chamados  
_Laravel App_ 


Aplicação web desenvolvida em Laravel para análise e auditoria de chamados técnicos com base em dados oriundos de planilha. Projeto ideal para controle de qualidade e indicadores operacionais de atendimento técnico.

## 🚀 Funcionalidades

### 📊 Indicadores de Chamadas
- Total de Chamadas / Ligações
- Chamadas Atendidas
- Chamadas Interrompidas
- Chamadas Não Atendidas
- Chamadas de Teste de URA
- Chamadas Abandonadas
- Chamadas por Engano

### 🛠️ Tipo de Ações Realizadas
- Abertura de Chamados
- Corretiva
- Informações
- Sem Ação (Não atendida, Teste, Abandono, Engano)
- Ações Incompletas / Inconclusivas
- Encaminhamentos N2 e N3
- Cancelamento de Chamado

### 📌 Situação do Chamado
- Pendente
- Fechado OK
- Teste
- Sem Comunicação
- Fechado NOK
- Sem Chamado

### 🌐 Acesso Remoto por Cliente
- Total de Chamados
- Total ANA
- Total TRE-CE
- Total SGG
- Total MRE
- Total com Acesso Remoto

### 📈 Relatórios Detalhados
- Total de chamados por mês e categoria
- Total de chamados por agente
- Chamados fechados OK por agente
- Total por tipo de chamado
- Ranking de tipo de chamado
- Total de chamados por usuário
- Ranking de chamados por usuário
- Total de chamados por faixa de horário:
  - Manhã (06:00 - 11:59)
  - Tarde (12:00 - 17:59)
  - Noite (18:00 - 23:59)
  - Madrugada (00:00 - 05:59)
- Lista de atendimentos com espera superior a 15 segundos

### ✅ Regras de Qualidade Monitoradas
- 90% dos chamados do MRE devem ser atendidos
- Desistência não é glosada
- Tempo máximo de espera: 15 segundos
- Distribuição igualitária de chamados entre agentes
- TRE-CE glosa por ausência de acesso remoto
- Meta de 60% dos chamados atendidos no N1

## 🧰 Tecnologias Utilizadas

- Laravel 10.x
- MySQL
- Laragon (ambiente local leve e prático)
- Blade (ou Vue.js no futuro, opcional)
- Bootstrap 5 (responsividade)
- Eloquent ORM
- Seeders & Migrations

## 📦 Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Laragon (ou ambiente equivalente)
- Node.js e NPM (para front futuramente)

## 🛠️ Instalação

```bash
# Clone o projeto
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio

# Instale as dependências
composer install

# Copie o .env de exemplo
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Configure o .env com o banco de dados
# Em seguida, rode as migrations e seeders
php artisan migrate --seed

# Rode o servidor
php artisan serve
