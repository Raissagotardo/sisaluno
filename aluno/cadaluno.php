<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de alunos</title>
</head>
<style>
  body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 40%;
            padding: 20px;
            border: 2px solid #b22222;
            border-radius: 10px;
            background-color: #fff;
            justify-content: center;
            align-items: center;
        }

        .informacoes, .info {
            font-size: 18px;
            color: #b22222;
        }

        .dados, .input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #b22222;
            border-radius: 5px;
        }

        #cadastrar {
            background-color: #b22222;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-left: 110px;
        }

        #cadastrar:hover {
            background-color: #800000;
        }

        .button {
          padding: 10px 20px;
  background-color: #b22222;
  color: #FFFFFF;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-left: 100px;
        }

        .button:hover {
          background-color: #800000;
        }
</style>
<body>
    <div class="container">
        <form action="crudaluno.php" method="get">
            <p class="informacoes"> Digite seu nome: </p>
            <p> <input type="text" name="nomealuno" class="dados"></p>
            <div class="idcpftel">
                <p class="info"> Digite sua idade: </p>
            <p> <input type="number" name="idadealuno" class="input"></p>
            <p class="info"> Digite sua data de nascimento: </p>
            <p> <input type="date" name="datanascimentoaluno" class="input"></p>
            <p class="informacoes"> Digite seu endereço: </p>
            <p> <input type="text" name="enderecoaluno" class="dados"></p>
          <p class="info"> Digite seu status: </p>
            <p> <input type="text" name="estatusaluno" class="input"></p>
         </div>
            <input TYPE="hidden" NAME="form_submit" VALUE="OK"> 
        <input type="submit" name="cadastrar" value="Cadastrar" id="cadastrar"> 
        <button class="button"><a href="index.php">Voltar</a></button>
        </form>
       
    </div>
</body>
</html>