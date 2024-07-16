<?php
function get_client_ip()
{
  $ip = $_SERVER["REMOTE_ADDR"];
  if (empty($ip)) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
  }
  return $ip;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="col-md-8 col-sm-9 col-xs-8">
    <form id="formulario" name="formulario" method="post" role="form">
      <div class="row">
        <div class="col-md-12 col-sm-12 p-b-15">
          <h3>Software</h3>
        </div>
        <div class="col-md-3 p-b-15">
          <input type="radio" id="previus" name="programas" class="programa" value="previus">
          <label for="previus">Prévius</label>
        </div>
        <div class="col-md-3 p-b-15">
          <input type="radio" id="peritus" name="programas" class="programa" value="peritus">
          <label for="peritus">Peritus</label>
        </div>
        <div class="col-md-3 p-b-15">
          <input type="radio" id="abacus" name="programas" class="programa" value="abacus">
          <label for="abacus">Ábacus</label>
        </div>
        <div class="col-md-3 p-b-15">

        </div>
      </div>
      <div class="row">

        <div class="col-md-12 col-sm-12 p-b-10">
          <label>Nome*</label>
          <input type="text" class="form-control" required name="nome" id="nome" value="" autocomplete="off" required />
        </div>


        <div class="col-md-12 col-sm-12 p-b-10">
          <label>Telefone*</label>
          <input type="text" class="form-control phone" required id="telefone" name="telefone" value="" minlength="14"
            maxlength="15" oninvalid="this.setCustomValidity('Preencha o telefone!');" oninput="setCustomValidity('')"
            onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" autocomplete="off" inputmode="numeric" />
        </div>

        <div class="col-md-12 col-sm-12 p-b-10">
          <label>Email*</label>
          <input type="email" class="form-control" required name="email" id="email" value="" autocomplete="off"
            required />
        </div>

        <div class="col-md-12 col-sm-12 p-b-10">
          <label>Profissão*</label>
          <select name="profissao" id="profissao" class="form-control" aria-required="true" aria-invalid="false"
            required>
            <option value="">Selecione</option>
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

        <div class="col-md-12 col-sm-12 p-b-10">
          <label>Estado*</label>
          <select name="estado" id="estado" class="form-control" aria-required="true" aria-invalid="false" required>
            <option value="">Selecione</option>
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
        <div class="col-md-12 col-sm-12 p-b-25">
          <label>Cidade*</label>
          <input type="text" class="form-control" required name="cidade" id="cidade" autocomplete="off" value="" />
        </div>


        <div class="col-md-12 col-sm-12">
          <input type="hidden" name="codigopreposto" value="1800">
          <input type="hidden" name="ip" value="<?php echo get_client_ip(); ?>
          <input type=" hidden" name="site" value="<?= $site ?>">
          <button type="submit" class="btn-light button-black" id="btn_submit" name="btn_submit">Enviar <i
              class="fa fa-angle-double-right" style="padding-left: 7px; font-size: 15px"></i></button>
        </div>
      </div>


    </form>
  </div>
  </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const produto = <?php echo isset($_GET['produto']) && $_GET['produto'] != '' ? json_encode("#" . $_GET['produto']) : json_encode('#previus'); ?>;
      document.querySelector(produto).checked = true;
      document.querySelector("form#formulario").style.display = "block";

      function updateProgramInfo() {
        const programa = document.querySelector("input[name='programas']:checked").value;
        let titulo_exe = '', link_exe = '';

        if (programa === "peritus") {
          titulo_exe = 'PERITUS 6.0';
          link_exe = 'https://logi.ke/LOGIKE_SITE_WEB/BRPT/Downloads.awp?A41';
        } else if (programa === "abacus") {
          titulo_exe = 'ABACUS 6.0';
          link_exe = 'https://logi.ke/LOGIKE_SITE_WEB/BRPT/Downloads.awp?A21';
        } else if (programa === "previus") {
          titulo_exe = 'PRÉVIUS 3.0';
          link_exe = 'https://logi.ke/LOGIKE_SITE_WEB/BRPT/Downloads.awp?A78';
        }

        document.querySelector("#titulo_exe").innerHTML = titulo_exe;
        document.querySelector(".link_exe").href = link_exe;
      }

      document.querySelectorAll("input[name='programas']").forEach(radio => {
        radio.addEventListener("change", updateProgramInfo);
      });

      document.querySelector("#nome").addEventListener("blur", function () {
        const str = this.value;
        const count = (str.match(/\w+/g) || []).length;
        if (count < 2) {
          alert("Por favor, informe o sobrenome!");
        }
      });

      document.querySelector('#btn_submit').addEventListener('click', function (e) {
        e.preventDefault();

        const form = document.querySelector("#formulario");
        const programa = document.querySelector("input[name=programas]:checked").value;
        const nome = document.querySelector("#nome").value;
        const telefone = document.querySelector("#telefone").value;
        const email = document.querySelector("#email").value;
        const cidade = document.querySelector("#cidade").value;
        const estado = document.querySelector("#estado").value;
        const profissao = document.querySelector("#profissao").value;
        const count = (nome.match(/\w+/g) || []).length;

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

        if (count < 2) {
          alert("Por favor, informe o sobrenome!");
        } else if (nome && telefone && email && cidade && estado && profissao !== "Nenhuma das opções") {
          let link_exe = '', titulo_botao = '';

          if (programa === "peritus") {
            link_exe = 'https://logi.ke/LOGIKE_SITE_WEB/BRPT/Downloads.awp?A41';
            titulo_botao = "Peritus 6.0";
          } else if (programa === "abacus") {
            link_exe = 'https://logi.ke/LOGIKE_SITE_WEB/BRPT/Downloads.awp?A21';
            titulo_botao = "Ábacus 6.0";
          } else if (programa === "previus") {
            link_exe = 'https://logi.ke/LOGIKE_SITE_WEB/BRPT/Downloads.awp?A78';
            titulo_botao = "Prévius 3.0";
          }

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


            let endpoint = "https://crm.luggia.com.br/external/set-cliente/373";

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
          }
        } else {
          alert('Verifique os campos não preenchidos por favor!');
        }
      });
    });
  </script>
</body>

</html>