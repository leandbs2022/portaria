<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webcam</title>
    <link rel="stylesheet" href="css/camera.css">
</head>

<body>
    <div class="direita">
    <video autoplay width="250" height="250"></video>
    <canvas></canvas>
    <button>Tirar foto</button>
    </div>
   
 
   

    <script>
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
    </script>
</body>

</html>