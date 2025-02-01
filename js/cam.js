
// Acessando a webcam
const video = document.getElementById('video');
navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
        video.srcObject = stream;
    })
    .catch(function (error) {
        console.log("Erro ao acessar a webcam:", error);
    });

// Função para capturar a foto
const canvas = document.getElementById('canvas');
const captureButton = document.getElementById('capture');
const context = canvas.getContext('2d');

// Função para ajustar o tamanho do canvas de acordo com a tela
function resizeCanvas() {
    canvas.width = window.innerWidth;  // Define a largura do canvas como a largura da tela
    canvas.height = window.innerHeight;  // Define a altura do canvas como a altura da tela
}

captureButton.addEventListener('click', function () {
    // Desenha o vídeo no canvas
   
   
    context.drawImage(video, 0, 0, 320, 240);

    // Converte o canvas para imagem em base64
    const imageData = canvas.toDataURL('image/png');

    // Envia a imagem para o servidor
    fetch('salvar_foto.php', {
        method: 'POST',
        body: JSON.stringify({ image: imageData }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Erro ao enviar a imagem:', error));
});
