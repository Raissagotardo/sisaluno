<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index- pagina inicial</title>
</head>
<style>
     body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0; 
            align-items: center;
          justify-content: center;
        }

        .container {
         
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
         justify-content: space-around;
         background-color: #b22222;
         border-radius: 10px;
        }

        .titulo {
          height: 150px;
          background-color: #f5f5f5;
            font-size: 24px;
            font-weight: bold;
            color: #b22222;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .cad, .lista {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .button {
            background-color: #b22222;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            height: 40px;
            width: 200px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #800000;
        }

        .button a {
            color: #fff;
            text-decoration: none;
        }

        .button a:hover {
            color: #fff;
        }

        @media (max-width: 600px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
<body> 
  <p class="titulo">Sistema de Cadastros</p>
     <div class="container"> 
       
        <div class="cad">
    <button class="button"><a href="./professor/cadprofessor.php">Cadastrar Professor</a></button>
    <button class="button"><a href="./aluno/cadaluno.php">Cadastrar Aluno</a></button>
</div>
<div class="lista">
<button class="button"><a href="./professor/listaprofessor.php">Lista de Professores</a></button>
    <button class="button"><a href="./aluno/listaaluno.php"> Lista de Alunos</a></button>
  </div>
</div>
</body>
</html>