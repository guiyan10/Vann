# 🚀 Vann - API de Geolocalização em Tempo Real

## 📌 Sobre o Projeto
A **Vann** é uma API robusta para geolocalização em tempo real, desenvolvida para monitoramento dinâmico de trajetos, localização de usuários e otimização de rotas. Criada em parceria com a Arcis, a Vann foi selecionada como um dos 16 melhores projetos para apresentação no evento **Senai para o Mundo**.

---

## 🛠️ Tecnologias Utilizadas

### 🔹 Backend
- **Node.js** - API principal
- **Express.js** - Framework para rotas
- **PHP** - Backend adicional
- **Python** - Scripts e automação

### 🔹 Frontend
- **HTML, CSS, JavaScript** - Interface do sistema
- **AJAX** - Requisições assíncronas
- **React Native** *(se houver)* - Aplicativo móvel

### 🔹 Banco de Dados
- **MongoDB / MySQL** - Armazenamento de dados

### 🔹 Outros
- **Socket.IO** - Comunicação em tempo real
- **Google Maps API** - Geolocalização
- **Docker** *(se houver)* - Containerização

---

## ✨ Funcionalidades
- ✅ Rastreamento de localização em tempo real  
- ✅ Integração com APIs de mapas  
- ✅ Suporte a múltiplos usuários simultâneos  
- ✅ Armazenamento seguro de dados de localização  
- ✅ Painel de monitoramento *(se houver)*  

---

## ⚡ Como Executar o Projeto

### 🔹 Requisitos
Antes de iniciar, certifique-se de ter instalado:
- [Node.js](https://nodejs.org/) e npm
- Banco de dados configurado (**MongoDB** ou **MySQL**)
- Chave de API do Google Maps
- Docker *(opcional)*

### 🔹 Passos para Execução
1. **Clone o repositório:**
   ```bash
   git clone https://github.com/seu-usuario/vann.git
   cd vann
   ```
2. **Instale as dependências:**
   ```bash
   npm install
   ```
3. **Configure as variáveis de ambiente:**
   ```bash
   export DB_URL=mongodb://localhost:27017/vann
   export GOOGLE_MAPS_API_KEY=SUA_CHAVE_AQUI
   export PORT=3000
   ```
4. **Inicie o servidor:**
   ```bash
   npm start
   ```
5. **Acesse a aplicação:**
   ```
   http://localhost:3000
   

   
