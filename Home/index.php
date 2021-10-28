<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Bom Jobs Recrutamento</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Red+Hat+Text&display=swap');
        body { display: flex; justify-content: center; align-items: center; width: 70vw; height: 100vh; background: grey; margin: auto; font-family: 'Red Hat Text', sans-serif; }
        div { display: flex; justify-content: center; align-items: center; width: 49%; height: 200px; background-color: #262c5f; margin: 10px; color: white; font-size: 15pt; text-transform: uppercase; cursor: pointer; }
        div:hover { background-color: #f07f19; }
        @media screen and (max-width: 700px) { 
            body { width: 100vw; flex-direction: column; }
            div { width: 70%; font-size: 14pt; }
        }
       
    </style>
</head>
<body>
    <div onclick="location.href='../Login_Admin/'">Administrador</div>
    <div onclick="location.href='../Login_Contratante/'">Contratante</div>
</body>
</html>