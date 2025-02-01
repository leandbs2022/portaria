var myVar = setInterval(myTimer, 1000);
function myTimer() {
  var d = new Date(), displayDate;
  if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
    displayDate = d.toLocaleTimeString('pt-BR');
  } else {
    displayDate = d.toLocaleTimeString('pt-BR', { timeZone: 'America/Belem' });
  }
  var dataBR = Date('d/m/Y')
  // document.getElementById("date").innerHTML = 'Hora:' + displayDate;
}


function recuperar() { window.Location.href("recuperar.php"); }
function recurso() { alert('Recurso não disponivel!') }
function claro() {
  var valor = 0

}
function escuro() {
  var valor = 1

  function estilo() {
    let valor01 = document.getElementById('copcao1').value
    if (valor01 == 1) { }
    let valor02 = document.getElementById('copcao2').value
    if (valor02 == 1) { }

  }
}

function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
  if (display == "none")
    document.getElementById(el).style.display = 'block';
  else
    document.getElementById(el).style.display = 'none';
}
function toggleFullScreen() {
  document.getElementById('titulodiv').style.display = 'nane';
  if (

    (document.fullScreenElement && document.fullScreenElement !== null) ||

    (!document.mozFullScreen && !document.webkitIsFullScreen)

  ) {

    if (document.documentElement.requestFullScreen) {

      document.documentElement.requestFullScreen();

    } else if (document.documentElement.mozRequestFullScreen) {

      document.documentElement.mozRequestFullScreen();

    } else if (document.documentElement.webkitRequestFullScreen) {

      document.documentElement.webkitRequestFullScreen(

        Element.ALLOW_KEYBOARD_INPUT

      );

    }

  } else {

    if (document.cancelFullScreen) {

      document.cancelFullScreen();

    } else if (document.mozCancelFullScreen) {

      document.mozCancelFullScreen();

    } else if (document.webkitCancelFullScreen) {

      document.webkitCancelFullScreen();

    }

  }

}

function requestFullScreen() {

  var el = document.body;
  // Suporta a maioria dos navegadores e suas versões.

  var requestMethod =

    el.requestFullScreen ||

    el.webkitRequestFullScreen ||

    el.mozRequestFullScreen ||

    el.msRequestFullScreen;



  if (requestMethod) {

    // Tela cheia nativa.

    requestMethod.call(el);

  } else if (typeof window.ActiveXObject !== "undefined") {

    // IE mais antigo.

    var wscript = new ActiveXObject("WScript.Shell");



    if (wscript !== null) {

      wscript.SendKeys("{F11}");


    }

  }

}

function frame(pages) {
  switch (pages) {
    case 0:
      document.getElementById("telas").src = "base.php";
      break;

    case 1:
      document.getElementById("telas").src = "infor.php";
      break;

    case 2:
      document.getElementById("telas").src = "ramais.php";
      break;

    case 3:
      document.getElementById("telas").src = "usuarios.php";
      break;

    case 4:
      document.getElementById("telas").src = "gpt.php";
      break;

    case 5:
      document.getElementById("telas").src = "laudos.php";
      break;

    case 6:
      //document.getElementById("telas").src = "";
      break;
    case 7:
      //document.getElementById("telas").src = "";
      break;
    default:
      break;
  }

}


function pagina(relatorios) {

  window.location.href = "relatorios.php";

}

function graficoPizza() {

  var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];

  var yValues = [55, 49, 44, 24, 15];

  var barColors = ["#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145"];



  new Chart("myChart", {

    type: "pie",

    data: {

      labels: xValues,

      datasets: [

        {

          backgroundColor: barColors,

          data: yValues,

        },

      ],

    },

    options: {

      title: {

        display: true,

        text: "World Wide Wine Production 2018",

      },

    },

  });

}

function graficoRosca() {

  var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];

  var yValues = [55, 49, 44, 24, 15];

  var barColors = ["#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145"];



  new Chart("myChart", {

    type: "doughnut",

    data: {

      labels: xValues,

      datasets: [

        {

          backgroundColor: barColors,

          data: yValues,

        },

      ],

    },

    options: {

      title: {

        display: true,

        text: "World Wide Wine Production 2018",

      },

    },

  });

}

function foco(){
  const senha1 = document.getElementById('csenha');
  const senha2 = document.getElementById('cconf');

if(senha1.value === senha2.value){}else{
  alert('Senha não confere! Digite novamente!')
  document.getElementById('cconf').value = '';
  document.getElementById('csenha').value = '';
  document.getElementById("csenha").focus(); 
}
  
}

/*function apiCep(){


  const preencher = (endereco) =>{
      document.getElementById('crua').value = endereco.logradouro;
      document.getElementById('cbar').value = endereco.bairro;
      document.getElementById('ccid').value = endereco.localidade;
      document.getElementById('cest').value = endereco.uf;
  }

  const eNumero = (numero) => /^[0-9]+$/.test(numero);
  const cepValido = (ccep) => ccep.length == 8 && eNumero(ccep);
  const pesquisarCep = async() => {

      const cep = document.getElementById('ccep').value.replace("-","");
      const url = `https://viacep.com.br/ws/${cep}/json/`;
      if (cepValido(cep)){
          const dados = await fetch(url);
          const endereco = await dados.json();
          if (endereco.hasOwnProperty('erro')){
              document.getElementById('cend').value = 'CEP não encontrado!';
          }else {
              preencher(endereco);
          }
      }else{
          document.getElementById('cend').value = 'CEP incorreto!';
      }
  }
  document.getElementById('ccep').addEventListener('focusout',pesquisarCep)
  }*/

function pes() {


}
