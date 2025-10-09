<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../logo_ADG-bg-black-favicon.png">
    <link rel="preload" fetchpriority="high" as="image" href="../img/backgroundImages/backgroundimage1.webp">
    <link rel="canonical" href="https://adgsolucoesindustriais.com.br/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Peças, consumíveis e manutenção para máquinas de corte a laser. Otimize seus processos industriais, aumente a produtividade e reduza custos com a ADG. Contato imediato!">
    <meta property="og:title" content="ADG Soluções Industriais | Peças e manutenção para corte a laser">
    <meta property="og:description"
        content="Peças, consumíveis e manutenção para corte a laser. Otimize seus processos industriais, aumente a produtividade e reduza custos com a ADG. Contato imediato!">
    <meta property="og:image" content="https://adgsolucoesindustriais.com.br/img/logo_ADG-bg-black-og-1000x1000.png">
    <meta property="og:url" content="https://adgsolucoesindustriais.com.br/">
    <meta property="og:type" content="website">
    <title>ADG Soluções Industriais | Peças e manutenção corte a laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/commonClasses.css">
</head>

<body>

    <!-- Header Navbar -->
    <header class="header-position bg-black z-3 top-0">
        <div class="">

        </div>
        <nav class="navbar container-header d-flex align-items-center py-1 px-3">
            <div class="me-auto">
                <picture>
                    <source media="(max-width: 992px)" srcset="../img/logo_ADG-no-bg-200x100.png" width="150" height="75">
                    <source media="(min-width: 992px)" srcset="../img/logo_ADG-no-bg-200x100.png" width="200" height="100">
                    <img src="../img/logo_ADG-no-bg-200x100.png" alt="logo da empresa ADG" width="200" height="100">
                </picture>
            </div>
            <ul class="m-0 p-0 d-none d-md-inline-flex gap-4 list-unstyled">
                <li>
                    <a class="nav_link fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para o início" href="#">
                        Início
                    </a>
                </li>
                <li>
                    <a class="nav_link fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para a seção serviços" href="#servicos">
                        Serviços
                    </a>
                </li>
                <li id="dropmenu">
                    <a class="nav_link fw-bold fs-5 text-decoration-none c-red d-inline-flex align-items-center gap-2 text-uppercase"
                        aria-label="Botão que leva para a seção serviços" href="#produtos">
                        Produtos
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down-fill caret-icon-desktop" viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </a>
                    <ul id="menu-items"
                        class="menu-items m-0 p-0 list-unstyled position-absolute w-30pc rounded-bottom bg-black text-nowrap">
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#ceramicas">
                                Cerâmicas
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase" href="#bicosdecorte">
                                Bicos
                                de Corte
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#lentesprotetores">
                                Lentes / Protetores
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#filtros">
                                Filtros
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#limpeza">
                                Limpeza
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#pecasecabecote">
                                Peças
                                e Cabeçotes
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#sensores">
                                Sensores
                            </a>
                        </li>
                        <li class="py-3 px-4">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#diversos">
                                Diversos
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav_link fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para a seção sobre nós" href="#sobre">
                        Sobre
                    </a>
                </li>
                <li>
                    <a class="nav_link fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para a seção contato" href="pages/contato.php">
                        Contato
                    </a>
                </li>
            </ul>

            <button id="btn_menu" class="bg-transparent border-0 d-md-none" aria-label="Botão que abre ou fecha menu">
                <span class="linha_btn d-block d-lg-none"></span>
                <span class="linha_btn d-block d-lg-none"></span>
                <span class="linha_btn d-block d-lg-none"></span>
            </button>
        </nav>

    </header>


    <!-- Mobile Menu -->
    <div id="mobile_menu"
        class="d-md-none position-fixed overflow-auto vh-100 py-5 rounded-bottom mobile_menu_view bg-black top-0 z-3">
        <nav>
            <ul class="m-0 p-0 d-flex flex-column list-unstyled gap-4 px-3">
                <li>
                    <a class="fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para o início" href="#">
                        Início
                    </a>
                </li>
                <li>
                    <a class="fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para a seção serviços" href="#servicos">
                        Serviços
                    </a>
                </li>
                <li id="dropmenu-mobile">
                    <button
                        class="fw-bold p-0 fs-5 text-decoration-none border-0 bg-transparent c-red d-inline-flex align-items-center gap-2 text-uppercase"
                        aria-label="Botão que leva para a seção serviços">
                        Produtos
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down-fill caret-icon-mobile" viewBox="0 0 16 16">
                            <path
                                d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </button>
                    <ul id="menu-items-mobile" class="menu-items-mobile m-0 list-unstyled position-inherit bg-grey">
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#ceramicas">
                                Cerâmicas
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase" href="#bicosdecorte">Bicos
                                de Corte
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#lentesprotetores">
                                Lentes / Protetores
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#filtros">
                                Filtros
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#limpeza">
                                Limpeza
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#pecasecabecote">
                                Peças
                                e Cabeçotes
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#sensores">
                                Sensores
                            </a>
                        </li>
                        <li class="p-3">
                            <a class="fw-bold fs-6 text-decoration-none c-red text-uppercase"
                                href="#diversos">
                                Diversos
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para a seção sobre nós" href="#sobre">
                        Sobre
                    </a>
                </li>
                <li>
                    <a class="fw-bold fs-5 text-decoration-none c-red text-uppercase"
                        aria-label="Botão que leva para a seção contato" href="pages/contato">
                        Contato
                    </a>
                </li>
            </ul>
        </nav>
    </div>