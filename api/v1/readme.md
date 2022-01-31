# **REQUEST**

[TOC]

## 📢 Introdução

Para permitir que você possa explorar os dados dos clientes e cursos sem preocupação e segurança é necessário usar o **Json**, mas você precisa de um **Token** e **Chave** por motivo de segurança. 

Caso de dúvida entre em contato com  fabio@agenciasupermkt.com.br ou Whatsapp 12 97410-5202.



## 🎫 Requisição

Requisição **POST** para o seguinte URL como objetos JSON:

`https://progresseducacional.com.br/registro/api/v1/lista-alunos-cursos.php `

`authorization Bearer : 'YsHi4_uFIueFFPJwmgJ2ABlXxH09POi8wQOoPJPhWwE' `

`body : chave => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJrZXkiOiJQcm9ncmVzczIwMjIifQ.YZWTbigahB2sLUWIxiZezYTMTKNClLlAeBhIC2e4LU' `



## ✈ Alunos com cursos



#### ✅ PARAMETROS INDIVÍDUO

| Id    | Tipo   | Descrição           |
| :---- | :----- | :------------------ |
| nome  | string | Nome do indivíduo   |
| email | string | E-mail do indivíduo |



#### ✅ PARAMETROS CURSO

| Id     | Tipo    | Descrição                            |
| :----- | :------ | :----------------------------------- |
| id     | int     | Registro do curso                    |
| compra | int     | Registro da compra (Não obrigatório) |
| nome   | string  | Nome do curso                        |
| status | boolean | *true* ou *null*                     |