# Instruções para utilização

## Dependências

1. Servidor Mysql instalado e rodando
2. Criação do banco de dados. Nome sugerido: todo_list
3. Criacão da tabela users conforme arquivo `users.sql`
4. Criação da tabela tasks conforme arquivo `tasks.sql`
5. Certifique-se que as dependências do composer sejam instaladas. A dependência utilizada é a PHP-JWT (https://github.com/firebase/php-jwt).


***

## Variáveis de ambiente

Em seguida, certifique-se de preencher as variáveis (`.env`) de ambiente conforme a configuração de sua máquina ou servidor em que a aplicação esteja sendo executada.

## Versionamento e execução

Versão do PHP utilizada no desenvolvimento do projeto foi a 8.2.10. Certifique que esteja utilizando essa versão ou uma superior. 

A aplicação não se dispõe de um servidor XAMPP ou WAMP, foi utilizado o proper built-in server do php, por isso **é de extrema importância que seja instalado e configurado MySQL server separadamente**.

Para executar o código, basta executar o servidor PHP na linha de comando `php -S localhost:8080` e acessar esse endereço no navegador. Se a porta 8080 estiver em uso na sua máquina, basta utilizar outra porta.