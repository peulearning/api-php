<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Contato</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div class="form_container wow bounceInRight">
        <h2 class="text-white fz-24 editContent align-center">SOLICITAÇÃO DE TESTE</h2>
        <div class="reg_form">
            <form method="post" id="formulario" class="form-horizontal mb-20">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome e Sobrenome*">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail*">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" id="telefone" name="telefone" class="form-control"
                            placeholder="Telefone com DDD*" minlength="14" maxlength="15"
                            onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" inputmode="numeric">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade*" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select name="estado" id="estado" class="form-control" required=""
                            style="outline: none; cursor: pointer;">
                            <option value="">Selecione um estado</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AM">Amazonas</option>
                            <option value="AP">Amapá</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="PR">Paraná</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <select name="profissao" id="profissao" class="form-control" required=""
                            style="outline: none; cursor: pointer;">
                            <option value="">Selecione uma profissão</option>
                            <option value="Advogado(a)">Advogado(a)</option>
                            <option value="Estagiário de Direito">Estagiário(a) de Direito</option>
                            <option value="Assistente Jurídico">Assistente Jurídico</option>
                            <option value="Contador(a)">Contador(a)</option>
                            <option value="Perito(a)">Perito(a)</option>
                            <option value="Assistente Financeiro">Assistente Financeiro</option>
                            <option value="Setor de Compras">Setor de Compras</option>
                            <option value="Nenhuma das opções">Nenhuma das opções</option>
                        </select>
                    </div>
                </div>

                <button type="submit" id="btn_submit" class="fs_btn" style="margin-bottom: 10px">QUERO TESTAR
                    AGORA</button>
                <input type="hidden" name="fromsite" value="<?= $site ?>">
                <input type="hidden" name="ip" value="<?= $ip ?>">
                <input type="hidden" name="programas" value="previus">
                <div class="small hidden">* ao enviar o formulário você concorda com a nossa <a href=""
                        data-toggle="modal" data-target="#myModalPolitica">política de privacidade.</a></div>
            </form>
        </div>
    </div>

    <script>
        function mask(o, f) {
            setTimeout(function () {
                var v = mphone(o.value);
                if (v != o.value) {
                    o.value = v;
                }
            }, 1);
        }

        function mphone(v) {
            var r = v.replace(/\D/g, "");
            r = r.replace(/^0/, "");
            if (r.length > 10) {
                r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
            } else if (r.length > 5) {
                r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
            } else if (r.length > 2) {
                r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
            } else if (r.length > 1) {
                r = r.replace(/^(\d*)/, "($1");
            }
            return r;
        }

        function Close() {
            $('#alerta').modal('toggle');
            $('html,body').animate({
                scrollTop: $("body").offset().top
            }, 600);
            $("#nome").focus();
        }

        $(document).ready(function () {
            $('#estado').select2();
            $("#profissao").select2();
        });

        document.querySelector("#formulario").addEventListener("submit", function (event) {
            event.preventDefault();

            const form = document.querySelector("#formulario");
            // Inserir o id de cada campo do formulário na função getElementById
            let email = document.getElementById("email").value;
            let nome = document.getElementById("nome").value;
            let telefone = document.getElementById("telefone").value;
            let cidade = document.getElementById("cidade").value;
            let estado = document.getElementById("estado").value;
            let profissao = document.getElementById("profissao").value;

            let contato = {
                "contaGuid": "-MDuJ57cMSR1TAxX5iTa",
                "email": email,
                "nome": nome,
                "telefone": telefone,
                "cidade": cidade,
                "estado": estado,
                "profissao": profissao,
                "observacao": ""
            };

            if (nome && telefone && email && cidade && estado !== "Selecione um estado" && profissao !== "Nenhuma das opções") {
                function configPost(method, body) {
                    return {
                        "method": method,
                        "headers": {
                            "Content-Type": "application/json",
                            "Access-Control-Allow-Origin": "*",
                            "Access-Control-Allow-Headers": "Origin, X-Request-Width, Content-Type, Accept"
                        },
                        "body": JSON.stringify(body)
                    };
                }

                let endpoint = "https://crm.luggia.com.br/external/set-cliente/373";

                fetch('processa.php?act=go', {
                    method: 'POST',
                    body: new URLSearchParams(new FormData(form))
                }).then(response => response.text())
                    .then(() => {
                        document.querySelector(".alert-success").style.display = "block";
                        document.querySelector(".alert-danger").style.display = "none";
                        document.querySelector("#sucesso").innerHTML = `<b>Formulário Enviado com Sucesso!</b><br />Seu Download começará dentro de alguns segundos...<br>Caso não carregue automaticamente, clique no botão abaixo para fazer o download. <br /><br /><p><a href='${link_exe}' class='btn btn-success btn-software'><strong>Baixar ${titulo_botao}</strong></a></p>`;
                        document.querySelector(".step1").style.display = "none";
                        document.querySelector(".step2").style.display = "block";
                        if (programa === "previus") {
                            document.querySelector("#telas").style.display = "none";
                            document.querySelector("#telas_previus").style.display = "block";
                        }
                        window.location = link_exe;
                    });

                fetch(endpoint, configPost("POST", contato))
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        window.location.href = "https://previus.webjuris.com.br/obrigado";
                    })
                    .catch(error => {
                        console.error("Erro:", error);
                        alert("Erro ao enviar formulário.");
                    });
            } else {
                alert('Verifique os campos não preenchidos por favor!');
            }
        });
    </script>

</body>

</html>