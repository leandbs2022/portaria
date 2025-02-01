
function alerta(){
  alert('em desenvolvimento')
}



function mudaFoto(foto) {
  document.getElementById("icone").src = foto;
}
function limparText(){
documento.getElementById('').value=""

}
function cal_total() {
  let qtd = document.getElementById("cqua").value;
  tot = qtd * 1500;
  document.getElementById("cpre").value = Number(tot);
  document.getElementById("tcadastro").click;
}

function limpar() {
  document.getElementById("cnome").value = "";
  document.getElementById("csenha").value = "";
  document.getElementById("cmail").value = "";
}
function botao() {
  let desligar = document.getElementById("cloc").value;
  let botton = document.getElementById("clocaliza").disabled;
  if (desligar === "") {
    botton.disabled = false;

  } else {
    botton.disabled = true;

  }
}

window.onload = function() {
  var input = document.getElementById("nome");
  input.focus();  // Foca no campo de entrada

  // Configura o cursor na posição desejada (por exemplo, na posição 5)
  input.setSelectionRange(0, 0);  // A posição 5 é onde o cursor será colocado
};

function limparConteudo() {
  document.getElementById("screen_alt").innerHTML = ""; 
  document.getElementById("nome").focus(); 
  
}
function desativar() {
  document.addEventListener("DOMContentLoaded", function() {
    const tela = document.getElementById("borda");
   tela.disabled = true;
});
}
function rolar(){
  window.scrollBy(0,01);
  velocidade = setTimeout('rolar()',50);
  }

  function carregarURL() {
    // URL que será carregada
    var url = "portaria.php";
    
    // Redirecionar para a nova URL
    window.location.href = url;
  }
  function carregarModal() {
    // URL que será carregada
    var url = "#entrada";
    
    // Redirecionar para a nova URL
    window.location.href = url;
  }
  function novo_ramal() {
    // URL que será carregada
    var url = "alterar_ramal.php";
    
    // Redirecionar para a nova URL
    window.location.href = url;
  }



  function copiarTexto() {
      // Seleciona o elemento input
      const texto = document.getElementById("texto");

      // Seleciona o texto dentro do input
      texto.select();

      // Para dispositivos móveis, você pode usar o setSelectionRange
      texto.setSelectionRange(0, 99999); // Para dispositivos móveis

      // Copia o texto selecionado para a área de transferência
      document.execCommand("copy");

      // Exibe uma mensagem de confirmação
      alert("Texto copiado: " + texto.value);
  }

  function camera (){
    var video = document.querySelector('video');
    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(stream => {
            video.srcObject = stream;
            video.play();
        })
        .catch(error => {
            console.log(error);
        })

    document.querySelector('button').addEventListener('click', () => {
        var canvas = document.querySelector('canvas');
        canvas.height = video.videoHeight;
        canvas.width = video.videoWidth;
        var context = canvas.getContext('2d');
        context.drawImage(video, 0, 0);
        var link = document.createElement('a');
        link.download = 'foto.png';
        link.href = canvas.toDataURL();
        link.textContent = 'Clique para baixar a imagem';
        document.body.appendChild(link);
    });

  }

  
  