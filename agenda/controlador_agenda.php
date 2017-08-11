<?php
    //Cadastra contatos
    function cadastro($nome, $email, $tel){
        //Lê contatos.json e transforma em array
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        $contato = [
            'id'      => uniqid(),
            'nome'    => $nome,
            'email'  => $email,
            'telefone'=> $tel
        ];

        //Adiciona contatos no array
        array_push($contatosAuxiliar, $contato);

        //Transforma o array em .json
        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);

        file_put_contents('contatos.json', $contatosJson);

        //Retorna á pagina inicial
        header("Location: index.phtml");
    }

    //Lê contatos.json e transforma em array 
    function getContatos(){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        return $contatosAuxiliar;
    }

    //Exclui contato
    function excluirContato($id){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

            foreach ($contatosAuxiliar as $posicao => $contato) {
                if ($id == $contato['id']) {
                    unset($contatosAuxiliar[$posicao]);
                }
            }

        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);
        file_put_contents('contatos.json', $contatosJson);

        header('Location: index.phtml');
    }

    //Edita contato 
    function editarContato($id){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        foreach ($contatosAuxiliar as $contato) {
            if ($contato['id'] == $id){
                return $contato;
            }
        }

    }

    //Salva contato depois de editar
    function salvarContatoEditado($id, $nome, $tel, $email){
        $contatosAuxiliar = file_get_contents('contatos.json');
        $contatosAuxiliar = json_decode($contatosAuxiliar, true);

        foreach ($contatosAuxiliar as $posicao => $contato) {
            if ($contato['id'] == $id){
                $contatosAuxiliar[$posicao]['nome'] = $nome;
                $contatosAuxiliar[$posicao]['telefone'] = $tel;
                $contatosAuxiliar[$posicao]['email'] = $email;

                break;
            }
        }
        $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT);

        file_put_contents('contatos.json', $contatosJson);

        header('Location: index.phtml');
    }

    //Busca contato pelo nome // deu errado e ficou assim
    function buscar($nome){
        $contatosAuxiliar = getContatos();

        $contatosEncontrados = [];

        foreach ($contatosAuxiliar as $contato){
            if ($contato['nome'] == $nome){
                $contatosEncontrados[] = $contato;
            }
        }

        return $contatosEncontrados;
    }

    //Rotas
    if ($_GET['acao'] == 'cadastro'){
        cadastro($_POST['nome'],$_POST['email'],$_POST['telefone']);
    }elseif ($_GET['acao'] == 'excluir'){
        excluirContato($_GET['id']);
    }elseif ($_GET['acao'] == 'editar'){
        salvarContatoEditado($_POST['id'],$_POST['nome'],$_POST['telefone'],$_POST['email']);
    }

?>