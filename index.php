
<?php
include './CRUD/conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>VANN</title>
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/main.css">
</head>f

<body>
    <div class="container">
        <header>
            <nav class="header__nav w-120">
                <div class="header__logo">
                    <img src="assets/img/opportunites/LOGO.png" alt="Logo">
                </div>
                <div class="header__nav__content">
                    <div class="nav-close-icon"></div>
                    <ul class="header__menu">
                       
                    </ul>
                    <div class="header__signup">
                        <a href="./login.php" class="btn btn__signup">
                            <i class="fas fa-user-plus"></i> Entrar
                        </a>
                    </div>
                </div>

                <div class="hamburger-menu-wrap">
                    <div class="hamburger-menu">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
            </nav>
        </header>

        <section class="hero w-120">
            <div class="hero__content">
                <div class="hero__text">
                    <h1 class="hero__title">Garantindo a segurança dos alunos</h1>
                    <p class="hero__description">
                        Nós da Vann estamos comprometido em garantiar a segurança de nossos alunos durante todo o trajeto ate o colégio.
                    </p>
                    <div class="buttonCadastrar">
                    <a href="./login.php" class="btn btn__hero">Cadastrar</a>
                    </div>
                </div>
                <div class="hero__img">
                    <img src="assets/img/Design sem nome (1).png" alt="">
                </div>
            </div>
        </section>

        <section class="opportunities">
            <div class="opportunities__img">
                <img src="assets/img/lateral.png" alt="">
            </div>
            <div class="opportunities__content w-105">
                <div class="opportunities__head">
                    <h2 class="opportunities__title">Nosso diferencial</h2>
                    <p class="opportunities__description">Nós da vann oferecemos sistemas inovadores voltado diretamente para o cuidado e segurança de nossos alunos.</p>
                </div>
                <div class="opportunities__body">
                    <div class="opportunity">
                        <img src="assets/img/chat.png" alt="Icon" class="opportunity__icon">
                        <h4 class="opportunity__title"> Atendimento Personalizado</h4>
                        <p class="opportunity__description">Através do nosso sistema de pesquisa oferecemos quais de nossas vans é a mais acessível para o trajeto que seu filho irá percorrer de sua casa até a escola, otimizando o tempo de percurso.

                        </p>
                    </div>

                    <div class="opportunity active">
                        <img src="assets/img/image-removebg-preview (14).png" alt="Icon" class="opportunity__icon">
                        <h4 class="opportunity__title">Segurança em Primeiro lugar</h4>
                        <p class="opportunity__description">
                            A segurança dos estudantes é nossa prioridade absoluta. Com nosso sistema você pode acompanhar o trajeto do seu filho em tempo real até o ponto escolar. 
                        </p>
                    </div>
                    <div class="opportunity">
                        <img src="assets/img/painel.png" alt="Icon" class="opportunity__icon">
                        <h4 class="opportunity__title">Painel de controle
                        </h4>
                        <p class="opportunity__description">
                             Através do nosso painel de controle é possível que o condutor possa gerenciar rotas, alunos a bordo e se comunicar com os responsáveis dos alunos.                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="invest  w-105">
           
                <div class="invest__body">
                    <div class="invest__item">
                        <div class="invest__item__head">
                            <h5 class="invest__item__subtitle">ACESSO PARA</h5>
                        </div>
                        <div class="invest__item__body">
                            <h4 class="invest__item__title">Condutores</h4>
                            <p class="invest__item_description">
                                Cadastre-se como condutor e venha participar de nossa empresa
                            </p>
                        </div>
                        <div class="invest__item__footer">
                            <a href="./login.php" class="btn btn__invest">Saiba mais</a>
                        </div>
                    </div>
                    <div class="invest__item">
                        <div class="invest__item__head">
                            <h5 class="invest__item__subtitle">ACESSO PARA</h5>
                        </div>
                        <div class="invest__item__body">
                            <h4 class="invest__item__title">Usuário
                            </h4>
                            <p class="invest__item_description">
                                Cadastre-se como usuário e garanta um percurso seguro para seu filho.
                            </p>
                        </div>
                        <div class="invest__item__footer">
                            <a href="./login.php" class="btn btn__invest">Saiba mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="how-is-works w-120">
            <div class="works__content">
                <div class="works__head">
                    <h2 class="works__title">Busque pela melhor rota</h2>
                    <p class="works__description">
                        Nosso sistema oferece atendimento personalizado, fazemos uma pesquisa para saber qual de nossos condutores faz o melhor trajeto para que seu filho otimize tempo durante o percurso.
                    </p>
                </div>
                <div class="works__body">
                    <ul class="form_progressbar">
                        <li class="progressbar__step active" data-step="1"></li>
                        <li class="progressbar__step" data-step="2"><img src="assets/img/image-removebg-preview (14).png" alt="Icon" class="opportunity__icon"></li>
                        <li class="progressbar__step" data-step="3"><img src="assets/img/image-removebg-preview (14).png" alt="Icon" class="opportunity__icon"></li>
                        <li class="progressbar__step" data-step="4"><img src="assets/img/image-removebg-preview (14).png" alt="Icon" class="opportunity__icon"></li>
                    </ul>
                </div>
                <div class="works__footer">
                    <div class="works__step__content first_step">
                        <h3 class="works__step_title"> Avalie e veja as avaliações de nossos condutores</h3>
                        <p class="works__step_description">
                            Com a vann você fica por dentro de como os condutores são qualificados, podendo ver o feedback que outros clientes avaliam
                        </p>
                    </div>
                    <div class="works__step__content">
                        <h3 class="works__step_title"> Swallowed a planet!.</h3>
                        <p class="works__step_description">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda mollitia, voluptates obcaecati molestias quod velit!
                        </p>
                    </div>
                    <div class="works__step__content">
                        <h3 class="works__step_title">It's art! A statement</h3>
                        <p class="works__step_description">
                            Father Christmas. Santa Claus. Or as I've always known him: Jeff. Sorry, checking all the water in this area; there's an escaped fish. I hate yogurt. It's just stuff with bits in. Annihilate
                        </p>
                    </div>
                    <div class="works__step__content">
                        <h3 class="works__step_title"> Register</h3>
                        <p class="works__step_description">
                            It's art! A statement on modern society, 'Oh Ain't Modern Society Awful?'! I am the Doctor, and you are the Daleks! Stop talking, brain thinking. Hush. You've swallowed a planet! Sorry, checking all the water in this area; there's an escaped fish.
                        </p>
                    </div>
                </div>
            </div>


        </section>

        <section class="testimonials">
            <div class="testimonials__content">
                <div class="testimonials__head w-105">
                    
                    <h2 class="testimonials__title">Conheça os condutores</h2>
                </div>
                <div class="testimonials__body">
                    <div class="testimonials__list">
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/1.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Fernando</h4>
                                    <h4 class="testimonial__title">condutor</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                               <img src="./assets/img/avaliação.png" class="avaliam">
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/2.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Aline</h4>
                                    <h4 class="testimonial__title">condutora</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                <img src="./assets/img/avaliação.png" class="avaliam">
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/3.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Marceli</h4>
                                    <h4 class="testimonial__title">condutora</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                <img src="./assets/img/avaliação.png" class="avaliam">
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/2.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Ilone Pickford</h4>
                                    <h4 class="testimonial__title">Head of Agrogofund Groups</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                “ Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, “
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/1.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Fernando s </h4>
                                    <h4 class="testimonial__title">condutor</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                “ Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, “
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/2.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Aline</h4>
                                    <h4 class="testimonial__title">condutora</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                “ Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, “
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/3.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Marceli</h4>
                                    <h4 class="testimonial__title">condutora</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                “ At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium “
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/2.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> Ilone Pickford</h4>
                                    <h4 class="testimonial__title">Head of Agrogofund Groups</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                “ Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, “
                            </p>
                        </div>
                        <div class="testimonial">
                            <div class="testimonial__profile">
                                <div class="testimonial__img">
                                    <img src="assets/img/testimonials/3.png" alt="Testimonial">
                                </div>
                                <div class="testimonial__info">
                                    <h4 class="testimonial__name"> John Doe</h4>
                                    <h4 class="testimonial__title">Software Engineer</h4>
                                </div>
                            </div>
                            <p class="testimonial__description">
                                “ At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium “
                            </p>
                        </div>
                    </div>
                </div>
                <div class="testimonials__footer  w-105">
                    
                </div>
            </div>
        </section>

       

        <footer class="footer">
            <div class="footer__body w-105">
               
                <div class="footer__contact">
                    <h5 class="footer__contact__title">Saiba mais</h5>
                    <span>faça seu cadastro</span>
                    <a href="mailto:info@zoufarm.com" class="email">aqui</a>
                    <a href="login.php" class="btn btn__signin">
                        <i class="far fa-user"></i> Cadastrar
                    </a>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__bottom__content w-105">
                    <div class="footer__logo">
                        <img src="assets/img/opportunites/LOGO.png" alt="Logo">
                    </div>
                    <p class="footer_copyright">
                        ©Vann. Todos direitos reservados.
                    </p>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/main.js" type="module"></script>

</body>

</html>