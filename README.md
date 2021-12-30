# Documentação API ONEPAY



# ⚫ BACK-END



| STATUS | DETALHES                             | OBSERVAÇÃO                             |      |
| :----: | ------------------------------------ | -------------------------------------- | ---- |
|   ✔    | Consultar token                      | Para iniciar a venda                   |      |
|   ✔    | Registro da empresa                  | Dados da progress                      |      |
|   ✔    | Saldo                                | Valor no Dashboard                     |      |
|   ✔    | Novo Cliente                         | -                                      |      |
|   ✔    | **Lista** de Vendas                  | -                                      |      |
|   ✔    | Venda via crédito                    | -                                      |      |
|   ✔    | Venda via débito                     | -                                      |      |
|   ✔    | Status do pagamento (débito/crédito) | Status é feito encima da listas vendas |      |
|        |                                      |                                        |      |



****

[TOC]

## 🧁 **CONFIGURAÇÃO**

A parte da configuração do estabelecimento e ambiente Sandbox está no arquivo)

- ```
  conf.php
  ```



## 🍟 Class de **Conexão** (Dev)



⭕ **Abertura de Class**

```php
class onepay {
	.....
}
```



**⭕Leitura**

```php
   public function api($url, $token, $method){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_SSL_VERIFYPEER => 2,
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_HTTPHEADER => array(
            'header: ContentType application/json',
            'Authorization: Bearer ' . $token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;       
    }
```



**⭕ Envio**

```php
    public function send($url, $token, $data){

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
      'Authorization: Bearer ' . $token));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $response  = curl_exec($ch);

      curl_close($ch);
        return $response;  
        
    }
```



### 🍜 Documentação online

https://docs.1pay.com.br/



## ✅ CONSULTAR TOKEN 

- ```
  consultar-token.php
  ```

Requisição GET para o seguinte URL como objetos JSON:
`https://apidash.1pay.com.br/estabelecimentos/{idEstabelecimento}/toke`
`nheader: ContentType application/json`
`authorization Bearer 'Token API'`



**⭕ Exemplo de resultado retorno :**

```json
{
  "success": true,
  "token": "a4bd2bfeaec0445dc6233d2ccca662777ae45268"
}              
```

#### PARAMETROS

| Id                | Tipo | Descrição                                                    |
| :---------------- | :--- | :----------------------------------------------------------- |
| idEstabelecimento | int  | Código de identificação do estabelecimento, está registrado no Conf.PHP |



## ✅ ESTABELECIMENTOS

- ```
  estabelecimento.php
  ```

Os estabelecimentos representam pessoas ou empresas dentro do seu marketplace. Normalmente, os estabelecimentos oferecem uma variedade de mercadorias novas, usadas, remodeladas e colecionáveis on-line (cartão não presente) ou em lojas (cartão-presente). Você pode vincular seus cartões de crédito, cartões de débito, vouchers, contas bancárias e fazer transferências, transações (ou seja, débitos), reembolsos e muito mais...

Requisição **POST** para o seguinte URL como objetos JSON:
`https://apidash.1pay.com.br/estabelecimentos`
`header: ContentType    `
`application/jsonauthorization Bearer 'Token API'`

#### PARAMETROS

| Id                    | Tipo   | Descrição                                               |
| :-------------------- | :----- | :------------------------------------------------------ |
| tipoEstabelecimentoID | int    | **1** = Pessoa fisica **2** = Pessoa Jurídica           |
| nome                  | string | Nome do indivíduo                                       |
| nomeComprovante       | string | Nome a ser exibido no comprovante                       |
| email                 | string | E-mail de login / cadastro                              |
| celular               | int    | Número de celular do indivíduo                          |
| dataNascimento        | date   | Data de nascimento do indivíduo                         |
| cpf                   | int    | CPF do indivídio                                        |
| categoria             | string | Categoria predefinida a qual o estabelecimento pertence |
| logradouro            | string | Rua/avenida do endereço                                 |
| numero                | int    | Número do endereço                                      |
| cep                   | string | Código Postal do endereço                               |
| estado                | string | Código ISO 3166-2 para o estado, com duas letras        |
| complemento           | string | Complemento do endereço                                 |



**⭕ Exemplo de requisição retorno:**

```json
{
   "tipoEstabelecimentoId":1,
   "nome":"João Paulo2",
   "nomeComprovante":"Nome fantasia",
   "email":"teste2@1pay.com.br",
   "celular":"00999998888",
   "dataNascimento":"1993-12-16",
   "cpf":"00000000000",
   "categoria":5,
   "endereco":{
      "logradouro":"Rua Souza Lima",
      "numero":"124",
      "cep":"03380-200",
      "cidade":"São Paulo",
      "estado":"SP",
      "complemento":""
   }
}
```

Requisição **POST** para o seguinte URL como objetos JSON:
`https://apidash.1pay.com.br/estabelecimentos`
`header: ContentType application/json`
`authorization Bearer 'Token API'`



**⭕ Exemplo de resultado retorno :**

```json
{
   "success":false,
   "estabelecimento":{
      "id":304,
      "tipo_estabelecimento_id":1,
      "status_estabelecimento_id":1,
      "categoria_estabelecimento_id":1,
      "endereco_id":710,
      "razao_social":"",
      "nome_fantasia":"João Paulo2",
      "ativo":0,
      "data_nascimento":"1993-12-16T00:00:00.000Z",
      "created":"2020-02-07T22:22:29.000Z",
      "modified":"2020-02-07T22:22:29.000Z",
      "removed":null,
      "tipo_estabelecimento":{
         "id":1,
         "titulo":"Pessoa Física",
         "created":"2019-01-11T20:38:52.000Z",
         "modified":"2019-01-11T20:38:52.000Z",
         "removed":null
      },
      "status_estabelecimento":{
         "id":1,
         "titulo":"Aguardando Aprovação",
         "created":"2019-07-22T20:24:19.000Z",
         "modified":"2019-07-22T20:24:19.000Z",
         "removed":null
      },
      "categoria_estabelecimento":{
         "id":1,
         "titulo":"Padrão",
         "created":"2019-07-25T18:18:17.000Z",
         "modified":"2019-07-25T18:18:17.000Z",
         "removed":null
      },
      "endereco":{
         "id":710,
         "logradouro":"Rua Souza Lima",
         "numero":"124",
         "complemento":"",
         "cep":"03380200",
         "cidade":"São Paulo",
         "uf":"SP",
         "lat":null,
         "long":null,
         "created":"2020-02-07T22:22:29.000Z",
         "modified":"2020-02-07T22:22:29.000Z",
         "removed":null
      }
   }
}
```



## ✅ CONSULTAR SALDO       

- ```
  saldo.php
  ```

Requisição GET para o seguinte URL como objetos JSON:
`https://apidash.1pay.com.br/estabelecimentos/{idEstabelecimento}/saldo`
`header: ContentType application/json`
`authorization Bearer 'Token API'`



⭕ **Exemplo de resultado  retorno:**

```json
{
  "success": true,
  "saldo": {
    "atual": "0.00",
    "futuro": "297625.33"
  }
}    
```

#### PARAMETROS

| Id                | Tipo | Descrição                                                    |
| :---------------- | :--- | :----------------------------------------------------------- |
| idEstabelecimento | int  | Código de identificação do estabelecimento, está registrado no Conf.PHP |



## ✅ LISTAR CONTA BANCÁRIA

- ```
  listar-conta-bancaria.php
  ```

Requisição GET como objetos JSON para o seguinte URL:
`https://apidash.1pay.com.br/estabelecimentos/contas_bancarias`
`header: ContentType application/json `
`authorization Bearer 'Token API'`



⭕ **Exemplo de resultado retorno:**

```json
{
   "success":true,
   "contasBancarias":[
      {
         "id":27,
         "tipoContaBancaria":1,
         "nomeTitular":"1pay Software de Gestão",
         "agencia":"000",
         "conta":"000000",
         "banco":"Itaú Unibanco S.A.",
         "ativo":true
      },
      {
         "id":28,
         "tipoContaBancaria":1,
         "nomeTitular":"1pay Software de Gestão",
         "agencia":"0000",
         "conta":"000000000",
         "banco":"Banco Santander (Brasil) S.A.",
         "ativo":false
      }
   ]
}
```

#### PARAMETROS

| Id                  | Tipo | Descrição            |
| :------------------ | :--- | :------------------- |
| id_contas_bancarias | int  | id da conta bancária |



## ✅ CRIAR UM NOVO CLIENTE

- ```
  novo-cliente.php
  ```

Requisição **POST** como objetos JSON para o seguinte URL:
`https://apidash.1pay.com.br/clientes`
`header: ContentType application/json`
`authorization Bearer 'Token API'`

#### PARAMETROS

| Id             | Tipo   | Descrição                                                    |
| :------------- | :----- | :----------------------------------------------------------- |
| nome           | string | Nome do cliente / Razão Social                               |
| documento      | int    | CPF ou CNPJ do cliente                                       |
| dataNascimento | date   | Data de nascimento do cliente, caso o **documento** seja CPF |
| email          | string | E-mail do cliente                                            |
| celular        | int    | Número celular do cliente                                    |
| sexo           | string | **M** = Masculino **F** = Feminino                           |
| logradouro     | string | Rua ou Avenida do endereço                                   |
| numero         | int    | Número do endereço                                           |
| cep            | string | Código postal do endereço                                    |
| cidade         | string | Cidade do endereço                                           |
| estado         | string | Código ISO 3166-2 para o estado, com duas letras             |
| complemento    | string | Complemento do endereço                                      |



**⭕ Exemplo de requisição de envio:**

```json
{
  "nome": "João Paulo",
  "documento": "00000000000",
  "dataNascimento": "1993-12-16",
  "email": "teste2@1pay.com.br",
  "celular": "00999998888",
  "sexo": "M",
  "endereco": {
    "logradouro": "Rua Pedro Souza",
    "numero": "124",
    "cep": "03380-200",
    "cidade": "São Paulo",
    "estado": "SP",
    "complemento": ""
  }
}
```



⭕ **Exemplo de resultado retorno:**

```json
{
  "success": true,
  "error": "....",
  "cliente": {
    "id": 18638,
    "endereco_id": 700,
    "nome": "João Paulo",
    "email": "teste2@1pay.com.br",
    "senha": "",
    "sexo": "M",
    "ativo": true,
    "data_nascimento": "1993-12-16",
    "created": "2020-02-07T21:49:38.000Z",
    "modified": "2020-02-07T21:49:38.000Z",
    "removed": null,
    "endereco": {
      "id": 700,
      "logradouro": "Rua Souza Lima",
      "numero": "124",
      "complemento": "",
      "cep": "03380200",
      "cidade": "São Paulo",
      "uf": "SP",
      "lat": null,
      "long": null,
      "created": "2020-02-07T21:49:38.000Z",
      "modified": "2020-02-07T21:49:38.000Z",
      "removed": null
    }
  }
}
```

- **Ao registrar o cliente é necessário registrar o ID do cliente no banco de dados da Progress.**



## 🍬 VENDAS

Quando um cliente fornece um número de cartão, mas não tem acesso ao cartão físico, a compra é conhecida como uma transação de cartão não presente (CNP). Esse tipo de transação geralmente ocorre através da Internet ou através de um call center.

O recurso de transações é usado para debitar um cartão ou uma conta bancária eletronicamente via ACH. Ele retorna um identificador exclusivo que pode ser posteriormente usado para emitir um reembolso integral ou parcial. Você precisará de um ID de cliente existente (vendedor ou comprador) ou de um método de pagamento válido (cartão ou conta bancária). Tanto o cartão como a conta bancária devem ser um token não usado ou um ID exclusivo existente já associado a um cliente. Alternativamente, você também pode usar um ID de pré-autorização.



### ✅ NOVA VENDA VIA CARTÃO DE CRÉDITO

- ```
  venda-cartao-credito.php
  ```

Requisição **POST** como objetos JSON para o seguinte URL:
`https://apidash.1pay.com.br/vendas`
`header: ContentType application/jsona`
`uthorization Bearer 'Token API'`



⭕ **Exemplo de requisição de envio:**

```json

{
  "tipoPagamentoId": 3,
  "valor": 500.00,
  "parcelas": 4,
  "pedido_venda": "cod1234",
  "cartao": {
    "titular": "João Paulo",
    "numero": "5234233381847212",
    "codigoSeguranca": "069",
    "validade": "02/2025"
  },
  "cliente": {
    "nome": "João paulo ",
    "cpf": "00000000000",
    "dataNascimento": "1993-01-12",
    "email": "teste2@1pay.com.br",
    "celular": "00999998888"
  },
  "endereco": {
    "logradouro": "Rua Bartolomeu Sabino de Melo",
    "numero": "124",
    "cep": "03380-200",
    "cidade": "São Paulo",
    "estado": "SP",
    "complemento": ""
  }
}
```



#### PARAMETROS

| Id              | Tipo   | Descrição                                                    |
| :-------------- | :----- | :----------------------------------------------------------- |
| tipoPagamentoId | int    | **1** = Boleto **2** = Débito (Não implementado) **3** = Cartão de crédito |
| valor           | float  | Valor a ser transferido, utilizando **.(ponto)** em vez de **,(vírgula)** para casas decimais. Ex.: para transferir **R$ 100,00** utiliza-se **100.00** ; para **R$ 0,21** utiliza-se **0.21** |
| parcelas        | int    | Quantidade de parcelas da compra no cartão                   |
| pedido_venda    | string | Número do pedido de venda no estabelecimento                 |
| titular         | string | Nome do titular do cartão                                    |
| numero          | int    | Número do cartão                                             |
| codigoSeguranca | int    | Código de Segurança ou CVV do cartão                         |
| validade        | string | Mês e ano em que o cartão expira sua validade                |
| nome            | string | Nome do cliente                                              |
| cpf             | int    | CPF do cliente                                               |
| dataNascimento  | date   | Data de nascimento do cliente                                |
| email           | string | E-mail do cliente                                            |
| celular         | int    | Número celular do cliente                                    |
| logradouro      | string | Rua ou Avenida do endereço                                   |
| numero          | int    | Número do endereço                                           |
| cep             | string | Código postal do endereço                                    |
| cidade          | string | Cidade do endereço                                           |
| estado          | string | Código ISO 3166-2 para o estado, com duas letras             |
| complemento     | string | Complemento do endereço                                      |



⭕ **Exemplo de resultado returno :**

```json
{
    "success": true,
    "pedido": {
        "tipo_pedido_id": 1,
        "marketplace_id": null,
        "status_pedido_id": "1",
        "valor_bruto": 0,
        "valor_liquido": 0,
        "tipo_pagamento": null,
        "bandeira": null,
        "parcelas": null,
        "markup": null,
        "capture_mode": null,
        "splitted": false,
        "oculto": false,
        "splitted_link": false,
        "taxed": false,
        "antecipado": false,
        "msg_erro": null,
        "id": 2401,     //ID DA VENDA
        "usuario_id": 107,
        "cliente_id": 6370195,
        "estabelecimento_id": 1569,
        "referencia": "",
        "sales_order": "cod1234",
        "modified":"2019-12-04T16:10:34.153Z",
        "created":"2019-12-04T16:10:34.153Z",
        "cartaoId": 12345
    }
}
```



⭕ **Exemplo de erro :**

```json
{
  "success": false,
  "error": {
    "type": "card_error",
    "category": "card_declined",
    "message": "Transação não autorizada. Para
    mais informações, entre em contato com seu banco."
  },
  "message": "Transação não autorizada. Para
  mais informações, entre em contato com seu banco."
}
```



**Registrar ID da venda no banco de dados** 

Exemplo :   "id": 9517983,



### ✅ VENDA VIA BOLETO CLIENTE JÁ CADASTRADO (VIA ID REGISTRO CLIENTE)

- ```
  venda-boleto.php
  ```

Requisição **POST** como objetos JSON para o seguinte URL:
`https://apidash.1pay.com.br/vendas`
`header: ContentType application/json`
`authorization Bearer 'Token API'`

O valor mínimo do boleto é R$ 5,00



#### PARAMETROS

| Id              | Tipo   | Descrição                                                    |
| :-------------- | :----- | :----------------------------------------------------------- |
| tipoPagamentoId | int    | **1** = Boleto **2** = Débito(Não implementado) **3** = Cartão de crédito |
| valor           | float  | Valor a ser transferido, utilizando **.(ponto)** em vez de **,(vírgula)** para casas decimais. Ex.: para transferir **R$ 100,00** utiliza-se **100.00** ; para **R$ 0,21** utiliza-se **0.21** |
| dataVencimento  | date   | Data que o boleto irá vencer                                 |
| descricao       | string | Descição da transação                                        |
| pedido_venda    | string | Número do pedido de venda no estabelecimento                 |
| clienteId       | int    | Identificador do cliente já cadastrado                       |



**Exemplo de requisição de envio**

```json
{
  "tipoPagamentoId": 1,
  "valor": 5.00,
  "dataVencimento": "2019-12-09",
  "descricao": "teste de pagamento",
  "pedido_venda": "cod1234",
  "clienteId":1568
}
```



**Exemplo de requisição **

```json
{
  "success": true,
  "pedido": {
    "tipo_pedido_id": 1,
    "status_pedido_id": "1",
    "splitted": false,
    "id": 2416,
    "usuario_id": 107,
    "pedido_venda": "cod1234",
    "cliente_id": 1568,
    "estabelecimento_id": 131,
    "modified": "2019-12-04T16:43:47.812Z",
    "created": "2019-12-04T16:43:47.812Z",
    "urlBoleto": "https://api-boletoproduction.s3.amazona
    ws.com/e16ddd5d975edfbdd1ecad06868f34e4/e16ddd5d975ed
    fbdd1ecad06868f34e4/e16ddd5d975edfbdd1ecad0.html"
  }
}
  
```





### ✅ LISTAR VENDAS

Requisição GET como objetos JSON para o seguinte URL:
`https://apidash.1pay.com.br/vendas`
`header: ContentType application/json`
`authorization Bearer 'Token API'`



**Exemplo de Retorno**

```json
{
  "success": true,
  "message": "Vendas",
  "paginas": 49,
  "quantidade": 482,
  "vendas": [
    {
      "type": "date",
      "date": "2021-12-17"
    },
    {
      "id": 9517983,
      "pedido_venda": "#123456",
      "type": "row",
      "created": "2021-12-17T17:15:50.000Z",
      "tipo_pagamento": null,
      "bandeira": null,
      "tipo_pagamento_id": null,
      "tipo_pagamento_titulo": null,
      "tipoPagamento": null,
      "valores": {
        "total": "0.00",
        "taxa": 21.94,
        "liquido": 0,
        "split": 0,
        "planoTaxa": 0,
        "split2": 0,
        "markupEC": 0,
        "taxaTotal": 21.94
      },
      "status": {
        "id": 2,
        "titulo": 2
      },
      "cliente": {
        "nome": "João Paulo",
        "endereco": {
          "logradouro": "Rua Pedro Souza",
          "numero": "124",
          "complemento": "",
          "cep": "03380200",
          "bairro": null,
          "cidade": "São Paulo",
          "uf": "SP"
        }
      },
      "estabelecimento": {
        "nome_fantasia": "Estabelecimento de Testes",
        "logo_id": null,
        "marketplace_id": 7,
        "estabelecimentos_documentos": [
          {
            "documento": "85373947008"
          }
        ]
      },
      "parcelas": null,
      "dataRecebimento": "2022-03-17T00:00:00.000Z",
      "markup": 0,
      "markupCalculado": null,
      "zoopTransactionId": "b6f1d2fb39554d74acc2892e0366aad9",
      "planoVenda": null,
      "representante": null,
      "msg_erro": null
    },
    {
      "id": 9517982,
      "pedido_venda": "cod1234",
      "type": "row",
      "created": "2021-12-17T16:51:44.000Z",
      "tipo_pagamento": null,
      "bandeira": null,
      "tipo_pagamento_id": null,
      "tipo_pagamento_titulo": null,
      "tipoPagamento": null,
      "valores": {
        "total": "0.00",
        "taxa": 0,
        "liquido": 0,
        "split": 0,
        "planoTaxa": 0,
        "split2": 0,
        "markupEC": 0,
        "taxaTotal": 0
      },
      "status": {
        "id": 1,
        "titulo": 1
      },
      "cliente": {
        "nome": "João Pedro",
        "endereco": {
          "logradouro": "Rua Pedro Souza",
          "numero": "124",
          "complemento": "",
          "cep": "03380200",
          "bairro": null,
          "cidade": "São Paulo",
          "uf": "SP"
        }
      },
      "estabelecimento": {
        "nome_fantasia": "Estabelecimento de Testes",
        "logo_id": null,
        "marketplace_id": 7,
        "estabelecimentos_documentos": [
          {
            "documento": "85373947008"
          }
        ]
      },
      "parcelas": null,
      "dataRecebimento": "2021-12-20T00:00:00.000Z",
      "markup": 0,
      "markupCalculado": null,
      "zoopTransactionId": "270f1fe4a3b944bdb80bfad0652f1a3b",
      "planoVenda": null,
      "representante": null,
      "msg_erro": null
    },
    {...},
  "hist": [
    
  ],
  "totais": {
    "geral": {
      "quantidade": 482,
      "quantidadePendente": "108",
      "quantidadeAprovada": "320",
      "quantidadeFalhada": "54",
      "quantidadeCancelada": "0",
      "quantidadeEstornada": "0",
      "taxa": "30447.42",
      "valor": "874281.69",
      "totalPendente": "0.00",
      "totalAprovado": 0,
      "totalFalhado": "0.00",
      "totalCancelado": "0.00",
      "totalEstornado": "0.00",
      "liquido": "752563.73",
      "cliente.nome": "Frank Emmerich",
      "markup": null,
      "markupCalculado": null,
      "markupEC": "0.00",
      "markupFilho": "0.00",
      "split": null,
      "split2": "0.00",
      "planoTaxa": "0.00"
    },
    "2021-12-17": {
      "bruto": 0,
      "liquido": 0
    }
  }
}
```



**OBS**

| $objStatus->venda->status->id | Info     |
| ----------------------------- | -------- |
| 1                             | Pedente  |
| 2                             | Aprovado |



### ✅ CONSULTAR VENDA VENDAS

- ```
  consulta-vendas.php
  ```

Requisição GET como objetos JSON para o seguinte URL:
`https://apidash.1pay.com.br/vendas/{pedidoId}`
`header: ContentType application/json`
`authorization Bearer 'Token API'`

#### PARAMETROS

| Id       | Tipo | Descrição                         |
| :------- | :--- | :-------------------------------- |
| PedidoId | int  | Identificação do pedido já criado |



**Exemplo de resultado**

```json
{
  "success": true,
  "message": "Venda",
  "venda": {
    "id": 2416,
    "pedido_venda": null,
    "created": "2019-12-04T16:43:47.000Z",
    "tipoPagamento": {
      "id": 1,
      "titulo": "Boleto",
      "cartaoCredito": null,
      "boleto": {
        "id": 25,
        "url": "https://api-boletoproduction.s3.amazonaw
        s.com/e1d5d0ce1f3946b68afab278f6b392b4/68a049190
        bb04d97aee3ae7ea3aceb2e/5de7e24455065a15068f3a1d
        .html"
      }
    },
    "valores": {
      "total": 5,
      "taxa": 0,
      "splits": 0,
      "liquido": 5
    },
    "status": {
      "id": 1,
      "titulo": "Pendente"
    },
    "cliente": {
      "nome": "João Paulo",
      "email": "teste2@1pay.com.br",
      "clientes_documentos": [
        {
          "documento": "00000000000"
        }
      ]
    },
    "estabelecimento": {
      "id": 131,
      "nome_fantasia": "Integração 1pay",
      "razao_social": "",
      "arquivo": {
        "url": "onepay-bucket.s3-sa-east-1.amazonaws.
        com/files/estabelecimentos/logos/157445112.jpg"
      }
    },
    "produtos": [
      {
        "valorUnitario": "5.00",
        "quantidade": 1,
        "nome": "Venda Via API"
      }
    ],
    "pagamentos": [
      {
        "id": 1976,
        "valor": "5.00",
        "taxa": "0.00",
        "valorRecebido": "5.00",
        "tipoPagamento": {
          "id": 1,
          "titulo": "Boleto"
        },
        "statusPagamento": {
          "id": 1,
          "titulo": "Pendente"
        },
        "dataRecebimento": "2019-12-09T00:00:00.000Z",
        "parcela": 1,
        "pagamentoCartao": null,
        "pagamentoBoleto": {
          "id": 25,
          "url": "https://api-boletoproduction.s3.amazonaws
          .com/e1d5d0ce1f3946b68afab278f6b392b4/68a049190bb
          04d97aee3ae7ea3aceb2e/5de7e24455065a15068f3a1d.html"
        }
      }
    ],
    "pedidosFilhos": [],
    "splitParcela": "0.00"
  }
}
```



**OBS**

| $objStatus->venda->status->id | Info     |
| ----------------------------- | -------- |
| 1                             | Pedente  |
| 2                             | Aprovado |





<hr style="background-color:red; height:3px">







# 🟢 Front-END



https://devdash.1pay.com.br/
Usuário: [testes@1pay.com.br](mailto:testes@1pay.com.br)
Senha: 123456



## 💰 Ambiente de pagamento (SandBox)

Os seguintes números de cartão de crédito podem ser usados para simular transações em ambiente de teste (sandbox), para pagamentos bem-sucedidos:

| **Número**       | **Bandeira**            |
| ---------------- | ----------------------- |
| 4539003370725497 | Visa (Digitada)         |
| 4761340000000035 | Visa (Chip & PIN)       |
| 4716588836362104 | Visa (Crédito)          |
| 4532650104137832 | Visa Electron (Crédito) |
| 5356066320271893 | MasterCard (Digitada)   |
| 5201561050024014 | MasterCard (Chip & PIN) |
| 5577270004286630 | MasterCard (Crédito)    |
| 5138692036125449 | MasterCard (Crédito)    |


Além disso, esses são os números de cartões que gerarão respostas específicas, úteis para testar diferentes cenários:

| **Número**       | **Bandeira**                                                 |
| ---------------- | ------------------------------------------------------------ |
| 6011457819940087 | A transação será recusada com um código de "card_declined".  |
| 4929710426637678 | A transação será recusada com um código "card_declined".     |
| 4710426743216178 | A transação será recusada com um código "service_request_timeout". |





## 📀 Alteração no banco de dados



| Tabela       | Nome                      | Tipo         | Nulo |         |
| ------------ | ------------------------- | ------------ | ---- | ------- |
| aluno        | aluno_nascimento          | date         | Não  | Inserir |
| aluno        | aluno_sexo                | varchar(1)   | Não  | Inserir |
| aluno        | aluno_estado              | varchar(2)   | Não  | Inserir |
| aluno        | aluno_id_onepay           | int(11)      | Sim  | Inserir |
| aluno_cursos | cursos_codigo             | varchar(100) | Não  | Inserir |
| aluno_cursos | cursos_tipo_pagamento     | int(11)      | Não  | Inserir |
| aluno_cursos | cursos_tipo_pagaemento_id | varchar(100) | Não  | Inserir |
|              |                           |              |      |         |
|              |                           |              |      |         |





## 💳 Pagamento com cartão de Crédito

**Front**

```html
HTML   front-end/pagamento-cartao.php

JS 	   front-end/pagamento-cartao.js
                /js/jquery.mask.js
	               /jquery.maskMoney.js
	               
LESS   front-end/less/pagamento.less
```



**Back retorno**

```
JSON   back-end/enviar-venda-cartao-credito.php
```



![image-20211221162454203](C:\Users\fabva\AppData\Roaming\Typora\typora-user-images\image-20211221162454203.png)

Retorno de mesmagem

True : SUCCESS

<div class="card card-body bg-success text-white"><h2>🥰 Pagamento realizado com sucesso!</h2></div>

False: DANGER

<div class="card card-body bg-danger text-white"><h2>😥 Ops! Ocorreu um erro. <br> '.$obj->error->message.'</h2></div>





## 🎫 Pagamento com boleto

**Front**

```html
HTML   front-end/pagamento-boleto.php

JS 	   front-end/pagamento-boleto.js
	               
LESS   front-end/less/pagamento.boleto.less
```



**Back retorno**

```
JSON   back-end/enviar-venda-boleto.php
```



![image-20211221180607827](C:\Users\fabva\AppData\Roaming\Typora\typora-user-images\image-20211221180607827.png)



## ☢ Cron Job



Script de verificação para baixa de boleto automático ao ser compensado pela ONEPAY

```
painel/script-cron-pagamentos.php
```



## 🎯 Cupom - Regra

Regra do Código de **Desconto** ao registrar o código é obrigatório adicionar ***<u>hashtag</u>*** que deverá ser digitado antes (**ex:** #cupom15off   **ou** #cupom15  )  e com todas as letras ***<u>mínusculas</u>***.



![image-20211230135418452](C:\Users\fabva\AppData\Roaming\Typora\typora-user-images\image-20211230135418452.png)



## 📩 E-mail MKT 

- Lista de todas ações ao realizar o disparo de email marketing

| Assunto                    | Diretório              |
| -------------------------- | ---------------------- |
| Esqueci minha senha aluno  | aluno/minha-senha.php  |
| Esqueci minha senha escola | escola/minha-senha.php |
|                            |                        |



## 😝 Telas/Tarefas

| Status | Telas                                                      | Linguagem    |
| :----: | ---------------------------------------------------------- | ------------ |
|   ✔    | Tipo de Pagamentos                                         | HTML         |
|   ✔    | Pagamentos via Cartão                                      | HTML/API     |
|   ✔    | Registrar pagamento no banco de dados do cartão de crédito | SQL          |
|   ✔    | Pagamentos via Boleto                                      | HTML/API     |
|   ✔    | Registrar pagamento no banco de dados do Boleto            |              |
|   ✔    | Registro de novo cliente                                   | HTML/SQL/API |
|   ✔    | Consultar validade do token (Login)                        | API          |
|   ✔    | Consultar dados da Progress (Login)                        | API          |
|   ✔    | Status de pagamento                                        | HTML/API     |
|   ✔    | Registrar ID venda                                         | SQL/API      |
|   ✔    | Registrar/Gerar código da venda                            | SQL/API      |
|   ✔    | Listar vendas Usuários                                     | HTML/SQL/API |
|   ✔    | Relatório de vendas Master                                 | HTML/SQL/API |
|   ✔    | Ativar cursos Gratuitos Manualmente                        | HTML/SQL     |
|   ✔    | Verificar se usuário já está cadastrado no 1pay            | API          |
|   ✔    | Criar cupom de desconto                                    | HTML/PHP/SQL |
|   ✔    | Cupom na compra                                            | HTML/PHP/SQL |
|   ✔    | Ativação e desativação de aulas manuais usuário master     | HTML/PHP/SQL |
|   ✔    | Esqueci minha senha / escola                               | HTML/PHP/SQL |
|   ✔    | Esqueci minha senha / alunos                               | HTML/PHP/SQL |
|   🕑    | Integração disparo de email SMTP                           | PHP          |
|   ✔    | Página para ativar os cursos AUTOMÁTICO VIA CRON           | PHP          |
|   🕑    | Deploy                                                     |              |
|   🕑    | Ativar o CRON                                              | Servidor     |
|   🕑    | Criar link de redirecionamento para vídeo aula             |              |



