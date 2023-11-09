# pi-devops-adocaopets

executa isso: docker pull tomsik68/xampp


---  Depois faz esse processo => ABRIR O TERMINAL E EXECUTAR OS COMANDOS ABAIXO NO PASSO A PASSO -----

1 = docker run -d -p 8080:80 -p 443:443 -v C:/xampp/htdocs/adocaoPets:/opt/lampp/htdocs -v C:/xampp/htdocs/adocaoPets/assets/bd/adocaopets.sql:/docker-entrypoint-initdb.d/adocaopets.sql --name adocaopets tomsik68/xampp
(No passo 1, o primeiro parametro voce vai colocar o caminho certo da aplicação que vai está no htdocs, o segundo é o caminho certo onde ta o script do banco)
2 = docker logs adocaopets
(No passo 2 voce vai ver os logs pra ver a aplicação subiu correta)
3 = docker exec -it adocaopets /opt/lampp/bin/mysql -u root -p
(No passo 3 vai acessar o banco de dados cmo root)
4 = enter 

5 = CREATE DATABASE adocaopets;
(No passo 5 vc vai criar o banco de dados)
6 =  USE adocaopets;
(No passo 6 voce vai acessar o banco de dados)
source /docker-entrypoint-initdb.d/adocaopets.sql;(No passo 7 voce vai executar o script q vc copiou por parametro no passo 1)
8 =  SHOW TABLES;
(Aqui vai listar as tabelas)
9 = select * from cadastro; (visualiza todos usuarios cadastrados);

10 = = select * from cadastropet; (visualiza todos pets cadastrados); 


Para acessar na internet usa http://localhost:8080/
(E por fim voce vai acessar sua aplicação e ser feliz)
