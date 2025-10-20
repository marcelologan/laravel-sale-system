# �� Sistema de Gestão Laravel

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-12.34.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.4.13-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</div>

<div align="center">
  <h3>🎨 Sistema completo de gestão com interface moderna e responsiva</h3>
  <p>Desenvolvido por <strong>Marcelo Logan</strong></p>
</div>

---

## 📖 **Sobre o Projeto**

Sistema de gestão empresarial desenvolvido em Laravel com interface moderna e intuitiva. O projeto oferece um CRUD completo para gerenciamento de clientes, produtos, categorias e pedidos, com foco na experiência do usuário e design responsivo.

### ✨ **Principais Características**

- 🎨 **Interface Moderna**: Design limpo e profissional com paleta de cores personalizada
- 📱 **Totalmente Responsivo**: Funciona perfeitamente em desktop, tablet e mobile
- ⚡ **Performance Otimizada**: Carregamento rápido e navegação fluida
- 🔐 **Sistema de Autenticação**: Login seguro com Laravel Breeze
- 🖼️ **Upload de Imagens**: Sistema completo de upload com preview
- �� **Filtros Avançados**: Busca e filtros inteligentes em todas as listagens
- 📊 **Dashboard Visual**: Estatísticas e métricas em tempo real

---

## 🛠️ **Tecnologias Utilizadas**

### **Backend**
- **Laravel 12.34.0** - Framework PHP robusto e elegante
- **PHP 8.4.13** - Linguagem de programação
- **MySQL** - Banco de dados relacional
- **Laravel Breeze** - Sistema de autenticação

### **Frontend**
- **Tailwind CSS** - Framework CSS utilitário
- **Blade Templates** - Engine de templates do Laravel
- **JavaScript Vanilla** - Interatividade e dinamismo
- **Alpine.js** (via Breeze) - Framework JavaScript reativo

### **Ferramentas**
- **Vite** - Build tool e bundler
- **Composer** - Gerenciador de dependências PHP
- **NPM** - Gerenciador de pacotes JavaScript

---

## 📦 **Módulos do Sistema**

### 👥 **Gestão de Clientes**
- ✅ Cadastro completo com validações
- ✅ Listagem com filtros avançados
- ✅ Visualização detalhada
- ✅ Edição e exclusão
- ✅ Busca por nome, email ou CPF

### 🏷️ **Gestão de Categorias**
- ✅ CRUD completo de categorias
- ✅ Interface em cards modernos
- ✅ Contadores de produtos por categoria
- ✅ Sistema de status ativo/inativo

### 📦 **Gestão de Produtos**
- ✅ Cadastro com upload de imagens
- ✅ Controle de estoque
- ✅ Categorização
- ✅ Código de barras
- ✅ Filtros por categoria, preço e estoque
- ✅ Preview de imagens

### 🛒 **Gestão de Pedidos**
- ✅ Criação dinâmica de pedidos
- ✅ Adição/remoção de produtos em tempo real
- ✅ Cálculo automático de totais
- ✅ Controle de status (Pendente → Confirmado → Entregue)
- ✅ Validação de estoque
- ✅ Histórico completo

### 📊 **Dashboard**
- ✅ Estatísticas em tempo real
- ✅ Gráficos e métricas
- ✅ Resumo de vendas
- ✅ Produtos em baixo estoque
- ✅ Pedidos recentes

---

## 🎨 **Interface e Design**

### **Paleta de Cores Personalizada**
```css
/* Cores Principais */
--primary: #2563eb        /* Azul principal */
--primary-dark: #1d4ed8   /* Azul escuro */
--secondary: #7c3aed      /* Roxo secundário */
--secondary-dark: #6d28d9 /* Roxo escuro */

/* Gradientes */
--warm-gradient: linear-gradient(135deg, #f59e0b, #ef4444, #ec4899)

/* Texto */
--text-dark: #1f2937      /* Texto principal */
--text-light: #6b7280     /* Texto secundário */
Componentes Modernos
🎯 Cards com hover effects
🎨 Gradientes suaves
📱 Layout responsivo
⚡ Animações CSS
🔄 Loading states
🎪 Modais estilizados

🚀 Instalação e Configuração
Pré-requisitos
PHP >= 8.2
Composer
Node.js >= 16
MySQL >= 8.0
Passo a Passo
Clone o repositório
bash
Copiar

git clone https://github.com/marcelologan/laravel-sale-system.git
cd sistema-gestao-laravel
Instale as dependências PHP
bash
Copiar

composer install
Instale as dependências JavaScript
bash
Copiar

npm install
Configure o ambiente
bash
Copiar

cp .env.example .env
php artisan key:generate
Configure o banco de dados
env
Copiar

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
Execute as migrações
bash
Copiar

php artisan migrate
Execute os seeders (opcional)
bash
Copiar

php artisan db:seed
Crie o link simbólico para storage
bash
Copiar

php artisan storage:link
Compile os assets
bash
Copiar

npm run build
# ou para desenvolvimento
npm run dev
Inicie o servidor
bash
Copiar

php artisan serve
Acesse: http://localhost:8000

📱 Screenshots
Dashboard


Gestão de Produtos


Gestão de Pedidos


Interface Mobile


�� Funcionalidades Técnicas

Validações
✅ Validação de CPF
✅ Validação de email
✅ Validação de imagens
✅ Validação de estoque
✅ Sanitização de dados

Segurança
✅ Autenticação Laravel Breeze
✅ Middleware de autenticação
✅ CSRF Protection
✅ Validação de inputs
✅ Sanitização de uploads

Performance
✅ Eager Loading
✅ Paginação otimizada
✅ Cache de queries
✅ Otimização de assets
✅ Lazy loading de imagens

📚 Estrutura do Projeto
├── app/
│   ├── Http/Controllers/     # Controllers do sistema
│   ├── Models/              # Models Eloquent
│   └── ...
├── database/
│   ├── migrations/          # Migrações do banco
│   └── seeders/            # Seeders de dados
├── resources/
│   ├── views/              # Templates Blade
│   ├── css/                # Estilos CSS
│   └── js/                 # JavaScript
├── public/
│   └── storage/            # Arquivos públicos
└── routes/
    └── web.php             # Rotas da aplicação
🤝 Contribuição
Contribuições são sempre bem-vindas! Para contribuir:

Faça um fork do projeto
Crie uma branch para sua feature (git checkout -b feature/AmazingFeature)
Commit suas mudanças (git commit -m 'Add some AmazingFeature')
Push para a branch (git push origin feature/AmazingFeature)
Abra um Pull Request
📄 Licença
Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

👨‍💻 Autor
Marcelo Logan

GitHub: 

github.com
LinkedIn: 

linkedin.com
Email: seu-email@exemplo.com
🙏 Agradecimentos
Laravel Framework
Tailwind CSS
Comunidade PHP
Todos os contribuidores
⭐ Se este projeto te ajudou, considere dar uma estrela!

Feito com ❤️ por Marcelo Logan