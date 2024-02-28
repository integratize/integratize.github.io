<?php
    /*define('LANGUAGE', 'pt-BR');
    define('MIN_FILE', './cache/' . LANGUAGE . '.php'); // Minified file
    if (file_exists(MIN_FILE)) {
        return require_once MIN_FILE;
    }*/
    define('DATA', get_translation());
    define('URL', 'https://www.integratize.com.br');
    define('EMAIL', 'email@integratize.com.br');
    function get_translation() {
        if (LANGUAGE !== 'en') {
            $ln_en = json_decode(file_get_contents('https://integratize.github.io/translations/en.json'), true);
            $ln_xx = json_decode(file_get_contents('https://integratize.github.io/translations/'. LANGUAGE . '.json'), true);
            return array_combine($ln_en, $ln_xx);
        }
        return null;
    }
    function translate($text) {
        return isset(DATA[$text]) ? DATA[$text] : $text;
    }
    function remove_accents($text) {
        $normalized = Normalizer::normalize($text, Normalizer::NFD);
        return preg_replace('/[\x{0300}-\x{036F}]/u', '', $normalized);
    }
    function sanitize_output($buffer) {
        $search = array(
            '/\>[^\S]+/s',      // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $buffer = preg_replace($search, array('>', '<', '\\1', ''), $buffer);
        file_put_contents(MIN_FILE, $buffer);
        return $buffer;
    }
    ob_start("sanitize_output");
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta name="revisit-after" content="7 days">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="url" content="<?= URL ?>">
    <meta name="title" content="Integratize">
    <meta name="subtitle" content="<?= translate('JavaScript library for application integration') ?>">
    <meta name="description" content="<?= translate('') ?>">
    <meta name="keywords" content="<?= translate('') ?>">
    <meta name="rating" content="General">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="directory" content="submission">
    <meta name="robots" content="index,follow">
    <meta name="classification" content="Business">
    <meta name="language" content="<?= LANGUAGE ?>">
    <meta name="email" content="<?= EMAIL ?>">
    <meta name="author" content="Leandro Sciola">
    <meta name="copyright" content="Integratize">
    <meta name="theme-color" content="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="https://integratize.github.io/images/favicon/ms-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://integratize.github.io/images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://integratize.github.io/images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://integratize.github.io/images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://integratize.github.io/images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://integratize.github.io/images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://integratize.github.io/images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://integratize.github.io/images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://integratize.github.io/images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://integratize.github.io/images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="https://integratize.github.io/images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://integratize.github.io/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://integratize.github.io/images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://integratize.github.io/images/favicon/favicon-16x16.png">
    <link rel="icon" href="https://integratize.github.io/images/favicon/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="https://integratize.github.io/images/favicon/favicon.ico">
    <link rel="manifest" href="https://integratize.github.io/images/favicon/manifest.json">
    <title>Integratize | <?= translate('JavaScript library for application integration') ?></title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/themes/prism.min.css">
    <link rel="stylesheet" type="text/css" href="https://integratize.github.io/styles/all.min.css">
  </head>
  <body class="overflow-x font-regular">
    <header>
      <nav class="navbar navbar-effect navbar-expand-lg navbar-dark bg-dark fixed-top shadow" aria-label="Menu">
        <div class="container-fluid">
          <a class="navbar-brand m-2" href="/">
            <img class="img-fluid light-brand" src="https://integratize.github.io/images/brands/light_brand.png" alt="Integratize" title="Integratize">
            <img class="img-fluid dark-brand d-none" src="https://integratize.github.io/images/brands/dark_brand.png" alt="Integratize" title="Integratize">
          </a>
          <button class="navbar-toggler custom-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-end w-100 me-auto mb-2 mb-lg-0" id="account_menu">
              <li class="nav-item me-md-4">
                <a class="nav-link" href="/#<?= remove_accents(strtolower(translate('Price'))) ?>">
                  <i class="fa fa-circle-dollar-to-slot me-2" aria-hidden="true"></i><?= translate('Price') ?>
                </a>
              </li>
              <li class="nav-item me-md-4">
                <a class="nav-link" href="https://integratize.github.io">
                  <i class="fa fa-book me-2" aria-hidden="true"></i><?= translate('Documentation') ?>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle me-2" href="#" data-bs-toggle="dropdown" aria-expanded="false" title="<%= translate('Language') %>" id="language">
                  <i class="fa fa-globe me-2" aria-hidden="true"></i><?= LANGUAGE ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="language">
                  <% language_list.forEach(function(code) { %>
                  <li>
                    <a class="dropdown-item dropdown-language" href="#">
                      <%= code %>
                    </a>
                  </li>
                  <% }) %>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main class="<%- style.main %>" role="main" id="main">
      <span id="box"></span>
      <!-- START: Banner -->
      <div class="container-fluid bg-blockchain fade-in min-vh-100 mb-5 p-0">
        <div class="row flex-column-reverse flex-lg-row align-items-center">
          <div class="col-12 col-lg-6">
            <div class="text-center py-5" data-scroll="enter left move 30px over 0.6s after 0.4s">
              <h1 class="text-uppercase text-warning font-bold fs-2 mx-4">
                <?php $text = translate('Application integration');
                echo str_ireplace($text, "<br><span class=\"text-master\">$text</span>", translate('JavaScript library for application integration')) ?>
              </h1>
              <h2 class="text-start text-tertiary fs-5 mx-5 my-3">
                <?= translate('Integratize is a JavaScript library that allows you to integrate applications with a few lines of code, in addition to offering features to create automations in a simple and precise way.') ?>
              </h2>
              <a class="btn btn-primary bg-gradient text-white rounded-pill pulse scroll-to-section fs-6 mt-3 px-5 py-3" href="/#demo">
                <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>Demo
              </a>
            </div>
          </div>
          <div class="col text-end">
            <img class="img-fluid" src="https://integratize.github.io/images/banners/top_right.png" alt="<%= translate('Application integration') %>" data-scroll="enter right move 30px over 1.2s after 0.8s">
          </div>
        </div>
      </div>
      <!-- END: Banner -->
      <!-- START: Features -->
      <div class="container d-flex min-vh-100">
        <div class="row justify-content-center align-self-center">
          <!-- START: Feature 1 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 m-0 p-0" data-scroll="enter left move 30px over 0.6s after 0.4s">
            <div class="card text-center border-0 m-0 p-4">
              <i class="fa-solid fa-chart-line fa-5x text-tertiary mb-4"></i>
              <div class="card-body">
                <h4 class="card-title">Trend Analysis</h4>
                <p class="card-text text-secondary my-4">Curabitur pulvinar vel amor sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              </div>
            </div>
          </div>
          <!-- END: Feature 1 -->
          <!-- START: Feature 2 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 m-0 p-0" data-scroll="enter bottom move 30px over 0.6s after 0.4s">
            <div class="card text-center border-0 m-0 p-4">
              <i class="fa-solid fa-laptop fa-5x text-tertiary mb-4"></i>
              <div class="card-body">
                <h4 class="card-title">Digital marketing</h4>
                <p class="card-text text-secondary my-4">Curabitur pulvinar vel amor sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              </div>
            </div>
          </div>
          <!-- END: Feature 2 -->
          <!-- START: Feature 3 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 m-0 p-0" data-scroll="enter right move 30px over 0.6s after 0.4s">
            <div class="card text-center border-0 m-0 p-4">
              <i class="fa-solid fa-lightbulb fa-5x text-tertiary mb-4"></i>
              <div class="card-body">
                <h4 class="card-title">Creativity</h4>
                <p class="card-text text-secondary my-4">Curabitur pulvinar vel amor sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              </div>
            </div>
          </div>
          <!-- END: Feature 3 -->
          <!-- START: Feature 4 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 m-0 p-0" data-scroll="enter left move 30px over 0.6s after 0.4s">
            <div class="card text-center border-0 m-0 p-4">
              <i class="fa-solid fa-chart-line fa-5x text-tertiary mb-4"></i>
              <div class="card-body">
                <h4 class="card-title">Trend Analysis</h4>
                <p class="card-text text-secondary my-4">Curabitur pulvinar vel amor sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              </div>
            </div>
          </div>
          <!-- END: Feature 4 -->
          <!-- START: Feature 5 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 m-0 p-0" data-scroll="enter bottom move 30px over 0.6s after 0.4s">
            <div class="card text-center border-0 m-0 p-4">
              <i class="fa-solid fa-laptop fa-5x text-tertiary mb-4"></i>
              <div class="card-body">
                <h4 class="card-title">Digital marketing</h4>
                <p class="card-text text-secondary my-4">Curabitur pulvinar vel amor sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              </div>
            </div>
          </div>
          <!-- END: Feature 5 -->
          <!-- START: Feature 6 -->
          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 m-0 p-0" data-scroll="enter right move 30px over 0.6s after 0.4s">
            <div class="card text-center border-0 m-0 p-4">
              <i class="fa-solid fa-lightbulb fa-5x text-tertiary mb-4"></i>
              <div class="card-body">
                <h4 class="card-title">Creativity</h4>
                <p class="card-text text-secondary my-4">Curabitur pulvinar vel amor sed sagittis. Nam maximus ex diam, nec consectetur diam.</p>
              </div>
            </div>
          </div>
          <!-- END: Feature 6 -->
        </div>
      </div>
      <!-- END: Features -->
      <!-- START: Demo -->
      <div class="container-fluid bg-medium" id="demo">
        <div class="row">
          <div class="col-lg-5 col-md-12 col-sm-12 bg-gradient-1 d-inline-flex min-vh-100" data-scroll="enter left move 30px over 0.6s after 0.4s">
            <div class="text-center align-self-center">
              <h3 class="text-white text-start my-4">
                Demo
              </h3>
              <pre class="rounded"><code class="language-javascript">function foo() {}</code></pre>
            </div>
          </div>
          <div class="offset-lg-1 col-lg-6 col-md-12 col-sm-12 z-1 align-self-center">
            <ul class="mx-4 my-5 p-0">
              <!-- START: Feature 1 -->
              <li class="inline-block mb-5" data-scroll="enter right move 30px over 0.6s after 0.4s">
                <span class="bg-gradient-1 float-start text-white text-center rounded fs-1 me-3">
                  <i class="fa-solid fa-arrow-right align-middle p-3"></i>
                </span>
                <h4 class="text-master">Vestibulum pulvinar rhoncus</h4>
                <p class="w-xl-75">
                  Phasellus in imperdiet felis, eget vestibulum nulla. Aliquam nec dui nec augue maximus porta. Duis viverra, ipsum et scelerisque placerat et eget.
                </p>
              </li>
              <!-- END: Feature 1 -->
              <!-- START: Feature 2 -->
              <li class="inline-block mb-5" data-scroll="enter right move 30px over 0.6s after 0.5s">
                <span class="bg-gradient-1 float-start text-white text-center rounded fs-1 me-3">
                  <i class="fa-solid fa-arrow-right align-middle p-3"></i>
                </span>
                <h4 class="text-master">Sed blandit quam in velit</h4>
                <p class="w-xl-75">
                  Ipsum et scelerisque placerat from our website. Duis viverra, ipsum et scelerisque placerat, orci magna consequat ligula.
                </p>
              </li>
              <!-- END: Feature 2 -->
              <!-- START: Feature 3 -->
              <li class="inline-block mb-5" data-scroll="enter right move 30px over 0.6s after 0.5s">
                <span class="bg-gradient-1 float-start text-white text-center rounded fs-1 me-3">
                  <i class="fa-solid fa-arrow-right align-middle p-3"></i>
                </span>
                <h4 class="text-master">Sed blandit quam in velit</h4>
                <p class="w-xl-75">
                  Ipsum et scelerisque placerat from our website. Duis viverra, ipsum et scelerisque placerat, orci magna consequat ligula.
                </p>
              </li>
              <!-- END: Feature 3 -->
              <!-- START: Feature 4 -->
              <li class="inline-block" data-scroll="enter right move 30px over 0.6s after 0.6s">
                <span class="bg-gradient-1 float-start text-white text-center rounded fs-1 me-3">
                  <i class="fa-solid fa-arrow-right align-middle p-3"></i>
                </span>
                <h4 class="text-master">Aenean faucibus venenatis</h4>
                <p class="w-xl-75">
                  Phasellus in imperdiet felis, eget vestibulum nulla. Aliquam nec dui nec augue maximus porta. Curabitur tristique lacus.
                </p>
              </li>
              <!-- END: Feature 4 -->
            </ul>
          </div>
        </div>
      </div>
      <!-- END: Demo -->
      <!-- START: FAQ -->
      <div class="container">
        <div class="row">
          <div class="col mb-4">
            <div class="accordion pb-4" id="faq">
              <h4 class="text-center text-master font-bold my-5">
                <?= strtoupper(translate('Answering questions')) ?>
              </h4>
              <!-- START: Question 01 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_01">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_01" aria-controls="answer_01" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i><%= translate('Why buy the pack?') %>
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_01" id="answer_01">
                  <div class="accordion-body">
                    <%= translate('By purchasing the pack, you will save time and work in your processes, as the script takes care of carrying out the work automatically. This automation allows you to focus on other activities important to your business, while the script performs tasks efficiently and accurately.') %>
                  </div>
                </div>
              </div>
              <!-- END: Question 01 -->
              <!-- START: Question 02 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_02">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_02" aria-controls="answer_02" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i><%= translate('Will I have technical support?') %>
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_02" id="answer_02">
                  <div class="accordion-body">
                    <%= translate('Yes. If you have any questions about installing and using the scripts, simply contact us through the customer service channels and the response will be sent to the email you provided at the time of purchase. Feel free to contact us!') %>
                  </div>
                </div>
              </div>
              <!-- END: Question 02 -->
              <!-- START: Question 03 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_03">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_03" aria-controls="answer_03" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i><%= translate('Will I have a guarantee?') %>
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_03" id="answer_03">
                  <div class="accordion-body">
                    <%= translate('Yes. You have 7 days to request a refund through the platform where you made the purchase, in accordance with the applicable refund policies. If you have any questions or need more information, please contact us through the service channels. We are available to help!') %>
                  </div>
                </div>
              </div>
              <!-- END: Question 03 -->
              <!-- START: Question 04 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_04">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_04" aria-controls="answer_04" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>Posso revender o pack?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_04" id="answer_04">
                  <div class="accordion-body">
                    Por se tratar de um produto comercial, não permitimos sua revenda total ou parcial. Caso você tenha interesse em comercializar o pack, obtenha mais informações sobre nossos programas de afiliados nas plataformas parceiras.
                  </div>
                </div>
              </div>
              <!-- END: Question 04 -->
              <!-- START: Question 05 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_05">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_05" aria-controls="answer_05" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>Qual linguagem de programação é utilizada no pack?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_05" id="answer_05">
                  <div class="accordion-body">
                    JavaScript, seguindo o paradigma de programação orientada a objetos. Essa linguagem é bastante popular e amplamente empregada na plataforma do Google Sheets.
                  </div>
                </div>
              </div>
              <!-- END: Question 05 -->
              <!-- START: Question 06 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_06">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_06" aria-controls="answer_06" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>É necessário saber programar para instalar os scrits?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_06" id="answer_06">
                  <div class="accordion-body">
                    É bom ter pelo menos uma noção básica em JavaScript para poder fazer os ajustes conforme suas necessidades.
                  </div>
                </div>
              </div>
              <!-- END: Question 06 -->
              <!-- START: Question 07 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_07">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_07" aria-controls="answer_07" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>Como vou instalar os scripts?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_07" id="answer_07">
                  <div class="accordion-body">
                    O pack inclui um guia extremamente didático para facilitar a instalação dos scripts, tornando o processo simples e descomplicado. Caso surjam dúvidas, entre em contato conosco.
                  </div>
                </div>
              </div>
              <!-- END: Question 07 -->
              <!-- START: Question 08 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_08">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_08" aria-controls="answer_08" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>É seguro?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_08" id="answer_08">
                  <div class="accordion-body">
                    Sim. Os scripts são executados exclusivamente no ambiente do Google Apps Script, obedecendo às regras de autenticação e permissões de acesso previamente configuradas por você.
                  </div>
                </div>
              </div>
              <!-- END: Question 08 -->
              <!-- START: Question 09 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_09">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_09" aria-controls="answer_09" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>Como vou implantar os scripts?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_09" id="answer_09">
                  <div class="accordion-body">
                    O pack possui um guia muito didático para você implementar os scripts de forma simples e descomplicada.
                  </div>
                </div>
              </div>
              <!-- END: Question 09 -->
              <!-- START: Question 10 -->
              <div class="accordion-item shadow p-2">
                <h2 class="accordion-header font-bold" id="question_10">
                  <button class="accordion-button collapsed bg-light text-master" type="button" data-bs-toggle="collapse" data-bs-target="#answer_10" aria-controls="answer_10" aria-expanded="false">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>Como vou implantar os scripts?
                  </button>
                </h2>
                <div class="accordion-collapse collapse" data-bs-parent="#faq" aria-labelledby="question_10" id="answer_10">
                  <div class="accordion-body">
                    O pack possui um guia muito didático para você implementar os scripts de forma simples e descomplicada.
                  </div>
                </div>
              </div>
              <!-- END: Question 10 -->
            </div>
          </div>
        </div>
      </div>
      <!-- END: FAQ -->
    </main>
    <footer class="bg-footer bg-center-top bg-no-repeat bg-cover min-vh-100" data-scroll="enter bottom move 30px over 0.6s after 0.1s">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6">
            <!-- START: Purchase -->
            <div class="text-center rounded bg-medium shadow p-4" data-scroll="enter bottom move 30px over 0.6s after 0.4s" id="<?= remove_accents(strtolower(translate('Price'))) ?>">
              <img class="img-fluid" src="https://integratize.github.io/images/icons/<?= translate('guarantee_seal') ?>_150x150.png" alt="<?= translate('7 day guarantee') ?>">
              <h3 class="bg-white font-bold text-master text-center rounded fs-1 mt-4">
                <?= (LANGUAGE === 'pt-BR') ? '<span class="fs-4 me-1">R$</span>97,90' : '<span class="fs-4 me-1">$</span>20' ?>
              </h3>
              <a class="btn btn-primary bg-gradient shadow w-100 p-3" href="/">
                <i class="fa fa-shopping-cart fa-sm me-2" aria-hidden="true"></i><?= translate('Buy license') ?>
              </a>
              <p class="text-center mt-4">
                <?= translate('After payment confirmation, we will send the file to your email.') ?>
              </p>
            </div>
            <!-- END: Purchase -->
          </div>
          <div class="col text-white my-5">
            <!-- START: Text -->
            <h3 class="font-bold my-4"><?= translate('License') ?></h3>
            <p class="text-start">
              <?= translate('Integratize is a platform specialized in integration and automation of digital processes, which offers strategic solutions for companies that want to optimize workflows and increase productivity.') ?>
            </p>
            <p class="text-start">
              <?= translate('Sign up for free and discover how our platform can help your company reach the next level of competitiveness.') ?>
            </p>
            <!-- END: Text -->
            <!-- START: Social media -->
            <ul class="list-group list-group-horizontal list-unstyled">
              <li><a href="https://www.facebook.com/integratize" title="Facebook"><i class="fa-brands fa-facebook text-white link-warning smooth fs-2 p-2"></i></a></li>
              <li><a href="https://www.instagram.com/integratize" title="Instagram"><i class="fa-brands fa-instagram text-white link-warning smooth fs-2 p-2"></i></a></li>
              <li><a href="https://www.youtube.com/@integratize" title="YouTube"><i class="fa-brands fa-youtube text-white link-warning smooth fs-2 p-2"></i></a></li>
              <li><a href="https://www.tiktok.com/@integratize" title="TikTok"><i class="fa-brands fa-tiktok text-white link-warning smooth fs-2 p-2"></i></a></li>
              <li><a href="https://twitter.com/integratize_" title="Twitter"><i class="fa-brands fa-x-twitter text-white link-warning smooth fs-2 p-2"></i></a></li>
              <li><a href="https://github.com/integratize" title="GitHub"><i class="fa-brands fa-github text-white link-warning smooth fs-2 p-2"></i></a></li>
              <li><a href="https://www.npmjs.com/org/integratize" title="NPM"><i class="fa-brands fa-npm text-white link-warning smooth fs-2 p-2"></i></a></li>
            </ul>
            <!-- END: Social media -->
            <div class="mt-2">
              <a class="link-light text-decoration-none" href="mailto: <?= EMAIL ?>" title="E-mail"><?= EMAIL ?></a>
            </div>
          </div>
        </div>
      </div>
      <!-- START: Copyright -->
      <div class="container">
        <div class="row">
          <div class="col">
            <hr class="text-white my-5">
            <p class="text-center text-white small my-5">Copyright &copy; <?= date('Y') ?> Integratize</p>
          </div>
        </div>
      </div>
      <!-- END: Copyright -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/9000.0.1/prism.min.js"></script>
      <script src="https://integratize.github.io/scripts/all.min.js"></script>
      <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function (e) {
          const $JScript = new JScript();
          $JScript.init();
          window.ChatraSetup = {
            customWidgetButton: ".custom-chat-button",
            language: document.documentElement.lang
          };
      });
      </script>
      <!-- Chatra {literal} -->
      <script type="text/javascript">
      (function(d, w, c) {
          w.ChatraIntegration = {
            notes: "Visitor"
          };
          /*w.ChatraSetup = {
            colors: {
              buttonText: "#f0f0f0",
              buttonBg: "#137629"
            },
            language: document.documentElement.lang
          };*/
          w.ChatraID = "PT2EYarTtF4EpYykK";
          var s = d.createElement("script");
          w[c]  = w[c] || function() {
              (w[c].q = w[c].q || []).push(arguments);
          };
          s.async = true;
          s.src   = "https://call.chatra.io/chatra.js";
          if (d.head) d.head.appendChild(s);
      })(document, window, "Chatra");
      </script>
      <!-- /Chatra {/literal} -->
      <button class="btn custom-chat-button position-fixed bottom-0 end-0 z-3 rounded border border-2 m-4 p-0" title="Chat">
        <i class="fas fa-comment-dots fa-3x text-white bg-gradient-1 rounded p-3"></i>
      </button>
    </footer>
  </body>
</html>
