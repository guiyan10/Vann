<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

$usuario_id = $_SESSION['dados']['id_usuario'];



include('../CRUD/conexao.php');

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Main Styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="../assets/css/homepageusuario.css" rel="stylesheet" />
  </head>
  <style>
        .whatsapp-button {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 16px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .whatsapp-button i {
            margin-right: 10px;
        }
        i.fab.fa-whatsapp {
    margin-right: 10px;
}
    </style>
  <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-yellow-200 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
      <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="./homepage.php" target="_blank">
          <img src="../assets/img/vannn.png" style="width: 90%;" class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8" alt="main_logo" />
           <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand"></span>
        </a>
      </div>

      <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

      <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
          <li class="mt-0.5 w-full">
            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="../pages/dashboard.html">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Home</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="./tables.php">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                <i class="relative top-0 text-sm leading-normal text-orange-500 fas fa-plus"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Buscar condutores</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="./localizacaoalunopai.php">
              <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="fa-solid fa-location-dot"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Localização em tempo real</span>
            </a>
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
          
          <script>
            // Adicionando um evento de clique ao botão "Sair da conta"
            document.querySelector('.sair-da-conta-btn').addEventListener('click', function(event) {
              event.preventDefault(); // Evita que o link seja seguido
          
              // Aqui você pode adicionar o código para fazer logout do usuário ou realizar outras ações necessárias
          
              // Por exemplo, redirecionar o usuário para a página de login
              window.location.href = '../pages/sign-in.html';
            });
          </script>
          
          
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
                <a class="text-white opacity-50" href="javascript:;">Pages</a>
              </li>
              <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Usuarios</li>
            </ol>
            <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
          </nav>

          <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto"></div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
              <!-- online builder btn  -->
              <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 text-xs font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->
             
              <li class="flex items-center pl-4 xl:hidden">
                <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" sidenav-trigger>
                  <div class="w-4.5 overflow-hidden">
                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                    <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                  </div>
                </a>
              </li>
              <li class="flex items-center px-4">
                
              </li>

              <!-- notifications -->

              <li class="relative flex items-center pr-2">
                <p class="hidden transform-dropdown-show"></p>
                
              
                

                  
                </ul>
              </li>
            </ul>
          </div>
        </div>
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
        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Gastos mensais</p>
        <?php

$db_host = 'localhost';
$db_name = 'banco_vann';
$db_user = 'root';
$db_pass = '';

// Configuração da conexão PDO
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    // Configuração para lançar exceções em erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro na conexão
    die('Erro de conexão com o banco de dados: ' . $e->getMessage());
}
        // Obtém o ID do usuário logado da sessão
        $id_usuario = $_SESSION['dados']['id_usuario'];

        // Exemplo de consulta SQL para obter o valor da mensalidade do usuário logado
        $sql = "SELECT ac.valor_mensalidade
                FROM alunocondutor ac
                INNER JOIN cadastro u ON ac.id_responsavel = u.id_usuario
                WHERE u.id_usuario = ?";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_usuario]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $valor_mensalidade = $resultado['valor_mensalidade'];
                echo '<h5 class="mb-2 font-bold dark:text-white">R$' . number_format($valor_mensalidade, 2, ',', '.') . '</h5>';
            } else {
                echo '<h5 class="mb-2 font-bold dark:text-white">Valor não encontrado</h5>';
            }
        } catch (PDOException $e) {
            // Tratar erro de execução da consulta
            echo "Erro na execução da consulta: " . $e->getMessage();
        }
        ?>
        <p class="mb-0 dark:text-white dark:opacity-60">
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
              <div class="flex-auto p-4" >
                <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
    <div>
        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Gasto anual</p>
        <?php
        $db_host = 'localhost';
        $db_name = 'banco_vann';
        $db_user = 'root';
        $db_pass = '';

        // Configuração da conexão PDO
        $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $db_user, $db_pass);
            // Configuração para lançar exceções em erros
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obtém o ID do usuário logado da sessão
            $id_usuario = $_SESSION['dados']['id_usuario'];

            // Exemplo de consulta SQL para obter o valor da mensalidade do usuário logado
            $sql = "SELECT ac.valor_mensalidade
                    FROM alunocondutor ac
                    INNER JOIN cadastro u ON ac.id_responsavel = u.id_usuario
                    WHERE u.id_usuario = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id_usuario]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $valor_anual = $valor_mensalidade * 12; // Calcula o valor anual

                echo '<h5 class="mb-2 font-bold dark:text-white"> R$' . number_format($valor_anual, 2, ',', '.') . '</h5>';
            } else {
                echo '<h5 class="mb-2 font-bold dark:text-white">Valor não encontrado</h5>';
            }
        } catch (PDOException $e) {
            // Tratar erro de execução da consulta
            echo "Erro na execução da consulta: " . $e->getMessage();
        }
        ?>
        <p class="mb-0 dark:text-white dark:opacity-60">
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
          
          <!-- card4 -->
         
        </div>

        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none" >
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border"  style="background-color: #2a2a2a">
              <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0" >
                <h6 class="capitalize dark:text-white" style="COLOR: aliceblue;" >Visualizar Rota </h6>
                <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                  <i class="fa fa-arrow-up text-emerald-500"></i>
                  <span class="font-semibold" style="COLOR: aliceblue;" >Acompanhe em tempo real</span> 
                </p>
              </div>
              <div class="flex-auto p-4" style="background-color: #2a2a2a">
                <div>
                  <img src="../assets/img/LOCALIZAÇÃO.png"  style=" width: 100%">
                </div>
              </div>
            </div>
          </div>

          <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
              <!-- slide 1 -->
              <div slide class="absolute w-full h-full transition-all duration-500">
                <img class="object-cover h-full" src="../assets/img/Instagram post quem sou roxo e verde (1).png"  alt="carousel image" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                  <div class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-camera-compact"></i>
                  </div>
                  <h5 class="mb-1 text-white"></h5>
                  <p class="dark:opacity-80"></p>
                </div>
              </di>

            

              <!-- Control buttons -->
        </div>
          </div>
        </div>

        <!-- cards row 3 -->

        <div class="flex flex-wrap mt-6 -mx-3" style="width:98%">
          <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none" style="width: 1600px;">
           
          <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl dark:bg-gray-950 border-black-125 rounded-2xl bg-clip-border">
    <div class="p-4 pb-0 mb-0 rounded-t-4">
        <div class="flex justify-between">
            <h6 class="mb-2 dark:text-white">Chat com o condutor</h6>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
            <tbody>
                <?php

$db_host = 'localhost';
$db_name = 'banco_vann';
$db_user = 'root';
$db_pass = '';

// Configuração da conexão PDO
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);
    // Configuração para lançar exceções em erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro na conexão
    die('Erro de conexão com o banco de dados: ' . $e->getMessage());
}
// Obtém o ID do usuário logado da sessão
$id_usuario = $_SESSION['dados']['id_usuario'];

// Exemplo de consulta SQL para obter o condutor relacionado com o telefone
$sql = "SELECT c.nome, c.telefone_condutor
        FROM alunocondutor ac
        INNER JOIN cadastro u ON ac.id_responsavel = u.id_usuario
        INNER JOIN condutor c ON ac.fk_id_condutor = c.fk_id_condutor
        WHERE u.id_usuario = ?";

// Prepare statement
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $condutores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($condutores as $condutor) {
        echo '<tr>
                <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                    <div class="flex items-center px-2 py-1">
                        <div>
                            <img src="../assets/img/usuario.png" alt="Country flag" height="40" width="40"/>
                        </div>
                        <div class="ml-6">
                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Condutor:</p>
                            <h6 class="mb-0 text-sm leading-normal dark:text-white">' . htmlspecialchars($condutor['nome']) . '</h6>
                        </div>
                    </div>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40"></td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40"></td>
                <td class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                    <div class="flex-1 text-center">
                        <button onclick="entrarWhatsapp(\'' . htmlspecialchars($condutor['telefone_condutor']) . '\')" class="buttonzap"><i class="fab fa-whatsapp"></i>Iniciar chat</button>
                           </div>
                </td>
            </tr>';
    }
} catch (PDOException $e) {
    // Tratar erro de execução da consulta
    echo "Erro na execução da consulta: " . $e->getMessage();
}
?>
</tbody>
</table>
</div>
</div>
<script>
function entrarWhatsapp(telefone) {
if (telefone) {
const mensagem = encodeURIComponent(''); // Mensagem vazia ou predefinida
const url = `https://api.whatsapp.com/send/?phone=${telefone}&text=${mensagem}`;
window.open(url, '_blank');
} else {
alert('Número de telefone não encontrado.');
}
}
</script>




            </div>
          </div>
         

        <footer class="pt-4">
          <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
              <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                
              </div>
              <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
               
              </div>
            </div>
          </div>
        </footer>
      </div>
      <!-- end cards -->
    </main>
    <div fixed-plugin>
      <!-- -right-90 in loc de 0-->
      <div fixed-plugin-card class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
        <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
          <div class="float-left">
            <h5 class="mt-4 mb-0 dark:text-white">Configure a VANN </h5>
            <p class="dark:text-white dark:opacity-80">Torne agravel a você.</p>
          </div>
          <div class="float-right mt-6">
            <button fixed-plugin-close-button class="inline-block p-0 mb-4 text-sm font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700">
              <i class="fa fa-close"></i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0 dark:text-white">Cores do Menu</h6>
          </div>
          <a href="javascript:void(0)">
            <div class="my-2 text-left" sidenav-colors>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-500 to-violet-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" active-color data-color="blue" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="gray" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-700 to-cyan-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="cyan" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-emerald-500 to-teal-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="emerald" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-orange-500 to-yellow-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="orange" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-red-600 to-orange-600 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="red" onclick="sidebarColor(this)"></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-4">
            <h6 class="mb-0 dark:text-white">Acessibilade</h6>
            <p class="text-sm leading-normal dark:text-white dark:opacity-80">Selecione a cor que mais te agrada</p>
          </div>
          <div class="flex">
            <button transparent-style-btn class="inline-block w-full px-4 py-2.5 mb-2 font-bold leading-normal text-center text-white capitalize align-middle transition-all bg-blue-500 border border-transparent border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-500 to-violet-500 hover:border-blue-500" data-class="bg-transparent" active-style>White</button>
            <button white-style-btn class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500" data-class="bg-white">Dark</button>
          </div>
         
        
          
            </div>
          </div>
                
         
        </div>
      </div>
    </div>
  </body>
  <!-- plugin for charts  -->
  <script src="../assets/js/plugins/chartjs.min.js" async></script>
  <!-- plugin for scrollbar  -->
  <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>
