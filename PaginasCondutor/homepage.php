<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
  header("Location: ../index.php");
  exit();
}

include('../CRUD/conexao.php');

$condutor_id = $_SESSION['dados']['id_usuario'];




// Obtém o ID do condutor logado da sessão
$fk_id_condutor = $_SESSION['dados']['id_usuario'];

// Consulta para contar o número de alunos vinculados ao condutor logado
$sql = "SELECT COUNT(*) AS total_alunos FROM alunocondutor WHERE fk_id_condutor = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $fk_id_condutor);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_alunos = $row['total_alunos'];

// Consulta para contar o número de valores vinculados ao condutor logado
$sql = "SELECT SUM(valor_mensalidade) AS totalvalor_alunos FROM alunocondutor WHERE fk_id_condutor = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $fk_id_condutor);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalvalor_alunos = $row['totalvalor_alunos'];


// Consulta para contar o número de valores vinculados ao condutor logado no anoo
$sql = "SELECT SUM(valor_mensalidade * 12) AS totalvalorano_alunos FROM alunocondutor WHERE fk_id_condutor = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $fk_id_condutor);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalvalorano_alunos = $row['totalvalorano_alunos'];

if (isset($_GET['ajax'])) {
  $results_per_page = 10;
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start_from = ($page - 1) * $results_per_page;


  $sql = "SELECT ac.id_aluno, ac.nome_aluno, ac.data_nasc, ac.horarioentrada, ac.horariosaida, 
                 ac.destinoinicial, ac.destinofinal, ac.id_responsavel
          FROM alunocondutor ac
          JOIN cadastro c ON ac.fk_id_condutor = c.id_usuario
          WHERE c.id_usuario = $condutor_id
          LIMIT $start_from, $results_per_page";

  $resultado = mysqli_query($conexao, $sql);

  if (!$resultado) {
    die("Erro ao consultar alunos: " . mysqli_error($conexao));
  }

  $data = [];
  while ($row = mysqli_fetch_assoc($resultado)) {
    $data[] = $row;
  }

  $sql = "SELECT COUNT(ac.id_aluno) AS total FROM alunocondutor ac JOIN cadastro c ON ac.fk_id_condutor = c.id_usuario WHERE c.id_usuario = $condutor_id";
  $resultado = mysqli_query($conexao, $sql);
  $row = mysqli_fetch_assoc($resultado);
  $total_pages = ceil($row['total'] / $results_per_page);

  mysqli_close($conexao);

  echo json_encode(['data' => $data, 'total_pages' => $total_pages]);
  exit;
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
  <title>VANN</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Popper -->
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <!-- Main Styling -->
  <link href="../assets/css/argon-dashboard-tailwind.css?v=1.0.1" rel="stylesheet" />

  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  </head>
  <style>
          /* Estilo do menu */
          #mobileMenu {
            position: fixed;
            top: 0;
            left: 0; /* Alterado para o lado esquerdo */
            width: 250px; /* Largura do menu */
            height: 100vh; /* Altura total da tela */
            background-color: #fec85a; /* Cor de fundo */
            display: none; /* Inicialmente oculto */
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            z-index: 1000; /* Garantir que o menu fique acima de outros conteúdos */
            transform: translateX(-100%); /* Inicialmente fora da tela */
            transition: transform 0.3s ease;
        }

        #mobileMenu.show {
            display: flex;
            transform: translateX(0); /* Mostrar menu */
        }

        #mobileMenu a {
            display: block;
            text-align: start;
            color: white; /* Cor do texto */
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s;
        }

        #mobileMenu a:hover {
            background-color: #ffb347; /* Cor de fundo ao passar o mouse */
            color: #fff; /* Cor do texto ao passar o mouse */
        }

        #toggleButton {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #fff; /* Cor do ícone do botão */
        }

        #closeButton {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #333; /* Cor do ícone de fechar */
            align-self: flex-end; /* Alinha o botão ao topo direito do menu */
            margin: 10px; /* Margem para o botão de fechar */
        }

        @media (min-width: 1024px) {
            #mobileMenu {
                display: flex;
                position: static;
                flex-direction: row;
                background-color: transparent;
                box-shadow: none;
                height: auto;
                width: auto;
                transform: none;
            }

            #toggleButton {
                display: none; /* Ocultar botão em telas grandes */
            }

            #mobileMenu a {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                display: none;
            }
            #closeButton{
              display: none;
            }
        }
    </style>
</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-yellow-200 text-slate-500">
  <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
  <!-- sidenav  -->
  <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
    <div class="h-19">
      <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
      <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="./homepage.php" target="_blank">
        <img src="../assets/img/vannn.png" class="logovann">
      </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">
        <li class="mt-0.5 w-full">
          <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="./homepage.php">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Home</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="cadastraraluno.php">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 fas fa-plus"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Cadastrar novos alunos</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="iniciarrota.php">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="fa-solid fa-route text-blue-500"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Iniciar Rota</span>
          </a>
        </li>




        <li class="mt-0.5 w-full">
          <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="atualizarcadastro.php">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="fa-solid fa-id-card"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Atualizar documentos.</span>
          </a>
        </li>


        <li class="w-full mt-4">
          <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Página de perfil</h6>
        </li>

        <li class="mt-0.5 w-full">
          <a class=" dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="./perfil.php">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Perfil</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="../logout.php">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-orange-500 fas fa-sign-out-alt"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Sair da conta</span>
          </a>
        </li>



        </a>
        </li>
      </ul>
    </div>


  </aside>

  <!-- end sidenav -->

  <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- Navbar -->
    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="text-sm leading-normal">
              <a class="text-white opacity-50" href="javascript:;">Pagina</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Condutores</li>
          </ol>
          <h6 class="mb-0 font-bold text-white capitalize">Painel de controle</h6>
        </nav>





        </ul>
        </li>
        </ul>
      </div>
      </div>
      <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
      <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <button id="toggleButton" class="text-white lg:hidden">
            <i class="fas fa-bars"></i>
        </button>
        <!-- O resto do conteúdo da navbar -->

        <!-- Menu Toggle -->
        <nav id="mobileMenu" class="hidden lg:flex flex-col lg:flex-row lg:items-center">
        <button id="closeButton">
                <i class="fas fa-times"></i> <!-- Ícone de fechar -->
            </button>
            <a href="#home">Home</a>
            <a href="cadastraraluno.php">Cadastrar Novos Alunos</a>
            <a href="iniciarrota.php">Iniciar Rota</a>
            <a href="atualizarcadastro.php">Atualizar Documentos</a>
            <a href="perfil.php">Perfil</a>
            <a href="../logout.php">Sair da Conta</a>
        </nav>
    </div>
    <script>
        document.getElementById('toggleButton').addEventListener('click', function() {
            var menu = document.getElementById('mobileMenu');
            // Alterna a classe 'show' para mostrar ou esconder o menu
            menu.classList.toggle('show');
        });

        document.getElementById('closeButton').addEventListener('click', function() {
            var menu = document.getElementById('mobileMenu');
            // Remove a classe 'show' para esconder o menu
            menu.classList.remove('show');
        });
    </script>
</nav>

    </nav>

    <!-- end Navbar -->

    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
      <!-- row 1 -->
      <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Faturamento mensal</p>
                    <h5 class="mb-2 font-bold dark:text-white">R$ <?php echo number_format($totalvalor_alunos, 2, ',', '.') ?></h5>
                    <p class="mb-0 dark:text-white dark:opacity-60">
                      <span class="text-sm font-bold leading-normal text-emerald-500">Total renda mensal</span>
                    </p>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                    <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Renda anual prevista</p>
                    <h5 class="mb-2 font-bold dark:text-white">R$ <?php echo number_format($totalvalorano_alunos, 2, ',', '.') ?></h5>
                    <p class="mb-0 dark:text-white dark:opacity-60">
                      <span class="text-sm font-bold leading-normal text-emerald-500">Projeção de renda</span>

                    </p>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                    <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Avaliação do serviço</p>
                    <h5 class="mb-2 font-bold dark:text-white">4.5</h5>
                    <p class="mb-0 dark:text-white dark:opacity-60">
                      <span class="text-sm font-bold leading-normal text-emerald-500">Avaliação de usuários</span>

                    </p>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600 relative">
                    <i class="ni leading-none text-lg relative top-3.5 text-white"></i>
                    <span class="star-icon"></span>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>


        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
          <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
              <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                  <div>
                    <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Alunos cadastrados</p>
                    <h5 class="mb-2 font-bold dark:text-white"><?php echo $total_alunos; ?></h5>
                    <p class="mb-0 dark:text-white dark:opacity-60">
                      <span class="text-sm font-bold leading-normal text-emerald-500">Alunos da van</span>
                    </p>
                  </div>
                </div>
                <div class="px-3 text-right basis-1/3">
                  <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                    <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- card4 -->

      </div>

      <!-- cards row 2 -->
      <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
          <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
              <h6 class="capitalize dark:text-white">Visualização de aumento de alunos </h6>
              <canvas id="graficoGanhosMensais" width="700" height="270"></canvas>

              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  // Aqui você fará a requisição AJAX para o PHP para obter os dados
                  fetch('fetch_ganhos_condutor.php')
                    .then(response => response.json())
                    .then(data => {
                      // Preparar os dados para o gráfico
                      const meses = data.map(item => `${item.mes}/${item.ano}`);
                      const valores = data.map(item => item.total_ganho);

                      // Configuração do gráfico com Chart.js
                      const ctx = document.getElementById('graficoGanhosMensais').getContext('2d');
                      const grafico = new Chart(ctx, {
                        type: 'bar',
                        data: {
                          labels: meses,
                          datasets: [{
                            label: 'Ganhos Mensais do Condutor',
                            data: valores,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            innerHeight: 20
                          }]
                        },
                        options: {
                          scales: {
                            yAxes: [{
                              ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                  return 'R$ ' + value.toFixed(2);
                                }
                              }
                            }]
                          },
                          tooltips: {
                            callbacks: {
                              label: function(tooltipItem) {
                                return 'R$ ' + tooltipItem.yLabel.toFixed(2);
                              }
                            }
                          }
                        }
                      });
                    })
                    .catch(error => console.error('Erro ao carregar dados:', error));
                });
              </script>
            </div>

          </div>
        </div>

        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
          <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
            <!-- slide 1 -->
            <div slide class="absolute w-full h-full transition-all duration-500">
              <img class="object-cover h-full" src="../assets/img/planopremium.png" alt="carousel image" />
              <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                <h5 class="mb-1 text-white"></h5>
                <p class="dark:opacity-80"></p>
              </div>
              </di>



              <!-- Control buttons -->
            </div>
          </div>
        </div>

        <!-- cards row 3 -->

        <table>
          <thead>
            <tr>
              <th>Nome Aluno</th>
              <th>Horário de Entrada</th>
              <th>Horário de Saída</th>
              <th>Destino Inicial</th>
              <th>Destino Final</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="table-body">
            <!-- Os dados serão preenchidos via AJAX -->
          </tbody>
        </table>

        <div class="pagination" id="pagination">
          <!-- Links de paginação serão preenchidos via AJAX -->
        </div>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
            loadTable(1);

            function loadTable(page) {
              const xhr = new XMLHttpRequest();
              xhr.open("GET", "fetch_data.php?page=" + page, true);
              xhr.onload = function() {
                if (this.status === 200) {
                  try {
                    const response = JSON.parse(this.responseText);
                    const tableBody = document.getElementById('table-body');
                    tableBody.innerHTML = "";

                    response.data.forEach(function(row) {
                      const tr = document.createElement('tr');
                      tr.innerHTML = `
                                    <td>${row.nome_aluno}</td>
                                    <td>${row.horarioentrada}</td>
                                    <td>${row.horariosaida}</td>
                                    <td>${row.destinoinicial}</td>
                                    <td>${row.destinofinal}</td>
                                    <td class="btn-container">
                                       ${row.btn_editar} 
                                        ${row.btn_visualizar_rota}
                                        ${row.btn_whatsapp}
                                    </td>
                                `;
                      tableBody.appendChild(tr);
                    });

                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = "";

                    for (let i = 1; i <= response.total_pages; i++) {
                      const a = document.createElement('a');
                      a.href = "#";
                      a.textContent = i;
                      if (i === page) {
                        a.classList.add('active');
                      }
                      a.addEventListener('click', function(e) {
                        e.preventDefault();
                        loadTable(i);
                      });
                      pagination.appendChild(a);
                    }
                  } catch (error) {
                    console.error("Erro ao processar resposta JSON:", error);
                  }
                } else {
                  console.error("Erro ao carregar dados da tabela. Status:", this.status);
                }
              };
              xhr.send();
            }
          });
        </script>

        <footer class="pt-4">
          <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">


            </div>
          </div>
        </footer>
      </div>
      <!-- end cards -->
  </main>



  </div>
  </div>


  </div>
  </div>
  </div>
</body>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    loadTable(1);

    function loadTable(page) {
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "index.php?page=" + page + "&ajax=1", true);
      xhr.onload = function() {
        if (this.status === 200) {
          const response = JSON.parse(this.responseText);
          const tableBody = document.getElementById('table-body');
          tableBody.innerHTML = "";

          response.data.forEach(function(row) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                                <td>${row.nome_aluno}</td>
                                <td>${row.horarioentrada}</td>
                                <td>${row.horariosaida}</td>
                                <td>${row.destinoinicial}</td>
                                <td>${row.destinofinal}</td>
                                <td class="btn-container">
                                <button class="btn-info" onclick="editarAluno(${row.id_aluno})">
                                <i class="fas fa-map-marker-alt"></i> Visualizar Rota
                            </button>
                                    <button onclick="visualizarRota(${row.id_aluno})">
                                        <i class="fas fa-map-marker-alt icon"></i> Visualizar Rota
                                    </button>
                                    <button onclick="entrarWhatsapp(${row.id_responsavel})" class="zap">
                                        <i class="fab fa-whatsapp icon"></i> Entrar no WhatsApp
                                    </button>
                                </td>
                            `;
            tableBody.appendChild(tr);
          });

          const pagination = document.getElementById('pagination');
          pagination.innerHTML = "";

          for (let i = 1; i <= response.total_pages; i++) {
            const a = document.createElement('a');
            a.href = "#";
            a.textContent = i;
            a.classList.add(i === page ? 'active' : '');
            a.addEventListener('click', function(e) {
              e.preventDefault();
              loadTable(i);
            });
            pagination.appendChild(a);
          }
        }
      }
      xhr.send();
    }
  });


  function entrarWhatsapp(telefone) {
    // Monta o link do WhatsApp com o número e a mensagem
    const mensagem = encodeURIComponent('');
    const url = `https://api.whatsapp.com/send/?phone=${telefone}&text=${mensagem}&type=phone_number&app_absent=0`;

    // Abre uma nova aba com o link do WhatsApp
    window.open(url, '_blank');
  }
  $(document).ready(function() {
    loadTable(1);

    function loadTable(page) {
      $.ajax({
        url: 'fetch_data.php',
        type: 'GET',
        dataType: 'json',
        data: {
          page: page
        },
        success: function(response) {
          const tableBody = $('#table-body');
          tableBody.empty();

          response.data.forEach(function(row) {
            const tr = $('<tr>');
            tr.append(`<td>${row.nome_aluno}</td>`);
            tr.append(`<td>${row.horarioentrada}</td>`);
            tr.append(`<td>${row.horariosaida}</td>`);
            tr.append(`<td>${row.destinoinicial}</td>`);
            tr.append(`<td>${row.destinofinal}</td>`);
            tr.append(`
                        <td class="btn-container">
                        <button class="btn-info editar" onclick="editarAluno(${row.id_aluno})">
                                <i class="fas fa-map-marker-alt"></i> Editar Aluno
                            </button>
                            <button class="btn-info" onclick="visualizarRota(${row.id_aluno})">
                                <i class="fas fa-map-marker-alt"></i> Visualizar Rota
                            </button>
                            <button class="zap" onclick="entrarWhatsapp(${row.id_responsavel})">
                                <i class="fab fa-whatsapp"></i> Entrar no WhatsApp
                            </button>
                        </td>
                    `);
            tableBody.append(tr);
          });

          const pagination = $('#pagination');
          pagination.empty();

          for (let i = 1; i <= response.total_pages; i++) {
            const a = $('<a>');
            a.addClass('page-link');
            a.attr('href', '#');
            a.text(i);
            if (i === page) {
              a.addClass('active');
            }
            a.click(function(e) {
              e.preventDefault();
              loadTable(i);
            });
            const li = $('<li>').addClass('page-item').append(a);
            pagination.append(li);
          }
        },
        error: function(xhr, status, error) {
          console.error('Erro ao carregar dados da tabela:', error);
        }
      });
    }
  });

  function visualizarRota(idAluno) {
    // Redirecionar para visualizarrota.php com o ID do aluno como parâmetro
    window.location.href = `visualizarrota.php?id_aluno=${idAluno}`;
  }

  function editarAluno(idAluno) {
    // Redirecionar para visualizarrota.php com o ID do aluno como parâmetro
    window.location.href = `editaraluno.php?id=${idAluno}`;
  }
</script>
<!-- plugin for charts  -->
<script src="../assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>