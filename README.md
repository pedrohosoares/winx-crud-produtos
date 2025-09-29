# Projeto Winx Produtos e Categorias
## Por: Pedro Soares

#### Requisitos:
- PHP 8.2
- Postgress 18
- Composer instalado 
- Laravel 12

# Instalação

Depois de instalar o php e o postgress, realize os passos:

- No seu diretório rode: git clone https://github.com/pedrohosoares/winx-crud-produtos.git
- Acesse a pasta winx-crud-produtos
- Rode o comando composer install
- php artisan migrate
- php artisan key:generate
- php artisan serve (Rode em um console que possa manter aberto)
- php artisa queue:work (Rode em um console que possa manter aberto)
- Rode o comando **php artisan app:create-user**
-- Fique atento, pois, o comando acima irá lhe entregar um hash e será com ele que iremos realizar as requisições para a api.

## Acessando a API
Em algum programa para fazer requisições (Pode ser o postman, insomnia ou a extensão do Visual Code Thunder Client)

- Crie os endpoints com a configuração Auth Bearer Token e cole o Hash que você recebeu com o comando artisan.
-- Caso tenha perdido o token, basta rodar novamente o comando **php artisan app:create-user**.


## Sobre os Endpoints
- Todos endpoints precisam de que no **Header esteja com o Content-type application/json**.
- Todos endpoints devem estar com a configuração Auth Bearer Token com o Hash que você recebeu com o comando artisan.
- Todos endpoints que necessitam de cadastramento de dados ou atualização, **os dados precisam ir no corpo do e-mail no formato JSON**. Vide exemplo mais abaixo no doc.

- /api/categories [**POST**] -> Cadastrar uma categoria, com o JSON:
```sh
Dados JSON /api/categories [POST]:
{"name":"Nova categoria"}
```
- /api/categories [**GET**] -> Lista das categorias
-- Parametros GET: 
--- id (inteiro) 
--- name(Pode ser um pedaço da string)
--- limit (inteiro) 
--- page (inteiro)
--- order (ASC|DESC)

- /api/categories/{id} [**GET**] -> Recupera alguma categoria cadastrada
- /api/categories/{id} [**PUT**] -> Atualiza a categoria, com o JSON:
```sh
Dados JSON /api/categories/{id} [PUT]:
{"name":"Categoria atualizada"}
```
- /api/categories/{id} [**DELETE**] -> Deleta a categoria específica


- /api/products [**POST**] -> Cadastrar um produto
```sh 
Dados JSON /api/products [POST] :
{
  "name":"Teste",
  "description":"descricao teste",
  "price":928.21,
  "stock":20,
  "category_id":"5,7,8", //Aqui pode ser um conjunto de categorias ou apenas uma
  "meta":{
    "cor":"Branco",
    "tamanho":"23",
    "marca":"Mont Blue"
  }
}
```
- /api/products [**GET**] -> Lista dos produtos cadastrados
-- ParâmetrosGET: 
--- name (string) 
--- description (string) 
--- price (float)
--- price_min (número ou float (precisa do price_max))
--- price_max (número ou float (precisa do price_min))
--- stock (número inteiro) 
--- category_id (IDs de categorias separadas por vírgula ou apenas um id)
--- deleted (inteiro)
--- page (inteiro) 
--- limit (inteiro) 
--- order (ASC|DESC)
- /api/products/{id} [**GET**] -> Recupera alguma categoria cadastrada
- /api/products/{id} [**PUT**] -> Atualiza a categoria
```sh 
Dados JSON /api/products [PUT] :
{
  "name":"Atualiza produto",
  "description":"descricao teste",
  "price":928.21,
  "stock":20,
  "category_id":"5", //Aqui pode ser um conjunto de categorias ou apenas uma
  "meta":{
    "cor":"Verde",
    "tamanho":"23",
    "marca":"Mont Blue"
  }
}
```
- /api/products/{id} [**DELETE**] -> Deleta o produto específico

## Como foi desenvolvido

Usei o Sanctum para o projeto e com isso, criei o Middleware para poder verificar as permissões que são cadastradas para o usuário. **Cada permissão é o nome de uma rota**. Isso torna dinâmico já que não é necessário colocar verificação nas classes de requisição e criar policies para impedir ou liberar o acesso a uma rota.

Foi desenvolvido Repositório e Serviços para as entidades Produtos e Categorias na pasta Business, com isso, fiz uma classe abstrata para ter os métodos padrões para os dois, assinei uma interface para esses métodos e criei interfaces especificas para cada um caso precisa-se adicionar algum método específico.

Nos repositorios, você irá ver as pastas de acordo com o código que usamos, logo, podemos criar uma pasta para o Eloquent, outra para QueryBuilder, outra para MongoDB e assim temos uma organização melhor.

Fiz a inversão de dependência com a interface do repositório e o repositório em si no AppServiceProvider, pois, você havia me dito que há muitos dados, logo, fazer essa inversão de dependencia é útil para buscarmos os dados de outras bases, bancos ou cache.

Assim criei os serviços com suas interfaces e classe abstrata para termos um padrão.

Em todo projeto, você verá que há classes 'Base', pois, desejei reaproveitar o máximo do código.

Criei um evento para ser salvo a fila dos logs para em seguida criar o log em sí. Poderia ter feito tudo isso no model, mas, prefiro o evento, pois, ficamos livres para usá-lo, já que o model depende do Eloquent.

Também criei classes de Suporte (Helpers) e Traits para as respostas da API e para encapsular a lógica do Evento.

Acabou que queria ter escrito os testes, comecei mas não conclui, uma pena, mas, espero que tenha sido bom para mostrar minha experiência com o Laravel.

Att. Pedro
pedrohosoares@gmail.com
https://www.linkedin.com/in/pedrohosoares/
