<?php
session_start();

if (!isset($_SESSION['logado']) || empty($_SESSION['dados']['id_usuario'])) {
    header("Location: ../index.php");
    exit();
}

include('../CRUD/conexao.php');

$fk_id_condutor = $_SESSION['dados']['id_usuario'];
// Certifique-se de que o ID do usuário está disponível na sessão
if (!isset($_SESSION['dados']['id_usuario'])) {
    die("Usuário não está autenticado.");
}

$usuario_id = $_SESSION['dados']['id_usuario'];

// Buscar dados do usuário da tabela Cadastro
$query_usuario = "SELECT nome_usuario, email_usuario FROM Cadastro WHERE id_usuario = ?";
$stmt_usuario = $conexao->prepare($query_usuario);
$stmt_usuario->bind_param('i', $usuario_id);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();
$usuario_dados = $result_usuario->fetch_assoc();

// Buscar dados do perfil da tabela info_usuario
$query_info = "SELECT endereco_condutor, cidade_condutor, pais_condutor, sobre_condutor FROM info_usuario WHERE fk_id_usuario = ?";
$stmt_info = $conexao->prepare($query_info);
$stmt_info->bind_param('i', $usuario_id);
$stmt_info->execute();
$result_info = $stmt_info->get_result();

// Verificar se há resultados da consulta info_usuario
if ($result_info->num_rows > 0) {
    $info_dados = $result_info->fetch_assoc();
} else {
    $info_dados = array(
        'endereco_condutor' => '',
        'cidade_condutor' => '',
        'pais_condutor' => '',
        'sobre_condutor' => ''
    );
}

// Mesclar dados do usuário e dados do perfil
$dados = array_merge($usuario_dados, $info_dados);

// Consulta para contar o número de alunos vinculados ao condutor logado
$sql = "SELECT COUNT(*) AS total_alunos FROM alunocondutor WHERE fk_id_condutor = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $fk_id_condutor);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_alunos = $row['total_alunos'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<style>
    /* Estilos gerais para o formulário */
form {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
 
}

/* Estilos para os rótulos dos campos */
label {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

/* Estilos para os inputs */
input[type="text"], 
input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    color: #333;
    background-color: #fff;
    transition: border-color 0.3s ease;
}

input[type="text"]:disabled,
input[type="email"]:disabled {
    background-color: #f0f0f0;
    cursor: not-allowed;
}

/* Estilos para o botão de editar */
button#editarBtn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button#editarBtn:hover {
    background-color: #0056b3;
}

/* Estilos para o botão de salvar */
button#salvarBtn {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: none; /* Inicialmente oculto */
}

button#salvarBtn:hover {
    background-color: #218838;
}

/* Estilos para a separação */
hr {
    border: none;
    height: 1px;
    background: #ddd;
    margin: 20px 0;
}


</style>

<body class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-base leading-default bg-gray-50 text-slate-500">
    <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
        <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>

    <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 xl:ml-6 max-w-64 ease-nav-brand z-990 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
        <div class="h-19">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="./homepage.php" target="_blank">
                <img src="../assets/img/vannn.png" class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8" alt="main_logo" />

            </a>
            
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors dark:text-white dark:opacity-80" href="./homepage.php">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-blue-500 ni ni-tv-2 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Home</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="./cadastraraluno.php">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 fas fa-plus"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Cadastrar novos Alunos</span>
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
                    <h6 class="pl-6 ml-2 font-bold leading-tight uppercase dark:text-white text-xs opacity-60">Página da Conta</h6>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80  text-sm ease-nav-brand my-0 mx-2 flex items-center rounded-lg whitespace-nowrap px-4 font-semibold text-slate-700 transition-colors" href="./perfil.php">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-slate-700 text-sm ni ni-single-02"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profile</span>
                    </a>
                </li>
                <nav></nav>
                <li class="mt-0.5 w-full">
                    <a class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="../logout.php">
                        <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-orange-500 fas fa-sign-out-alt"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Sair da conta</span>
                    </a>
                </li>

        </div>
    </aside>

    <div class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68">
        <nav class="absolute z-20 flex flex-wrap items-center justify-between w-full px-6 py-2 -mt-56 text-white transition-all ease-in shadow-none duration-250 lg:flex-nowrap lg:justify-start" navbar-profile navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-6 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 pl-2 pr-4 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="leading-normal text-sm">
                            <a class="opacity-50" href="javascript:;">Páginas</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal before:float-left before:pr-2 before:content-['/']" aria-current="page">Pefil</li>
                    </ol>
                    <h6 class="mb-2 ml-2 font-bold text-white capitalize dark:text-white">Perfil</h6>
                </nav>


                <!-- notifications -->

             
                

                    <ul dropdown-menu class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease lg:shadow-3xl duration-250 min-w-44 before:sm:right-8 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                        <!-- add show class on dropdown open js -->
                        <li class="relative mb-2">
                            <a class="ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 lg:transition-colors" href="javascript:;">
                                <div class="flex py-1">
                                    <div class="my-auto">
                                        <img src="../assets/img/usuario.," class="inline-flex items-center justify-center mr-4 text-white text-sm h-9 w-9 max-w-none rounded-xl" />
                                    </div>



                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                </ul>
            </div>
            </>
        </nav>

        <!-- <div class="relative w-full mx-auto mt-60 ">

            <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words bg-white border-0 dark:bg-slate-850 dark:shadow-dark-xl shadow-3xl rounded-2xl bg-clip-border">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div class="relative inline-flex items-center justify-center text-white transition-all duration-200 ease-in-out text-base h-19 w-19 rounded-xl">
                            <img src="../assets/img/usuario11.png" alt="profile_image" class="w-full shadow-2xl rounded-xl" />
                        </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full">
                            <h5 class="mb-1 dark:text-white"><?php echo isset($dados['nome_usuario']) ? htmlspecialchars($dados['nome_usuario']) : ''; ?></h5>
                            <p class="mb-0 font-semibold leading-normal dark:text-white dark:opacity-60 text-sm"><?php  ?></p>
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 mx-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                    </div>
                </div>
            </div>
        </div> -->
        <div class="w-full p-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                            <div class="flex items-center">
                                <p class="mb-0 dark:text-white/80">Editar Perfil</p>

                            </div>
                        </div>
                        <!-- Formulário de perfil -->
                        <form id="formPerfil" action="atualizar_perfil.php" method="POST">
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="nome_usuario" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Nome:</label>
                                        <input type="text" name="nome_usuario" id="nome_usuario" value="<?php echo isset($dados['nome_usuario']) ? htmlspecialchars($dados['nome_usuario']) : ''; ?>" disabled />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-6/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="email_usuario" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Email:</label>
                                        <input type="email" name="email_usuario" id="email_usuario" value="<?php echo isset($dados['email_usuario']) ? htmlspecialchars($dados['email_usuario']) : ''; ?>" disabled />
                                    </div>
                                </div>
                            </div>
                            <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                            <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">Informações</p>
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                    <div class="mb-4">
                                        <label for="endereco_condutor" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Endereço:</label>
                                        <input type="text" name="endereco_condutor" id="endereco_condutor" value="<?php echo isset($dados['endereco_condutor']) ? htmlspecialchars($dados['endereco_condutor']) : ''; ?>" disabled />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="cidade_condutor" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Cidade:</label>
                                        <input type="text" name="cidade_condutor" id="cidade_condutor" value="<?php echo isset($dados['cidade_condutor']) ? htmlspecialchars($dados['cidade_condutor']) : ''; ?>" disabled />
                                    </div>
                                </div>
                                <div class="w-full max-w-full px-3 shrink-0 md:w-4/12 md:flex-0">
                                    <div class="mb-4">
                                        <label for="pais_condutor" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">País:</label>
                                        <input type="text" name="pais_condutor" id="pais_condutor" value="<?php echo isset($dados['pais_condutor']) ? htmlspecialchars($dados['pais_condutor']) : ''; ?>" disabled />
                                    </div>
                                </div>
                            </div>
                            <hr class="h-px mx-0 my-4 bg-transparent border-0 opacity-25 bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />

                            <p class="leading-normal uppercase dark:text-white dark:opacity-60 text-sm">Sobre</p>
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 shrink-0 md:w-full md:flex-0">
                                    <div class="mb-4">
                                        <label for="sobre_condutor" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80">Sobre mim:</label>
                                        <input type="text" name="sobre_condutor" id="sobre_condutor" value="<?php echo isset($dados['sobre_condutor']) ? htmlspecialchars($dados['sobre_condutor']) : ''; ?>" disabled />
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="editarBtn" onclick="habilitarEdicao()">Editar</button>
                            <button type="submit" id="salvarBtn" style="display:none;">Salvar</button>
                        </form>

                        <script>
                            function habilitarEdicao() {
                                // Habilitar os campos de edição
                                document.getElementById('nome_usuario').disabled = false;
                                document.getElementById('email_usuario').disabled = false;
                                document.getElementById('endereco_condutor').disabled = false;
                                document.getElementById('cidade_condutor').disabled = false;
                                document.getElementById('pais_condutor').disabled = false;
                                document.getElementById('sobre_condutor').disabled = false;

                                // Exibir o botão de salvar
                                document.getElementById('salvarBtn').style.display = 'block';
                                // Ocultar o botão de editar
                                document.getElementById('editarBtn').style.display = 'none';
                            }
                        </script>



                    </div>
                </div>
                <div class="w-full max-w-full px-3 mt-6 shrink-0 md:w-4/12 md:flex-0 md:mt-0">
                    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <img class="w-full rounded-t-2xl" src="../assets/img/fundocinza.png" alt="profile cover image">
                        <div class="flex flex-col items-center justify-center p-4">
    <div class="flex flex-wrap justify-center mb-6">
        <div class="w-32 h-32 flex justify-center items-center border-2 border-white border-solid rounded-full overflow-hidden">
            <a href="javascript:;">
                <img id="profile-image" class="h-full w-full object-cover" src="../assets/img/usuario1.png" alt="profile image">
            </a>
        </div>
    </div>
    
    <!-- <form id="upload-form" enctype="multipart/form-data" action="../CRUD/uploadFoto.php" method="POST" class="flex flex-col items-center mb-4">
        <input type="file" name="profile_image" accept="image/*" onchange="previewImage(event)" required class="mb-2 border border-gray-300 rounded-md p-2">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded transition duration-200 hover:bg-blue-600">Upload</button>
    </form> -->

    <!-- Botão para redirecionar para a página de edição
    <a href="edit-profile.php" class="bg-green-500 text-white py-2 px-4 rounded transition duration-200 hover:bg-green-600">
        Editar Perfil
    </a>
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('profile-image');
    img.src = URL.createObjectURL(event.target.files[0]);
}
</script> -->

<style>
    /* Estilos adicionais para uma aparência mais agradável */
    body {
        background-color: #f8f9fa; /* Cor de fundo suave */
        font-family: Arial, sans-serif;
    }

    .border-2 {
        border-width: 2px;
    }

    .rounded-full {
        border-radius: 9999px; /* Arredondar completamente */
    }

    input[type="file"] {
        cursor: pointer;
    }

    button {
        cursor: pointer;
    }

    .transition {
        transition: background-color 0.3s ease;
    }
</style>

                        <div class="border-black/12.5 rounded-t-2xl p-6 text-center pt-0 pb-6 lg:pt-2 lg:pb-4">
                            <div class="flex justify-between">

                                <button type="button" class="block px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-cyan-500 lg:hidden tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                    <i class="ni ni-collection text-2.8"></i>
                                </button>

                                <button type="button" class="block px-8 py-2 font-bold leading-normal text-center text-white align-middle transition-all ease-in border-0 rounded-lg shadow-md cursor-pointer text-xs bg-slate-700 lg:hidden tracking-tight-rem hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                    <i class="ni ni-email-83 text-2.8"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex-auto p-6 pt-0">
                            <div class="flex flex-wrap -mx-3">
                                <div class="w-full max-w-full px-3 flex-1-0">
                                    <div class="flex justify-center">
                                        <div class="grid text-center">
                                            <span class="font-bold dark:text-white text-lg"><?php echo $total_alunos ?></span>
                                            <span class="leading-normal dark:text-white text-sm opacity-80">Alunos </span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 text-center">
                                <h5 class="dark:text-white ">
                                <?php echo isset($dados['nome_usuario']) ? htmlspecialchars($dados['nome_usuario']) : ''; ?>
                                </h5>
                                <div class="mb-2 font-semibold leading-relaxed text-base dark:text-white/80 text-slate-700">
                                    <i class="mr-2 dark:text-white ni ni-pin-3"></i>
                                    <?php
// Exibe a cidade e o país, separados por uma vírgula, se ambos estiverem definidos
echo isset($dados['cidade_condutor']) ? htmlspecialchars($dados['cidade_condutor']) : '';
echo isset($dados['cidade_condutor']) && isset($dados['pais_condutor']) ? ', ' : '';
echo isset($dados['pais_condutor']) ? htmlspecialchars($dados['pais_condutor']) : '';
?>
</div>
                                <div class="mt-6 mb-2 font-semibold leading-relaxed text-base dark:text-white/80 text-slate-700">
                                    <i class="mr-2 dark:text-white ni ni-briefcase-24"></i>
                                    <?php echo $_SESSION['dados']['nivel'] ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div fixed-plugin>
                <a fixed-plugin-button class="fixed px-4 py-2 bg-white shadow-lg cursor-pointer bottom-8 right-8 text-xl z-990 rounded-circle text-slate-700">
                    <i class="py-2 pointer-events-none fa fa-cog"> </i>
                </a>
                <!-- -right-90 in loc de 0-->
                <div fixed-plugin-card class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
                    <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                        <div class="float-left">
                            <h5 class="mt-4 mb-0 dark:text-white">Argon Configurator</h5>
                            <p class="dark:text-white dark:opacity-80">See our dashboard options.</p>
                        </div>
                        <div class="float-right mt-6">
                            <button fixed-plugin-close-button class="inline-block p-0 mb-4 font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px text-sm tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <!-- End Toggle Button -->
                    </div>
                    <hr class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
                    <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">
                        <!-- Sidebar Backgrounds -->
                        <div>
                            <h6 class="mb-0 dark:text-white">Sidebar Colors</h6>
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
                            <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
                            <p class="leading-normal dark:text-white dark:opacity-80 text-sm">Choose between 2 different sidenav types.</p>
                        </div>
                        <div class="flex">
                            <button transparent-style-btn class="inline-block w-full px-4 py-2.5 mb-2 font-bold leading-normal text-center text-white capitalize align-middle transition-all bg-blue-500 border border-transparent border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-500 to-violet-500 hover:border-blue-500" data-class="bg-transparent" active-style>White</button>
                            <button white-style-btn class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500" data-class="bg-white">Dark</button>
                        </div>
                        <p class="block mt-2 leading-normal dark:text-white dark:opacity-80 text-sm xl:hidden">You can change the sidenav type just on desktop view.</p>
                        <!-- Navbar Fixed -->
                        <div class="flex my-4">
                            <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
                            <div class="block pl-0 ml-auto min-h-6">
                                <input navbarFixed class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
                            </div>
                        </div>
                        <hr class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
                        <div class="flex mt-2 mb-12">
                            <h6 class="mb-0 dark:text-white">Light / Dark</h6>
                            <div class="block pl-0 ml-auto min-h-6">
                                <input dark-toggle class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
                            </div>
                        </div>
                        <a target="_blank" class="dark:border dark:border-solid dark:border-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent border border-solid border-transparent rounded-lg cursor-pointer text-sm ease-in hover:shadow-xs hover:-translate-y-px active:opacity-85 tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850" href="https://www.creative-tim.com/product/argon-dashboard-tailwind">Free Download</a>
                        <a target="_blank" class="dark:border dark:border-solid dark:border-white dark:text-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-xs hover:-translate-y-px active:opacity-85 text-sm ease-in tracking-tight-rem bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none" href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/">View documentation</a>
                        <div class="w-full text-center">
                            <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard-tailwind" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                            <h6 class="mt-4 dark:text-white">Thank you for sharing!</h6>
                            <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard-tailwind" class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-xs hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-twitter"></i> Tweet </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard-tailwind" class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-xs hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-facebook-square"></i> Share </a>
                        </div>
                    </div>
                </div>
            </div>
</body>
<!-- plugin for scrollbar  -->
<script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>