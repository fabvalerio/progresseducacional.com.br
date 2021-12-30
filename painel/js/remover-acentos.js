

function removeAcentos(palavra){

  /*DEFINO A VARIAVEL PALAVRA COMO SENDO UMA STRING*/
  palavra = new String(palavra);

  /*CRIO UM ARRAY COM TODOAS AS LETRAS QUE DESEJO SUBSTITUIR*/
  com_acento = new Array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" , " ", "&nbsp;");

  /*CRIO UM ARRAY COM TODAS AS LETRAS SUBSTITUTAS*/
  sem_acento = new Array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", '_', '_');

  /*CRIO A NOVA VARIAVEL QUE SERA A PALAVRA SEM ACENTOS*/
  nova='';

  /*EXECUTO UM FOR PARA PEGAR LETRA POR LETRA DA PALAVRA*/
  for(i=0;i<palavra.length;i++) {

    /*ESTA VARIAVEL SERA USADA POSTERIORMENTE*/
    gravou="";

    /*PEGO A LETRA*/
    letra = palavra.substr(i,1);

    /*EXECUTO UM LOOP PARA COMPARAR A LETRA PEGA COM AS LETRAS QUE DESEJO SUBSTITUIR*/
    for(x=0;x<46;x++){

      /*VERIFICO SE A LETRA EM QUESTAO ESTA NA ARRAY DE LETRAS QUE DESEJO SUBSTITUIR*/
      if(letra==com_acento[x]){

        /*SE A LETRA ESTIVER NA ARRAY QUE DESEJO SUBSTITUIR EU ACRESCENTO A LETRA DA ARRAY SUBSTITUTA*/
        nova+=sem_acento[x];

        /*ESTA VARIAVEL SERVE DE VERIFICADOR*/
        gravou="ok";

      }
    }

    /*SE A VARIAVEL GRAVOU É DIFERENTE DE ok*/
    if(gravou!="ok"){

      /*ADICIONO A LETRA ATUAL A NOVA VARIAVEL*/
      nova+=letra.replace(' ', '-').replace('?', '').replace('!', '').replace('.', '-').replace('[', '').replace(']', '').replace('{', '').replace('}', '').replace(':', '').replace('/', '-').replace('\\', '-').replace(',', '');
      nova = nova.replace('--', '-').replace('---', '-');
  }
    }

      /*CASO A ÚLTIMA LETRA SEJA UM CARACTERES QUE SUBSISTITUI PELO '-'*/
      var UltimoCaracter = nova.charAt(nova.length - 1);

       if(UltimoCaracter == '-'){
           nova = nova.slice(0,-1);
       }

         //console.log(UltimoCaracter);

  /*RETORNA A NOVA VARIAVEL*/
  return nova.toLowerCase();

}
