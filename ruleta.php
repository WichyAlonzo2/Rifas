<?php
include 'logica/logica__index.php';
include 'sys.php';
$data = file_get_contents("app/post.json");
$post = json_decode($data);

session_start();
$usuarioingresado = $_SESSION['user'];
$pass = $_SESSION['pass'];
$rol = $_SESSION['rol'];

if (isset($_SESSION['user'])) {
} else {
    header('location: /games');
}
?>

<!DOCTYPE html>
<html lang="es" xml:lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Juego Ruleta - ' . $importanteNombreCorto; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta property="og:title" content="<?php echo $importanteNombreCorto; ?>">
    <meta property="og:image" content="assets/img/portada.png">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="<?php echo $importanteNombreCorto; ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Inicio - <?php echo $importanteNombreCorto; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="179x180" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="191x192" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="icon" type="image/png" sizes="510x512" href="<?php echo $urlPartner ?>assets/img/<?php echo $favicon; ?>?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/root.css?v=<?php echo time(); ?>">
    <meta name="description" content="Rulta - WichyAlonzo">
    <meta name="keywords" content="sorteos, concursos, obtener comentario de Instagram, comentario aleatorio Instagram, sorteo para Facebook, sorteos gratis, aplicación para sorteos en Instagram, sorteos en Instagram gratis, sorteo en facebook gratis, ganador al azar, sorteo al azar">
    <link rel="icon" href="app_ruleta/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="app_ruleta/favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="app_ruleta/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="app_ruleta/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="app_ruleta/favicon-16x16.png">
    <meta name="google-site-verification" content="anRG_D8WAq_EemBNsdLEx2FT-RSmW7IJUzOt8QNWYM4">
    <meta name="msvalidate.01" content="D2347BCC2A4799B81EEDFC25EB9A2AE1">
    <link rel="stylesheet" href="app_ruleta/css/all.front.compiled.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="app_ruleta/css/wheel.css?v=<?php echo time(); ?>">
    <script src="app_ruleta/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js?v=<?php echo time(); ?>" data-cf-settings="3eab436ace7728c68e812583-|49"></script>
    <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="app_ruleta/css-1?family=Inter:400,500,700,900&display=swap">
    <script src="app_ruleta/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js?v=<?php echo time(); ?>" data-cf-settings="3eab436ace7728c68e812583-|49"></script>
    <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" href="app_ruleta/font/fa-pro-5/css/all.min.css?1629896048">
</head>

<body>
    <nav class="navbar-expand-md fixed-top navbar-shrink py-3 navbar-light nav_style themeDarkNav" id="mainNav" style="background:#3560eb;box-shadow: 0px 5px 7px 5px rgba(0, 0, 0, 0.2);">
        <div class="navbr_menu">
            <div>
                <div class="container d-flex align-items-center justify-content-between text-center fw-bold">
                    <a href="<?php echo $linkPPago; ?>" class="navbar-toggler text-white fs-6" style="border: none;">Métodos de Pago</a>
                    <a class="navbar-brand d-flex align-items-center" href="">
                        <img src="assets/img/<?php echo $logo; ?>" class="img-menu__nav mx-2">
                    </a>
                    <a href="<?php echo $linkPSorteo; ?>" class="navbar-toggler text-white fs-6" style="border: none;">Comprar Boletos</a>
                </div>

            </div>
            <div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="/">Inicio</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPSorteo; ?>">Comprar Boletos</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPPago; ?>">Métodos de Pago</a></li>
                        <li class="nav-item fw-bold fs-5"><a class="nav-link active text-white fs_action" href="<?php echo $linkPCheck; ?>">Verificador</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="main">
        <div id="js-overlay-menu" class="overlay-mobile" onclick="if (!window.__cfRLUnblockHandlers) return false; Helpers.toggleSidebar();" style="display: none;" data-cf-modified-3eab436ace7728c68e812583-=""></div>
        <div class="app-hero">
            <div class="app-hero__content" style="padding-bottom: 400px;">
                <div class="container">
                    <div class="text-center">
                        <h1 class="app-hero__title">La Ruleta loca</h1>
                        <p class="app-hero__desc mb-0">¡Gira la ruleta y obten tus ganadores al azar!</p>
                    </div>
                </div>
            </div>
            <img class="app-hero__curve" src="app_ruleta/img/landings/curve.svg">
        </div>
        <div id="wof" v-cloak="">
            <div class="app-hero" v-if="savedWheel.id">
                <div class="app-hero__content" style="padding-bottom: 400px;">
                    <div class="container">
                        <div class="mb-4">
                            <h1 class="app-hero__title">{{ savedWheel.title }}</h1>
                            <div class="app-hero__stats mb-0">
                                <div class="app-hero__stats-items">
                                    <span class="app-hero__stats-item"><i class="far fa-chart-bar"></i> {{ savedWheel.hits }} <b class="_fw500">{{ $t('app_wheel.label_stats_hits') }}</b></span>
                                    <span class="app-hero__stats-item"><i class="far fa-sync"></i> {{ savedWheel.spins }} <b class="_fw500">{{ $t('app_wheel.label_stats_spins') }}</b></span>
                                    <span class="app-hero__stats-item"><i class="far fa-user"></i> {{ savedWheel.unique_page_views }} <b class="_fw500">{{ $t('app_wheel.label_stats_users') }}</b></span>
                                </div>
                                <div class="app-hero__stats-info ml-aauto d-block d-lg-block">
                                    <button class="btn btn-secondary btn-bold ml-3" @click="openModal('wheelShareModal')">
                                        <i class="far fa-share mr-1"></i> {{ $t('buttons.share') }}
                                    </button>
                                    <button class="btn btn-secondary btn-bold ml-3" @click="onCreateNew()">
                                        <i class="far fa-plus mr-1"></i> {{ $t('app_wheel.btn_new_wheel') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="app-hero__curve" src="app_ruleta/img/landings/curve.svg">
            </div>
            <div class="container" style="position: relative; margin-top: -410px;">

                <div class="wof pb-5" :class="{'opened': customizer_mobile_opened}" v-cloak="">

                    <div class="wof__config card dash" v-if="mode==='edit' && !is_wheel_play_only" id="sidebarCollapseParent">
                        <div class="wof__config__menu d-lg-none">
                            <a class="wof__config__menu-item" :class="{active: customize_tab==='config'}" href="#" @click.prevent="onSelectTab('config')">
                                <i class="far fa-cog"></i> {{ $t('app_wheel.tab_config') }}
                            </a>
                            <a class="wof__config__menu-item" :class="{active: customize_tab==='prizes'}" href="#" @click.prevent="onSelectTab('prizes')">
                                <i class="far fa-gift"></i> {{ $t('app_wheel.tab_entries') }}
                            </a>
                            <a class="wof__config__menu-item" :class="{active: customize_tab==='design'}" href="#" @click.prevent="onSelectTab('design')">
                                <i class="far fa-palette"></i> {{ $t('app_wheel.tab_design') }}
                            </a>
                            <a class="wof__config__close" @click="closeCustomizer()">
                                <i class="far fa-times"></i>
                            </a>
                        </div>
                        <div class="promotion-editor-sidebar-section collapsed first-child d-none d-lg-block" data-toggle="collapse" data-target="#Customizer_Section_Form">
                            <i class="far fa-cog"></i> {{ $t('app_wheel.tab_config') }}
                        </div>
                        <div id="Customizer_Section_Form" class="row collapse promotion-editor-sidebar-body" data-parent="#sidebarCollapseParent">
                            <div class="wof__config__body">
                                <div class="form-group" v-if="savedWheel && savedWheel.id">
                                    <label for="">{{ $t('app_wheel.label_name') }}</label>
                                    <input type="text" class="form-control" v-model="title">
                                </div>
                                <div class="form-group">
                                    <div class="label_with_check _df _aic">
                                        <input type="checkbox" v-model="config.show_title" id="show_title" v-if="!config.capture_leads">
                                        <label for="show_title">{{ $t('app_wheel.label_title') }}</label>
                                    </div>
                                    <input v-if="config.show_title" v-model="config.title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="label_with_check _df _aic">
                                        <input type="checkbox" v-model="config.show_desc" id="show_description" v-if="!config.capture_leads">
                                        <label for="show_description">{{ $t('app_wheel.label_description') }}</label>
                                    </div>
                                    <textarea v-if="config.show_desc" v-model="config.description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="label_with_check _df _aic">
                                        <input type="checkbox" v-model="config.show_start_button" id="show_start_button" v-if="!config.capture_leads">
                                        <label for="show_start_button">{{ $t('app_wheel.label_spin_btn') }}</label>
                                    </div>
                                    <input v-if="config.show_start_button" v-model="config.start_button" type="text" maxlength="24" class="form-control">
                                </div>
                                <div class="form-group mb-3 noselect" v-if="!config.capture_leads">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="playSounds" v-model="config.play_sounds" @change="onPlaySoundsChange()">
                                        <label class="custom-control-label text-muteda" for="playSounds">{{ $t('app_wheel.label_play_sounds') }}</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 noselect" v-if="!config.capture_leads">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="showConfettis" v-model="config.show_confettis" @change="onShowConfettisChange()">
                                        <label class="custom-control-label text-mutead" for="showConfettis">{{ $t('app_wheel.label_show_confettis') }}</label>
                                    </div>
                                </div>

                                <div class="form-group mb-3 noselect" v-if="!config.capture_leads">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="wheel_auto_remove" v-model="config.wheel_auto_remove">
                                        <label class="custom-control-label" for="wheel_auto_remove">{{ $t('app_wheel.label_auto_remove_winners') }}</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3 noselect" v-if="!config.capture_leads">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="wheel_improve_slices" v-model="config.improve_slices" @change="setup()">
                                        <label class="custom-control-label" for="wheel_improve_slices">{{ $t('app_wheel.label_improve_slices') }}</label>
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="!config.capture_leads">
                                    <label class="mb-0">{{ $t('app_wheel.label_spin_duration') }}</label>
                                    <select class="form-control _fs14 px-1" style="max-width: 100px;" v-model="config.wheel_spin_duration">
                                        <option value="6">6 sec</option>
                                        <option value="10">10 sec</option>
                                        <option value="14">14 sec</option>
                                        <option value="20">20 sec</option>
                                        <option value="30">30 sec</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="promotion-editor-sidebar-section collapsed d-none d-lg-block" data-toggle="collapse" data-target="#Customizer_Section_Design">
                            <i class="far fa-palette"></i> {{ $t('app_wheel.tab_design') }}
                        </div>
                        <div id="Customizer_Section_Design" class="row collapse promotion-editor-sidebar-body" data-parent="#sidebarCollapseParent">
                            <div class="wof__config__body">
                                <div class="form-group">
                                    <label for="show_description">{{ $t('app_wheel.label_themes') }}</label>
                                    <div class="d-flex" style="flex-wrap: nowrap; justify-content: space-between; overflow-x: auto;">
                                        <div class="color_palette" v-for="theme in themes">
                                            <span v-for="color in theme.wheel_slices_color" @click="useTheme(theme)" :style="{backgroundColor: color}"></span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="form-divider">

                                <hr class="form-divider">
                                <div class="form-group _df _aic _jcb">
                                    <label class="mb-0">{{ $t('app_wheel.label_background_color') }}</label>
                                    <div class="color-input form-control form-control-lg" style="max-width: 130px;">
                                        {{ design.page_background_color }}
                                        <input type="color" class="form-control form-control-lg" v-model="design.page_background_color">
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb">
                                    <label class="mb-0">{{ $t('app_wheel.label_text_color') }}</label>
                                    <div class="color-input form-control form-control-lg" style="max-width: 130px;">
                                        {{ design.main_color }}
                                        <input type="color" class="form-control form-control-lg" v-model="design.main_color">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="label_with_check _df _aic">
                                        <input type="checkbox" v-model="show_design_advanced_settings" id="show_design_advanced_settings">
                                        <label for="show_design_advanced_settings">{{ $t('app_wheel.label_advanced_settings') }}</label>
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="show_design_advanced_settings && design.wheel_slices_color.length < 7">
                                    <label class="mb-0">{{ $t('app_wheel.label_wheel_slices_color') }}</label>
                                    <div class="themes-color-editor _df">
                                        <input type="color" class="form-control form-control-lg ml-1" v-model="design.wheel_slices_color[index]" v-for="(color, index) in design.wheel_slices_color" @input="onDesignPropChanged($event, 'wheel_slices_color', index)">
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="show_design_advanced_settings">
                                    <label class="mb-0">{{ $t('app_wheel.label_wheel_border_color') }}</label>
                                    <div class="color-input form-control form-control-lg" style="max-width: 130px;">
                                        {{ design.wheel_border_color }}
                                        <input type="color" class="form-control form-control-lg" v-model="design.wheel_border_color" @input="onDesignPropChanged($event, 'wheel_border_color')">
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="show_design_advanced_settings">
                                    <label class="mb-0">{{ $t('app_wheel.label_wheel_slice_text_color') }}</label>
                                    <div class="color-input form-control form-control-lg" style="max-width: 130px;">
                                        {{ design.wheel_slices_text_color }}
                                        <input type="color" class="form-control form-control-lg" v-model="design.wheel_slices_text_color" @input="onDesignPropChanged($event, 'wheel_slices_text_color')">
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="show_design_advanced_settings">
                                    <label class="mb-0">{{ $t('app_wheel.label_wheel_pointer_color') }}</label>
                                    <div class="color-input form-control form-control-lg" style="max-width: 130px;">
                                        {{ design.wheel_pointer_color }}
                                        <input type="color" class="form-control form-control-lg" v-model="design.wheel_pointer_color" @input="onDesignPropChanged($event, 'wheel_pointer_color')">
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="false && show_design_advanced_settings">
                                    <label class="mb-0">{{ $t('app_wheel.label_wheel_dots_color') }}</label>
                                    <div class="color-input form-control form-control-lg" style="max-width: 130px;">
                                        {{ design.wheel_dots_color }}
                                        <input type="color" class="form-control form-control-lg" v-model="design.wheel_dots_color">
                                    </div>
                                </div>
                                <div class="form-group _df _aic _jcb" v-if="show_design_advanced_settings">
                                    <label class="mb-0">{{ $t('app_wheel.label_wheel_line_size') }}</label>
                                    <input type="range" min="0" max="6" step="2" class="form-control form-control-lg px-0" style="max-width: 130px;" v-model="design.wheel_lines_size" @input="onDesignPropChanged($event, 'wheel_lines_size')">
                                </div>
                            </div>
                        </div>
                        <div class="promotion-editor-sidebar-section d-none d-lg-block" data-toggle="collapse" data-target="#Customizer_Section_Prizes">
                            <i class="far fa-gift"></i>
                            <span v-if="config.capture_leads">{{ $t('app_wheel.tab_rewards') }}</span>
                            <span v-else="">{{ $t('app_wheel.tab_entries') }}</span>
                            <span class="ml-1 _fs16" style="opacity: .6;" v-if="!config.capture_leads">({{participants.length}})</span>
                        </div>
                        <div id="Customizer_Section_Prizes" class="row show promotion-editor-sidebar-body" data-parent="#sidebarCollapseParent">
                            <div class="wof__config__body">
                                <div class="form-group mb-0" v-if="is_editing_bulk">

                                    <div class="_df _aic mb-2">
                                        <button @click="onSortEntrants()" class="btn btn-secondary btn-xs mr-2">
                                            <i class="far fa-sort-alpha-down" v-if="last_sort === 'za'"></i>
                                            <i class="far fa-sort-alpha-down-alt" v-else=""></i>
                                            {{ $t('app_wheel.btn_sort') }}
                                        </button>

                                        <button @click="onShuffleEntrants()" class="btn btn-secondary btn-xs mr-2"><i class="far  d-none mr-1 fa-random"></i> {{ $t('app_wheel.btn_random') }}</button>
                                        <button @click="onClearEntrants()" class="btn btn-secondary btn-xs"><i class="far  d-none mr-1 fa-trash-alt"></i> {{ $t('app_wheel.btn_clear') }}</button>
                                    </div>


                                    <textarea v-if="!config.advanced_mode" class="form-control form-control-lg" v-model="wheel_add_option_textarea" rows="16" @input="onWheelOptionsChanged()"></textarea>
                                    <div v-else="">
                                        <div class="_df _aic mb-1" v-for="(prize, index) in wheel_add_option_list">
                                            <div class="_pr w-100">
                                                <input type="text" v-model="prize.text" @input="onPrizeInputChange()" class="form-control form-control-sm _fs13">
                                                <div class="tex-muted small" style="position: absolute; top: 9px;right: 9px;">
                                                    <span style="color: #333" v-if="prize.chance !== -1">{{ prize.chance }}%</span>
                                                    <span v-else="" style="color: #999">{{ prize.calculated_chance }}%</span>
                                                </div>
                                            </div>
                                            <button class="btn btn-link p-0 _fs16 btn-xs ml-2" @click="onEditEntry(prize, index)">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <button class="btn btn-link p-0 _fs16 btn-xs ml-2" @click="onDeleteEntry(prize, index)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <button class="btn btn-sm btn-primary btn-block mt-3" @click="onAddEntry()">
                                            {{ $t('app_wheel.btn_add_entry') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="" v-if="!is_editing_bulk && participants.length">

                                    <div class="input-wrap mb-1" v-for="(prize, index) in prizes">
                                        <input type="text" v-model="prize.name" class="form-control form-control-sm _fs13" @input="onInputPrizeChange()" :class="(prize.type === 'empty') ? 'form-control-border-danger' : 'form-control-border-success'">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="wof__config__footer promotion-editor-sidebar-save-btn">
                            <button class="btn btn-success btn-lg btn-block mt-0 ml-2" @click="onLaunchWheel()" v-if="can_play_wheel" style="background: black;">
                                <i class="fas fa-play mr-1"></i> {{ $t('app_wheel.btn_play') }}
                            </button>
                        </div>
                    </div>

                    <div class="wof__main" id="screencast" :style="getWheelStyles('page')" @click="onWheelPreviewClick()" :class="{'playing': mode==='play', 'centered': is_wheel_centered, 'noselect editing': mode !== 'play', 'fullscreen': is_full_screen, 'spinning': is_wheel_spinning}">

                        <div class="wof__main__l">

                            <div class="wof__wheel__winner" v-if="wheel_segment_name" :style="{color: design.main_color}">
                                <h1 class="truncated_" :style="{fontSize: getFontSize(wheel_segment_name)}">{{ wheel_segment_name }}</h1>
                            </div>

                            <div class="wof__wheel">
                                <img v-if="design.logo" :src="design.logo" class="wof__wheel__logo">
                                <img v-else="" src="assets/img/<?php echo $logo; ?>" class="wof__wheel__logo">
                                <canvas v-on:click="run" id="canvas" width="500" height="500"></canvas>
                                <div class="wof__wheel__pointer">
                                    <svg width="100%" height="100%" viewbox="0 0 273 147" class="wof__wheel__pointer-svg" :style="getWheelStyles('pointer')">
                                        <g>
                                            <path fill="currentColor" d="M196.3 0h10.5l1 .25c10.06 1.9 19.63 5.06 28.1 10.93 11.28 7.55 19.66 18.43 25.12 30.78 1.9 6.4 4.06 12.23 4 19.04-.1 5.3.3 10.7-.34 15.97-2.18 14.1-9.08 27.46-19.38 37.33-10.03 10-23.32 16.4-37.33 18.4-4.95.54-10 .3-14.97.3-6.4-.02-13.06-2.82-19.2-4.68-54.98-17.5-109.95-35.08-164.96-52.5C4.7 74.7 2.14 73.33 0 69.5v-6.26c1.47-1.93 2.94-3.95 5.34-4.77C64.47 39.78 123.84 20.77 183 2c4.3-1.15 8.9-1.2 13.3-2z"></path>
                                            <path class="wof-pointer-shadow" opacity=".2" d="M261.02 41.96c6.74 9.2 10.54 20.04 11.98 31.3V88c-1.9 14.78-8.25 28.63-18.78 39.24-11 11.34-25.83 18.16-41.52 19.78h-12.65c-3.8-.6-7.57-1.4-11.22-2.63C132.4 126.43 76 108.37 19.55 90.5c-3.4-1.22-8.1-1.62-10.12-4.94-2.2-3.14-1.5-6.3-.6-9.73 55.02 17.4 110 35 164.97 52.5 6.14 1.85 12.8 4.65 19.2 4.66 4.97 0 10.02.24 14.97-.3 14-2 27.3-8.4 37.33-18.4 10.3-9.87 17.2-23.24 19.38-37.33.63-5.27.23-10.66.34-15.97.06-6.8-2.1-12.64-4-19.04v.01z"></path>
                                            <ellipse stroke="none" ry="25" rx="25" cy="65" cx="199.124" fill="#ffffff"></ellipse>
                                        </g>
                                    </svg>
                                </div>
                                <div class="wof__wheel__border" :style="getWheelStyles('border')" v-on:click="run"></div>
                            </div>


                            <button @click="run()" class="wof__main__btn" v-show="!is_wheel_centered" v-if="config.show_start_button && is_spin_btn_alone && !is_wheel_spinning" :style="getWheelStyles('spin-btn-alone')">
                                {{ (config.start_button) ? config.start_button : $t('app_wheel.btn_spin_default') }}
                            </button>

                            <div class="wof__main__winners" v-if="show_winners && !is_wheel_spinning" :style="{color: design.main_color}">
                                <span v-for="(item, index) in results" class="mr-3" style="display: inline-flex;">
                                    <span class="mr-1">{{index+1}}.</span> {{item}}
                                </span>
                            </div>
                        </div>
                        <div class="wof__main__r" v-if="!is_wheel_centered && !is_spin_btn_alone && !wheel_segment_name && !is_wheel_spinning && is_wheel_r_visible">
                            <h1 class="wof__main__title" v-if="config.show_title && config.title">{{ config.title }}</h1>
                            <p class="wof__main__desc" v-if="config.show_desc && config.description" v-html="config.description"></p>
                            <button @click="run()" class="wof__main__btn" v-if="config.show_start_button && !is_spin_btn_alone && !config.capture_leads" :style="getWheelStyles('spin-btn')">
                                {{ (config.start_button) ? config.start_button : $t('app_wheel.btn_spin_default') }}
                            </button>
                            <div class="wof__main__form" v-if="config.capture_leads">
                                <div class="form-group mb-2">
                                    <input type="text" name="first_name" :placeholder="$t('app_wheel.form_first_name')" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" name="first_name" :placeholder="$t('app_wheel.form_last_name')" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <input type="text" name="first_name" :placeholder="$t('app_wheel.form_email')" class="form-control">
                                </div>
                            </div>
                            <button @click="run()" class="wof__main__btn" v-if="config.capture_leads" :style="getWheelStyles('spin-btn')">
                                {{ (config.start_button) ? config.start_button : $t('app_wheel.btn_spin_default') }}
                            </button>
                        </div>
                        <div class="wof__main__options">
                            <div class="wof__main__options-item" @click.stop="toggleFullScreen()" :title="$t('app_wheel.tooltip_fullscreen')" data-toggle="tooltip">
                                <i class="far fa-fw fa-expand"></i>
                                <span>{{ $t('buttons.fullscreen') }}</span>
                            </div>
                            <div class="wof__main__options-item d-none">
                                <i class="far fa-fw fa-question-square"></i>
                                <span>{{ $t('buttons.help') }}</span>
                            </div>
                            <div class="wof__main__options-item hide-fs" @click.stop="toggleWinners()" :title="$t('app_wheel.tooltip_show_winners')" data-toggle="tooltip">
                                <i class="far fa-fw fa-trophy-alt"></i>
                                <span>{{ $t('buttons.results') }}</span>
                            </div>
                            <div class="wof__main__options-item" @click.stop="resetPlayWheel()" :title="$t('app_wheel.tooltip_reset_wheel')" data-toggle="tooltip">
                                <i class="far fa-fw far fa-undo-alt"></i>
                            </div>
                            <div class="wof__main__options-item hide-fs" @click.stop="toggleSound()" :title="$t('app_wheel.tooltip_toggle_sound')" data-toggle="tooltip">
                                <i class="far fa-fw fa-volume" v-if="config.play_sounds"></i>
                                <i class="far fa-fw fa-volume-mute" v-else=""></i>
                                <span>{{ $t('buttons.volume') }}</span>
                            </div>
                            <div class="wof__main__options-item hide-fs" v-if="!is_wheel_play_only" @click.stop="onStopPlaying()" :title="$t('app_wheel.tooltip_close')" data-toggle="tooltip">
                                <i class="far fa-fw fa-times"></i>
                            </div>
                        </div>
                        <a href="la-ruleta-decide-1.html?ref=wheel_watermark" class="wof__main__watermark" v-if="!user || user.is_free">
                            {{ $t('app_wheel.powered_by_watermark') }}
                        </a>
                        <div class="color_palette-inapp" @click.stop="">
                            <div class="d-flex" style="flex-wrap: nowrap; overflow-x: auto;">
                                <div class="color_palette" v-for="theme in themes">
                                    <span v-for="color in theme.wheel_slices_color" @click.stop="useTheme(theme)" :style="{backgroundColor: color}"></span>
                                </div>
                            </div>
                        </div>

                        <canvas id="jsccc" style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; z-index: 999999; pointer-events: none;"></canvas>
                    </div>

                    <div class="modal dash" tabindex="-1" role="dialog" id="saveModal">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title _fw900">{{ $t('app_wheel.save_modal.title') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                </div>
                                <div v-if="!saving" class="modal-body p-4">
                                    <div class="form-group mb-0">
                                        <label>{{ $t('labels.name') }}</label>
                                        <input v-model="save_form.name" type="text" class="form-control form-control-lg" :placeholder="$t('app_wheel.save_modal.placeholder_name')">
                                    </div>
                                </div>
                                <div v-if="saving" class="modal-body py-5 d-flex justify-content-center">
                                    <div class="loader"></div>
                                </div>

                                <div class="modal-footer">
                                    <div class="modal-footer-btns">


                                        <button v-if="config.capture_leads" type="button" :disabled="saving || !save_form.name || save_form.name.length < 3" class="btn btn-lg btn-primary btn-bold btn-block" @click="onSaveLeadsWheel()">Guardar</button>
                                        <button v-else="" type="button" :disabled="saving || !save_form.name || save_form.name.length < 3" class="btn btn-lg btn-primary btn-bold btn-block" @click="onSaveWheel()">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal dash" tabindex="-1" role="dialog" id="wheelShareModal">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title _fw900">{{ $t('app_wheel.share_modal.title') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body p-4 text-center" v-if="savedWheel && savedWheel.id">
                                    <a class="_fw700" :href="savedWheel.share_url" target="_blank">{{ savedWheel.share_url.replace('http://', '') }}</a>
                                    <br><br>
                                    <button class="btn btn-primary" @click="copyWheelLink($event)">{{ $t('buttons.copy') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal dash" tabindex="-1" role="dialog" id="wheelPrizeModal">
                        <div class="modal-dialog  modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title _fw900">{{ $t('buttons.edit') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body p-4" v-if="edit_entry_modal">
                                    <div class="form-group">
                                        <label for="">{{ $t('labels.name') }}</label>
                                        <input type="text" class="form-control" v-model="edit_entry_modal.text">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{ $t('labels.chance') }}</label>

                                        <select class="form-control custom-select" v-model="edit_entry_modal.chance">
                                            <option value="-1">Auto</option>
                                            <option value="0">0%</option>
                                            <option value="1" :disabled="edit_entry_modal.max_chance_available < 1">1%</option>
                                            <option value="3" :disabled="edit_entry_modal.max_chance_available < 3">3%</option>
                                            <option value="5" :disabled="edit_entry_modal.max_chance_available < 5">5%</option>
                                            <option value="10" :disabled="edit_entry_modal.max_chance_available < 10">10%</option>
                                            <option value="15" :disabled="edit_entry_modal.max_chance_available < 15">15%</option>
                                            <option value="20" :disabled="edit_entry_modal.max_chance_available < 20">20%</option>
                                            <option value="25" :disabled="edit_entry_modal.max_chance_available < 25">25%</option>
                                            <option value="30" :disabled="edit_entry_modal.max_chance_available < 30">30%</option>
                                            <option value="40" :disabled="edit_entry_modal.max_chance_available < 40">40%</option>
                                            <option value="50" :disabled="edit_entry_modal.max_chance_available < 50">50%</option>
                                            <option value="60" :disabled="edit_entry_modal.max_chance_available < 60">60%</option>
                                            <option value="70" :disabled="edit_entry_modal.max_chance_available < 70">70%</option>
                                            <option value="75" :disabled="edit_entry_modal.max_chance_available < 75">75%</option>
                                            <option value="80" :disabled="edit_entry_modal.max_chance_available < 80">80%</option>
                                            <option value="90" :disabled="edit_entry_modal.max_chance_available < 90">90%</option>
                                            <option value="99" :disabled="edit_entry_modal.max_chance_available < 99">99%</option>
                                            <option value="100" :disabled="edit_entry_modal.max_chance_available < 100">100%</option>



                                        </select>
                                        <div class="text-danger small mt-2" v-if="parseInt(edit_entry_modal.chance) === 0">
                                            {{ $t('app_wheel.label_prize_0_chance') }}
                                        </div>
                                    </div>


                                    <div>
                                        <button class="btn btn-primary btn-lg" @click="onEditEntryApplyChanges()">
                                            {{ $t('buttons.apply_changes') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal dash" tabindex="-1" role="dialog" id="LeadsWheelExplainModal">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">


                                <button type="button" class="close close-fixed" data-dismiss="modal" aria-label="Close">
                                    <i class="fal fa-times"></i>
                                </button>

                                <div class="modal-body p-5">
                                    <div class="text-center">
                                        <div class="_df _aic _jcc">
                                            <div class="sweepstake__icon app-icon wh-56 center-flex" style="background-color: #e36692; box-shadow: 0 0 0px 3px #ffffff, 0 0 0px 4px #0000001c;">
                                                <svg viewbox="79.501 0.656 103.449 103.547" width="103.449" height="103.547" style="width: 34px;" fill="white">
                                                    <path d="M 1220.106 1036.968 C 1190.106 1031.968 1129.106 1009.968 1085.106 988.968 C 796.106 846.968 705.106 477.968 894.106 219.968 C 1046.106 13.968 1314.106 -50.032 1549.106 63.968 C 1623.106 99.968 1738.106 214.968 1774.106 288.968 C 1891.106 530.968 1818.106 810.968 1599.106 956.968 C 1495.106 1026.968 1344.106 1057.968 1220.106 1036.968 Z M 1445.106 940.968 C 1512.106 919.968 1578.106 876.968 1633.106 818.968 C 1775.106 666.968 1788.106 435.968 1665.106 267.968 C 1512.106 59.968 1210.106 28.968 1023.106 200.968 C 926.106 289.968 879.106 392.968 878.106 518.968 C 877.106 613.968 898.106 686.968 948.106 763.968 C 1055.106 928.968 1253.106 999.968 1445.106 940.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1257.106 919.968 C 1242.106 902.968 1243.106 890.968 1268.106 757.968 C 1289.106 648.968 1299.106 611.968 1311.106 609.968 C 1324.106 607.968 1332.106 632.968 1353.106 739.968 C 1385.106 898.968 1386.106 913.968 1361.106 927.968 C 1330.106 943.968 1275.106 939.968 1257.106 919.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1098.106 872.968 C 1077.106 858.968 1060.106 840.968 1060.106 832.968 C 1060.106 818.968 1218.106 627.968 1254.106 598.968 C 1286.106 571.968 1280.106 613.968 1233.106 752.968 C 1189.106 879.968 1183.106 892.968 1160.106 895.968 C 1146.106 896.968 1119.106 887.968 1098.106 872.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1443.106 885.968 C 1438.106 878.968 1412.106 812.968 1386.106 738.968 C 1354.106 645.968 1343.106 600.968 1350.106 593.968 C 1362.106 581.968 1357.106 576.968 1474.106 711.968 C 1570.106 822.968 1575.106 838.968 1521.106 874.968 C 1483.106 900.968 1457.106 903.968 1443.106 885.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 989.106 765.968 C 963.106 743.968 939.106 697.968 942.106 674.968 C 945.106 655.968 966.106 645.968 1085.106 604.968 C 1224.106 557.968 1266.106 551.968 1239.106 583.968 C 1218.106 608.968 1020.106 777.968 1012.106 777.968 C 1007.106 777.968 997.106 771.968 989.106 765.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1495.106 682.968 C 1391.106 593.968 1362.106 557.968 1392.106 557.968 C 1399.106 557.968 1465.106 578.968 1538.106 603.968 C 1691.106 657.968 1703.106 668.968 1669.106 725.968 C 1645.106 764.968 1632.106 777.968 1615.106 777.968 C 1609.106 777.968 1555.106 734.968 1495.106 682.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 917.106 579.968 C 898.106 558.968 895.106 506.968 910.106 476.968 C 924.106 451.968 939.106 452.968 1098.106 484.968 C 1276.106 519.968 1275.106 531.968 1085.106 568.968 C 1008.106 583.968 942.106 596.968 939.106 596.968 C 936.106 597.968 926.106 589.968 917.106 579.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1538.106 568.968 C 1462.106 553.968 1397.106 537.968 1393.106 534.968 C 1377.106 518.968 1414.106 505.968 1548.106 480.968 C 1713.106 449.968 1720.106 451.968 1720.106 528.968 C 1720.106 566.968 1716.106 579.968 1701.106 587.968 C 1690.106 592.968 1680.106 597.968 1678.106 596.968 C 1676.106 596.968 1613.106 583.968 1538.106 568.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1093.106 449.968 C 1020.106 423.968 955.106 396.968 949.106 390.968 C 925.106 366.968 973.106 277.968 1009.106 277.968 C 1019.106 277.968 1076.106 320.968 1136.106 372.968 C 1292.106 508.968 1286.106 518.968 1093.106 449.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1385.106 486.968 C 1376.106 472.968 1383.106 465.968 1495.106 367.968 C 1615.106 263.968 1631.106 259.968 1667.106 322.968 C 1694.106 370.968 1694.106 371.968 1675.106 390.968 C 1655.106 411.968 1392.106 498.968 1385.106 486.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1174.106 365.968 C 1063.106 236.968 1058.106 229.968 1064.106 210.968 C 1073.106 182.968 1146.106 144.968 1169.106 156.968 C 1186.106 166.968 1280.106 407.968 1280.106 443.968 C 1280.106 475.968 1250.106 452.968 1174.106 365.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1348.106 451.968 C 1339.106 443.968 1429.106 179.968 1447.106 162.968 C 1466.106 143.968 1467.106 143.968 1515.106 170.968 C 1578.106 205.968 1571.106 227.968 1462.106 351.968 C 1373.106 453.968 1360.106 464.968 1348.106 451.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                    <path d="M 1295.106 425.968 C 1292.106 412.968 1279.106 346.968 1265.106 279.968 C 1235.106 129.968 1238.106 117.968 1309.106 117.968 C 1385.106 117.968 1387.106 125.968 1360.106 275.968 C 1335.106 415.968 1325.106 447.968 1310.106 447.968 C 1305.106 447.968 1298.106 437.968 1295.106 425.968 Z" transform="matrix(0.1, 0, 0, -0.1, 0, 104.999991)"></path>
                                                </svg>
                                            </div>
                                            <img src="app_ruleta/img/apps/wheel-modal-exchange.png" class="mx-2" width="32">
                                            <div class="app-icon wh-56 center-flex" style="background-color: #6a7ef4; color: white; box-shadow: 0 0 0px 3px #ffffff, 0 0 0px 4px #0000001c;">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <h4 class="_fw900 mt-4">{{ $t('app_wheel.leads_modal.title') }}</h4>
                                        <p class="my-3" style="color:#676F79">{{ $t('app_wheel.leads_modal.desc') }}</p>
                                    </div>

                                    <div class="_df _jcc w-100">
                                        <ul class="list-unstyled d-inline-block mb-0">
                                            <li class="mt-3 _fs16 _fw500"><i class="fas fa-check-circle mr-2" style="color:#4887fb"></i> {{ $t('app_wheel.leads_modal.step_1') }}</li>
                                            <li class="mt-3 _fs16 _fw500"><i class="fas fa-check-circle mr-2" style="color:#4887fb"></i> {{ $t('app_wheel.leads_modal.step_2') }}</li>
                                            <li class="mt-3 _fs16 _fw500"><i class="fas fa-check-circle mr-2" style="color:#4887fb"></i> {{ $t('app_wheel.leads_modal.step_3') }}</li>
                                            <li class="mt-3 _fs16 _fw500"><i class="fas fa-check-circle mr-2" style="color:#4887fb"></i> {{ $t('app_wheel.leads_modal.step_4') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="modal-footer-btns">
                                        <button class="btn btn-secondary" data-dismiss="modal">{{ $t('app_wheel.leads_modal.btn_cancel') }}</button>
                                        <button class="btn btn-primary btn-bold" @click="onActivateLeadsWheel()">{{ $t('app_wheel.leads_modal.btn_activate') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <app-signup ref="AuthModal" @signup="onUserSignup" @login="onUserLogin" source="wheel"></app-signup>

                    <div class="modal dash upgrade__modal" id="upgradeModal3" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" :style="(upgrade_modal.upgrade_step !== 1 && upgrade_modal.app_type !== 'fortune-wheel') ? 'max-width: 550px;' : ''">
                            <div class="modal-content">
                                <div class="modal-body" v-if="upgrade_modal.features_page && upgrade_modal.upgrade_step === 1">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 10px; right: 10px">
                                        <i class="far text-muted fa-times"></i>
                                    </button>
                                    <div class="text-center">
                                        <h4 class="mb-4 mt-4 _fw900" v-html="upgrade_modal.features_page.title"></h4>
                                        <p class="mt-3 text-muted" v-html="upgrade_modal.features_page.text"></p>
                                    </div>
                                    <div class="_df _jcc" v-if="upgrade_modal.features_page.features">
                                        <ul class="upgrade__features-list list-unstyled mt-4 mb-4 d-inline-block">
                                            <li class="mt-2" v-for="feat in upgrade_modal.features_page.features"><i class="fas fa-check mr-2" style="color: #72bf0f;"></i> {{ feat }}</li>
                                        </ul>
                                    </div>
                                    <div class="mt-4 mb-3 _df _jcc">
                                        <button type="button" class="btn btn-success btn-lg px-5 upgrade__cta-button" @click="upgrade_modal.upgrade_step=2;">{{ $t('upgrade.continue_btn') }}</button>
                                    </div>
                                </div>
                                <div class="modal-body" v-else="">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 10px; right: 10px">
                                        <i class="far text-muted fa-times"></i>
                                    </button>
                                    <div class="text-center" v-if="upgrade_modal.target_feature === 'instagram-multipost'">
                                        <h4>{{ $t('upgrade.multipost.title') }}</h4>
                                        <p class="text-muted _fs14 mt-2">{{ $t('upgrade.multipost.text') }}</p>
                                    </div>
                                    <div class="text-center" v-else-if="upgrade_modal.target_feature === 'multi-network'">
                                        <div class="app-stacked-icons">
                                            <div class="app-icon mb-3 color-instagram bg-instagram-10 wh-32 center-flex">
                                                <i class="fab fa-instagram"></i>
                                            </div>
                                            <div class="app-icon mb-3 color-facebook bg-facebook-10 wh-32 center-flex">
                                                <i class="fab fa-facebook"></i>
                                            </div>
                                            <div class="app-icon mb-3 color-twitter bg-twitter-10 wh-32 center-flex">
                                                <i class="fab fa-twitter"></i>
                                            </div>
                                            <div class="app-icon mb-3 color-youtube bg-youtube-10 wh-32 center-flex">
                                                <i class="fab fa-youtube"></i>
                                            </div>
                                        </div>
                                        <h4 class="_fw900 _fs30" v-html="$t('upgrade.multinetwork.title')"></h4>
                                        <p class="text-muted _fs14 mt-3" v-html="$t('upgrade.multinetwork.text')"></p>
                                    </div>
                                    <div class="text-center" v-else-if="upgrade_modal.custom_title && upgrade_modal.custom_text">
                                        <h4>{{ upgrade_modal.custom_title }}</h4>
                                        <p class="text-muted _fs14 mt-2" v-html="upgrade_modal.custom_text"></p>
                                    </div>
                                    <div class="text-center" v-else="">
                                        <h4>¡Has superado el límite!</h4>
                                        <p class="text-muted _fs14 mt-2" v-html="__e('upgradeText1', formatNumber(upgrade_modal.target_comments_limit))"></p>
                                    </div>
                                    <div class="upgrade__plan_duration">
                                        <div class="btn-container">
                                            <label class="btn-color-mode-switch">
                                                <input type="checkbox" name="upgrade_modal_yearly_pricing" id="upgrade_modal_yearly_pricing" v-model="upgrade_modal.yearly_pricing" @change="onUpgradeModalSwitchDuration()">
                                                <label for="upgrade_modal_yearly_pricing" :data-on="$t('upgrade.switch_year')" :data-off="$t('upgrade.switch_month')" class="btn-color-mode-switch-inner"></label>
                                            </label>
                                        </div>
                                        <span class="upgrade__plan_duration-label d-none">
                                            <span v-html="$t('upgrade.yearly_discount_label')"></span>
                                        </span>
                                    </div>
                                    <div class="upgrade__special-offer" v-if="upgrade_modal.show_countdown">

                                        <span>{{ $t('upgrade.banner_offer') }}</span>
                                        <span id="upgrade_countdown" style="font-weight: 700; min-width: 50px; font-size: 20px; display: inline-block;">
                                            17:00
                                        </span>
                                    </div>
                                    <div class="upgrade__plans" v-if="upgrade_modal.active_plan">
                                        <ul class="list-group radio-btn-group alt bg-white whaite hide-radios">
                                            <label class="list-group-item" @click="onUpgradeModalSelectPlan(plan)" :class="getPlanClass(plan)" v-for="plan in upgrade_modal.plans" v-if="(upgrade_modal.yearly_pricing && plan.type === 'year') || (!upgrade_modal.yearly_pricing && plan.type === 'month')">
                                                <input id="free_check" type="radio" value="free" autocomplete="off" class="text-brand custom-radio">
                                                <div class="_df flex-column">
                                                    <div>
                                                        <span class="_fw700 _fs18">{{ plan.name }}</span>
                                                        <span class="badge badge-success upgrade__badge-your-plan _fs13" v-if="user_current_plan === plan.slug">{{ $t('upgrade.your_plan') }}</span>
                                                    </div>
                                                    <span class="_fs14 _fw400 mt-1" v-if="upgrade_modal.app_type === 'fortune-wheel'">
                                                        <div class="mb-1 d-inline">
                                                            <i class="fas fa-check mr-2" style="color: rgb(114, 191, 15);"></i>
                                                            <span v-html="$t('upgrade.x_active_promotions', { n: formatNumber(plan.features.PROMOTIONS_ACTIVE_CAMPAINGS) })"></span>
                                                        </div>
                                                        <span class="mx-1 d-none d-md-inline text-gray-1">/</span>
                                                        <div class="d-inline">
                                                            <span v-html="$t('upgrade.up_to_x_pageviews', { n: formatNumber(plan.features.PROMOTIONS_PAGE_VIEWS) })"> *</span>
                                                        </div>
                                                        <div v-if="plan.features.PROMOTIONS_NO_BRANDING" class="mt-1">
                                                            <i class="fas fa-check mr-2" style="color: rgb(114, 191, 15);"></i> {{ $t('upgrade.no_branding') }}
                                                        </div>
                                                    </span>
                                                    <span class="_fs12 mt-1" v-else="">
                                                        {{ $t('upgrade.unlimited_giveaways') }}
                                                        <i class="fab fa-instagram color-instagram"></i>
                                                        <i class="fab fa-tiktok color-tiktok" v-if="plan.features.TIKTOK_COMMENTS_LIMIT"></i>
                                                        <i class="fab fa-facebook color-facebook"></i>
                                                        <i class="fab fa-twitter color-twitter"></i>
                                                        <i class="fab fa-youtube color-youtube"></i>
                                                        <span class="mx-1 d-none d-md-inline">/</span>
                                                        <span class="d-block d-md-inline" v-if="plan.features.INSTAGRAM_COMMENTS_LIMIT === 999999">{{ $t('upgrade.unlimited_comments') }}</span>

                                                        <span class="d-block d-md-inline" v-else="" v-html="$t('upgrade.up_to_x_comments', { n: formatNumber(plan.features.INSTAGRAM_COMMENTS_LIMIT) })"></span>
                                                    </span>
                                                </div>
                                                <div class="ml-auto _fw500 _pr">
                                                    <div v-if="upgrade_modal.show_countdown" class="upgrade__plan-price" style="font-size: 17px; position: absolute; left: -43px; text-decoration:line-through;">
                                                        {{ getCurrencySymbol(plan.currency) }}{{ getOfferPlan(plan.price) }}
                                                    </div>
                                                    <div class="upgrade__plan-pricing">
                                                        <div class="upgrade__plan-price" v-if="plan.type === 'month'">
                                                            {{ getCurrencySymbol(plan.currency) }}{{ plan.price }}
                                                        </div>
                                                        <div class="upgrade__plan-price" v-if="plan.type === 'year'">
                                                            <span style="position: relative; right: -3px;">{{ getCurrencySymbol(plan.currency) }}{{ plan.price }}</span>


                                                        </div>
                                                        <div class="upgrade__plan-currency text-gray-1 text-right">
                                                            <span v-if="plan.type == 'month'">/{{ $t('upgrade.mo') }}</span>
                                                            <span v-if="plan.type == 'year'">/{{ $t('upgrade.yr') }}</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="text-muted text-center my-2 _fs13" v-if="upgrade_modal.app_type === 'fortune-wheel'">
                                        * {{ $t('upgrade.up_to_x_pageviews_note') }}
                                    </div>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-success btn-lg px-5 upgrade__cta-button" @click="onUpgradeModalOpenCheckout()">{{ $t('upgrade.btn_unlock') }}</button>
                                        <p class="text-muted _fs13 mt-3 mb-0" v-if="upgrade_modal.app_type !== 'fortune-wheel'">
                                            {{ $t('upgrade.footer_note') }}
                                        </p>
                                        <p class="text-muted _fs13 mt-2 mb-0" v-if="upgrade_modal.app_type !== 'fortune-wheel'">
                                            <a :href="getGlobalLink('plans')" class="text-muted" target="_blank">{{ $t('upgrade.link_pricing') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal dash upgrade__modal" id="upgradeModalExternalVendor" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: 10px; right: 10px">
                                        <i class="far text-muted fa-times"></i>
                                    </button>
                                    <div class="text-center">
                                        <h4>¡Has superado el límite!</h4>
                                        <p class="text-muted _fs14 mt-2" v-html="__e('upgradeText1', formatNumber(upgrade_modal.target_comments_limit))"></p>
                                    </div>
                                    <div class="my-4 text-center">
                                        You have a custom plan from AppSumo, please go to your account settings to Manage your License.
                                    </div>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-primary btn-lg px-5" @click="onManageLicense()">
                                            Manage License
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <app-media-gallery ref="media-gallery" :pattern-bg-color="design.page_background_color" @upload="onImageSelected($event)" @selected="onImageSelected($event)"></app-media-gallery>
                </div>
            </div>
        </div>
        <script type="3eab436ace7728c68e812583-text/javascript" src="app_ruleta/js/sharethis.js#property=5ea4443da10c1200152b4814&product=sticky-share-buttons&cms=sop" defer="defer"></script>
        <script type="3eab436ace7728c68e812583-text/javascript">
            setTimeout(function() {
                (stpdwrapper = window.stpdwrapper || []).push({});
                // (function () {
                // var size='160x600',
                //     adunit = 'app-sorteos.com_160x600_sticky_right_desktop_DFP',
                //     childNetworkId = '22370358227',
                //     xmlhttp = new XMLHttpRequest();xmlhttp.onreadystatechange = function(){if(xmlhttp.readyState==4 && xmlhttp.status==200){var iframe=document.getElementById(adunit).contentWindow.document;iframe.open();iframe.write(xmlhttp.responseText);iframe.close();}};var child=childNetworkId.trim()?','+childNetworkId.trim():'';xmlhttp.open("GET", 'https://pubads.g.doubleclick.net/gampad/adx?iu=/147246189'+child+'/'+adunit+'&sz='+encodeURI(size)+'&t=Placement_type%3Dserving&'+Date.now(), true);xmlhttp.send();})();
            }, 5000)
        </script>
    </div>
    <script type="3eab436ace7728c68e812583-text/javascript">
        (function(c, a) {
            if (!a.__SV) {
                var b = window;
                try {
                    var d, m, j, k = b.location,
                        f = k.hash;
                    d = function(a, b) {
                        return (m = a.match(RegExp(b + "=([^&]*)"))) ? m[1] : null
                    };
                    f && d(f, "state") && (j = JSON.parse(decodeURIComponent(d(f, "state"))), "mpeditor" === j.action && (b.sessionStorage.setItem("_mpcehash", f), history.replaceState(j.desiredHash || "", c.title, k.pathname + k.search)))
                } catch (n) {}
                var l, h;
                window.mixpanel = a;
                a._i = [];
                a.init = function(b, d, g) {
                    function c(b, i) {
                        var a = i.split(".");
                        2 == a.length && (b = b[a[0]], i = a[1]);
                        b[i] = function() {
                            b.push([i].concat(Array.prototype.slice.call(arguments,
                                0)))
                        }
                    }
                    var e = a;
                    "undefined" !== typeof g ? e = a[g] = [] : g = "mixpanel";
                    e.people = e.people || [];
                    e.toString = function(b) {
                        var a = "mixpanel";
                        "mixpanel" !== g && (a += "." + g);
                        b || (a += " (stub)");
                        return a
                    };
                    e.people.toString = function() {
                        return e.toString(1) + ".people (stub)"
                    };
                    l = "disable time_event track track_pageview track_links track_forms track_with_groups add_group set_group remove_group register register_once alias unregister identify name_tag set_config reset opt_in_tracking opt_out_tracking has_opted_in_tracking has_opted_out_tracking clear_opt_in_out_tracking people.set people.set_once people.unset people.increment people.append people.union people.track_charge people.clear_charges people.delete_user people.remove".split(" ");
                    for (h = 0; h < l.length; h++) c(e, l[h]);
                    var f = "set set_once union unset remove delete".split(" ");
                    e.get_group = function() {
                        function a(c) {
                            b[c] = function() {
                                call2_args = arguments;
                                call2 = [c].concat(Array.prototype.slice.call(call2_args, 0));
                                e.push([d, call2])
                            }
                        }
                        for (var b = {}, d = ["get_group"].concat(Array.prototype.slice.call(arguments, 0)), c = 0; c < f.length; c++) a(f[c]);
                        return b
                    };
                    a._i.push([b, d, g])
                };
                a.__SV = 1.2;
                b = c.createElement("script");
                b.type = "text/javascript";
                b.async = !0;
                b.src = "undefined" !== typeof MIXPANEL_CUSTOM_LIB_URL ?
                    MIXPANEL_CUSTOM_LIB_URL : "file:" === c.location.protocol && "//cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js".match(/^\/\//) ? "https://cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js" : "//cdn4.mxpnl.com/libs/mixpanel-2-latest.min.js";
                d = c.getElementsByTagName("script")[0];
                d.parentNode.insertBefore(b, d)
            }
        })(document, window.mixpanel || []);
        mixpanel.init("d4277a45cee115114888f6e17552af75");
    </script>

    <script async="" src="app_ruleta/gtag/js?id=UA-133519727-1" type="3eab436ace7728c68e812583-text/javascript"></script>
    <script type="3eab436ace7728c68e812583-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-133519727-1');
    </script>

    <script async="" src="app_ruleta/gtag/js-1?id=G-6G7LBWX7R9" type="3eab436ace7728c68e812583-text/javascript"></script>
    <script type="3eab436ace7728c68e812583-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-6G7LBWX7R9');
        gtag('config', 'AW-10903692817');
    </script>
    <script type="3eab436ace7728c68e812583-text/javascript">
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_ES/sdk.js?v=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>



    <template id="vue-app-signup" type="text/x-template">
        <div class="modal dash signup-modal" id="authModal">
            <div class="modal-dialog modal-dialog-top modal-md">
                <div class="modal-content">
                    <div class="modal-body _p30" v-if="!accountCreated">
                        <i class="fal fa-times modal-close-icon" data-dismiss="modal" aria-label="Close"></i>

                        <form id="signupForm" action="#" method="POST" v-if="tab==='signup'">
                            <div class="text-center text-center px-4 pt-4 pb-3">
                                <h3 class="_fw900 _fs36">¡Únete!</h3>
                                <p class="text-muted">Crea tu cuenta en segundos.</p>
                            </div>
                            <a @click="onFacebookLogin()" class="btn btn-light btn-block btn-lg" :class="{'is-loading': connecting_with_facebook}">
                                <i class="fab fa-facebook mr-2 color-facebook btn-login-facebook"></i> Ingresar con Facebook </a>
                            <div class="or">OR</div>
                            <div class="_df">
                                <div class="form-group has-icon mb-3 mr-3">
                                    <input ref="signup_name_input" name="first_name" v-model="form.first_name" type="text" class="form-control form-control-lg has-icon" :class="{'is-invalid': errors.first_name}" @input="errors.first_name=false;" placeholder="Nombre">
                                    <i class="fal fa-user-circle form-control-icon"></i>
                                </div>
                                <div class="form-group has-icon mb-3">
                                    <input name="last_name" v-model="form.last_name" type="text" class="form-control form-control-lg has-icon" :class="{'is-invalid': errors.last_name}" @input="errors.last_name=false;" placeholder="Apellido">
                                    <i class="fal fa-user-circle form-control-icon"></i>
                                </div>
                            </div>
                            <div class="form-group has-icon mb-3">
                                <input name="email" type="text" v-model="form.email" class="form-control form-control-lg has-icon" :class="{'is-invalid': errors.email}" @input="errors.email=false;" autocomplete="new-username" placeholder="Email">
                                <i class="fal fa-envelope form-control-icon"></i>
                                <small class="form-text invalid-feedback" v-if="email_exists">
                                    El email ya está en uso </small>
                                <small class="form-text invalid-feedback" v-if="email_verification_fail">
                                    El email es inválido, por favor revísalo o ingresa otro </small>
                            </div>
                            <div class="form-group has-icon mb-3">
                                <input name="password" :type="(pwd_visible) ? 'text' : 'password'" v-model="form.password" required="required" minlength="6" class="form-control form-control-lg has-icon" autocomplete="new-password" :class="{'is-invalid': errors.password}" @input="errors.password=false;" placeholder="Contraseña">
                                <i class="fal fa-lock-alt form-control-icon"></i>
                                <button type="button" class="btn btn-light btn-xs btn-show-pwd" @click="pwd_visible=!pwd_visible">
                                    <span v-if="!pwd_visible"><i class="far fa-eye"></i></span>
                                    <span v-else=""><i class="far fa-eye-slash"></i></span>
                                </button>
                            </div>
                            <input type="hidden" name="lang" value="es">
                            <input type="hidden" name="source" v-model="form.source">
                            <div class="form-group form-check mb-0 d-none">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    Acepto los <a href="">términos del servicio</a>
                                </label>
                            </div>
                            <button type="button" :disabled="loading" @click="signup()" class="btn btn-block btn-primary btn-lg mt-4" :class="{'is-loading': loading}">
                                Crea tu cuenta </button>
                        </form>

                        <form id="signupForm" action="#" method="POST" v-if="tab==='signin'">
                            <div class="text-center text-center px-4 pt-4 pb-3">
                                <h3 class="_fw900 _fs36">¡Hola!</h3>
                                <p class="text-muted">Ingresa a tu cuenta aquí</p>
                            </div>
                            <a @click="onFacebookLogin()" class="btn btn-light btn-block btn-lg" :class="{'is-loading': connecting_with_facebook}">
                                <i class="fab fa-facebook mr-2 color-facebook btn-login-facebook"></i> Ingresar con Facebook </a>
                            <div class="or">OR</div>
                            <div class="form-group has-icon mb-3">
                                <input name="email" ref="signin_email_input" type="text" v-model="form.email" class="form-control form-control-lg has-icon" :class="{'is-invalid': errors.email}" @input="errors.email=false;" placeholder="Email" autocomplete="username">
                                <i class="fal fa-envelope form-control-icon"></i>
                            </div>
                            <div class="form-group has-icon">
                                <input name="password" :type="(pwd_visible) ? 'text' : 'password'" v-model="form.password" autocomplete="current-password" required="required" minlength="6" class="form-control form-control-lg has-icon" :class="{'is-invalid': errors.password}" @input="errors.password=false;" placeholder="Contraseña">
                                <i class="fal fa-lock-alt form-control-icon"></i>
                                <button type="button" class="btn btn-light btn-xs btn-show-pwd" @click="pwd_visible=!pwd_visible">
                                    <span v-if="!pwd_visible"><i class="far fa-eye"></i></span>
                                    <span v-else=""><i class="far fa-eye-slash"></i></span>
                                </button>
                            </div>
                            <button type="button" :disabled="loading" @click="login()" class="btn btn-block btn-primary btn-lg mt-4" :class="{'is-loading': loading}">
                                Ingresar </button>
                        </form>
                    </div>

                    <div class="modal-body p-4" v-else="">
                        <div class="text-center text-center px-4 pt-4 pb-3">
                            <i class="fal fa-smile mb-3 text-brand" style="font-size: 60px;"></i>
                            <h2><strong>¡Bienvenido!</strong></h2>
                            <p class="text-muted">Tu cuenta fue creada exitosamente.</p>
                            <button class="btn btn-primary btn-lg btn-block mt-5" data-dismiss="modal" aria-label="Close" @click="onContinue()">Continuar</button>
                        </div>
                    </div>
                    <div class="modal-footer _jcc pt-2" style="border-top: 0; padding-bottom: 30px !important;" v-if="!accountCreated">
                        <div class="text-center">
                            <div v-if="tab ==='signup'">¿Tienes una cuenta? <a href="#/login" @click.prevent="onSwitchTab('signin')">Ingresar</a></div>
                            <div v-if="tab ==='signin'" class="_fs14">¿No tienes una cuenta? <a href="#/signup" @click.prevent="onSwitchTab('signup')">Crear cuenta</a></div>
                            <div v-if="tab ==='signin'" class="_fs14 mt-2"><a href="/reset-password">Recuperar Contraseña</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </template> <template id="vue-app-file-uploader" type="text/x-template">
        <div class="dropzone" :class="{active: dragging}" @drop.prevent="onDrop" @dragover.prevent="dragging=true;" @dragleave.prevent.stop="dragging=false" @click="onClick">
            <i class="fal fa-file"></i>
            {{ $t('file_uploader.select_or_drop') }}
            <span class="text-sm mt-2">{{ $t('file_uploader.accepted_ext', {files: (extensions) ? extensions : '.txt, .csv'}) }}</span>
            <input type="file" ref="input" @change="onFileSelected($event)" class="form-control form-control-file" :accept="accept || '.csv, .txt, text/csv, text/plain'">
        </div>
    </template> <template id="vue-app-media-gallery" type="text/x-template">
        <div class="modal dash" tabindex="-1" role="dialog" id="mediaGalleryModal">
            <div class="modal-dialog modal-dialog-top modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header gradiaent">
                        <h5 class="modal-title">{{ $t('media_gallery.title') }}</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                    <div class="tabs-menu" style="border-top: 0;">
                        <nav>
                            <a href="javascript:void(0);" :class="{active: tab === 'upload'}" @click="tab='upload'">{{ $t('media_gallery.tab_upload') }}</a>
                            <a href="javascript:void(0);" :class="{active: tab === 'patterns'}" @click="tab='patterns';">{{ $t('media_gallery.tab_patterns') }}</a>
                            <a href="javascript:void(0);" :class="{active: tab === 'gradients'}" @click="tab='gradients';">{{ $t('media_gallery.tab_gradients') }}</a>

                        </nav>
                    </div>
                    <div class="modal-body" v-if="tab==='search'">
                        <input type=" text" class="form-control form-control-lg" v-model="query" @keyup.enter="onSearch()" placeholder="Search photos on Unsplash">
                    </div>
                    <div class="modal-body" v-if="tab==='search' && results.length">
                        <div class="image-search-results">
                            <div class="image-search-item" v-for="image in results" @click="downloadImage(image)">
                                <img :src="image.urls.small" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body" v-if="tab==='patterns'">
                        <div class="image-search-results">
                            <div class="image-search-item image-pattern-item" :style="{'background-color': patternBgColor, 'background-image': 'url(' + patterns_base_url + image + ')'}" v-for="image in patterns" @click="onPatternSelected(image)">

                            </div>
                        </div>
                    </div>
                    <div class="modal-body" v-if="tab==='gradients'">
                        <div class="image-search-results">
                            <div class="image-search-item" :style="{'background-image': 'url(' + gradients_base_url + image + ')'}" v-for="image in gradients" @click="onGradientSelected(image)">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body text-center py-4 px-4 _fs16" v-if="!uploading && tab==='upload'">
                        <app-file-uploader v-if="tab==='upload'" :extensions="'.jpeg, .png, .gif'" accept="image/jpeg, image/png, image/gif, image/svg+xml" :max-size="16" type="photos" @done="onImageSelected($event)"></app-file-uploader>
                    </div>
                    <div v-if="uploading">
                        <div class="d-flex _jcc my-6">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <script type="3eab436ace7728c68e812583-text/javascript">
        var __e = {};

        __e['upgradeText1'] = 'Tu post tiene <strong>{0}</strong> comentarios';
        __e['upgradeText2'] = 'Puedes realizar sorteos en Instagram hasta <strong>{0}</strong> comentarios totalmente gratis. Desbloquea este sorteo y realízalo de inmediato por tan solo';

        __e['ERROR_DUPLICATED_URL'] = 'La URL está duplicada, por favor elimínala.';
        __e['ERROR_INVALID_URL'] = 'La URL es inválida.';
        __e['ERROR_NOT_FOUND'] = 'No pudimos leer la URL';
        __e['ERROR_COMMENTS_DISABLED'] = 'Esta publicación de Instagram tiene los comentarios deshabilitados, por favor actívalos para comenzar.';
        __e['wheel_add_options'] = 'Agrega al menos 2 opciones';
        __e['copied'] = '¡Copiado!';
        __e['copy'] = 'Copiar';
    </script>
    <script type="3eab436ace7728c68e812583-text/javascript">
        var country = 'MX';
        var locale = 'es';
        var free_user_experiment_version = 1;
        var fb_app_id = '726650182249383';
        var fb_app_version = 'v16.0';
        var free_limit = '750';
        var free_limit_tiktok = '300';
        var free_limit_youtube = '10000';
        var free_limit_twitter_rt = '10000';
        var hasError = window.location.href.indexOf('?error=') !== -1;
        var hasErrorComments = window.location.href.indexOf('?error=comments_limit') !== -1;
        var hasErrorInfo = window.location.href.indexOf('?error=invalid_info') !== -1;
        var hasErrorCommentsDisabled = window.location.href.indexOf('?error=comments_disabled') !== -1;
        var facebook_login_access_token = '';
        var twitter_login_access_token = '';

        var SHARED_DATA = {
            apps: [{
                "type": "instagram",
                "icon": "fab fa-instagram",
                "name": "Sorteo en Instagram",
                "name_short": "Instagram",
                "desc": "Escoge un comentario ganador de tus fotos",
                "category": "giveaways",
                "recommended": true,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "facebook",
                "icon": "fab fa-facebook",
                "name": "Sorteo en Facebook",
                "name_short": "Facebook",
                "desc": "Escoge un comentario ganador de tus posts",
                "category": "giveaways",
                "recommended": true,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "random-name",
                "icon": "fas fa-list-ol",
                "name": "Listado de Nombres",
                "name_short": "Random Name",
                "desc": "Escoge un ganador de un listado de nombres",
                "category": "giveaways",
                "recommended": false,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "twitter",
                "icon": "fab fa-twitter",
                "name": "Sorteo en Twitter",
                "name_short": "Twitter",
                "desc": "Escoge ganadores entre tus seguidores y RT\u2019s",
                "category": "giveaways",
                "recommended": true,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "multinetwork",
                "icon": "fas fa-share-alt",
                "name": "Sorteo Multi-Red",
                "name_short": "Multi-Network",
                "desc": "Escoge ganadores combinando posts de diferentes redes sociales",
                "category": "giveaways",
                "recommended": false,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "tiktok",
                "icon": "fab fa-tiktok",
                "name": "Sorteo en TikTok",
                "name_short": "Tiktok",
                "desc": "Escoge un comentario ganador de tus videos de TikTok",
                "category": "giveaways",
                "recommended": true,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "wheel",
                "icon": "fal fa-dharmachakra",
                "name": "Ruleta Aleatoria",
                "name_short": "Wheel",
                "desc": "\u00a1Gira la ruleta y escoge un ganador!",
                "category": "promotions",
                "recommended": true,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "trivia",
                "icon": "fas fa-question",
                "name": "Generador de Trivias",
                "name_short": "Trivia",
                "desc": "Crea simples trivias (preguntas y repuestas) para compartir",
                "category": "promotions",
                "recommended": false,
                "can_save_results": true,
                "is_top_app": false
            }, {
                "type": "dice",
                "icon": "fas fa-dice",
                "name": "Dados Virtuales",
                "name_short": "Dados Virtuales",
                "desc": "Tira los dados online con este simulador de dados",
                "category": "other",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }, {
                "type": "random-teams",
                "icon": "fas fa-random",
                "name": "Generador de Equipos",
                "name_short": "Random Teams",
                "desc": "Divide una lista de participantes en grupos aleatorios",
                "category": "other",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }, {
                "type": "youtube",
                "icon": "fab fa-youtube",
                "name": "Sorteo en YouTube",
                "name_short": "Youtube",
                "desc": "Escoge un comentario ganador de tus videos",
                "category": "giveaways",
                "recommended": false,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "random-numbers",
                "icon": "fas fa-sort-numeric-up",
                "name": "N\u00fameros Aleatorios",
                "name_short": "N\u00fameros Aleatorios",
                "desc": "Genera una secuencia de N\u00fameros Aleatorios",
                "category": "other",
                "recommended": false,
                "can_save_results": true,
                "is_top_app": true
            }, {
                "type": "igfonts",
                "icon": "fas fa-font-case",
                "name": "Generador de Letras",
                "name_short": "Generador de Letras",
                "desc": "Letras divertidas para copiar y pegar en Instagram",
                "category": "other",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }, {
                "type": "coins",
                "icon": "fal fa-coin",
                "name": "Lanza una Moneda",
                "name_short": "Lanza una Moneda",
                "desc": "Lanza una moneda al aire para tomar decisiones. \u00bfCara o Cruz?",
                "category": "other",
                "recommended": false,
                "can_save_results": false
            }, {
                "type": "entry-form",
                "icon": "fal fa-gift",
                "name": "Sorteo con Registro",
                "name_short": "Sorteo con Registro",
                "desc": "Obtain leads from a customized entry form",
                "category": "giveaways",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }, {
                "type": "terms-gen",
                "icon": "fal fa-signature",
                "name": "Generador de Bases Legales",
                "name_short": "Bases Legales",
                "desc": "Crea bases legales para tus promociones",
                "category": "utilities",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }, {
                "type": "engagement",
                "icon": "fas fa-heart-circle",
                "name": "Calculadora de Engagement para Instagram",
                "name_short": "Calculadora de Engagement",
                "desc": "Obtain leads from a customized entry form",
                "category": "utilities",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }, {
                "type": "hashtag",
                "icon": "far fa-hashtag",
                "name": "Generador de Hashtags",
                "name_short": "Generador de Hashtags",
                "desc": "Obtain leads from a customized entry form",
                "category": "utilities",
                "recommended": false,
                "can_save_results": false,
                "is_top_app": false
            }],
            links: {
                "check": "\/es\/verificar-resultados",
                "apps": "\/es\/apps",
                "youtube": "\/es\/apps\/sorteo-youtube",
                "twitter": "\/es\/apps\/sorteo-twitter",
                "instagram": "\/es\/apps\/sorteo-instagram",
                "facebook": "\/es\/apps\/sorteo-facebook",
                "tiktok": "\/es\/apps\/sorteo-tiktok",
                "ig_multi": "\/es\/apps\/sorteo-instagram-multi-cuentas",
                "ig_legacy": "\/es\/apps\/sorteo-instagram-multicuenta",
                "names": "\/es\/apps\/sorteados",
                "random": "\/es\/apps\/sorteados",
                "random-name": "\/es\/apps\/sorteados",
                "wheel": "\/es\/apps\/la-ruleta-decide",
                "dice": "\/es\/apps\/tirar-dado-online",
                "random-teams": "\/es\/apps\/sortear-grupos-online",
                "random-numbers": "\/es\/apps\/sortear-numeros-online",
                "trivia": "\/es\/apps\/generador-trivias-online",
                "multinetwork": "\/es\/apps\/sorteo-combinado-instagram-facebook",
                "engagement": "\/es\/apps\/calculadora-de-engagement",
                "hashtag": "\/es\/apps\/generador-de-hashtags",
                "spin-the-wheel": "\/es\/ruleta-aleatoria",
                "word-counter": "\/es\/apps\/contador-de-palabras",
                "igfonts": "\/es\/apps\/letras-para-instagram",
                "coins": "\/es\/apps\/cara-o-cruz",
                "terms-gen": "\/es\/apps\/generador-bases-legales",
                "post1": "\/es\/blog\/como-hacer-sorteos-en-instagram",
                "post2": "\/es\/blog\/como-obtener-la-url-de-una-foto-de-instagram",
                "post3": "\/es\/blog\/sorteos-multi-cuentas-instagram",
                "post4": "\/es\/blog\/como-filtrar-comentarios-en-mi-sorteo-de-instagram",
                "certs": "\/es\/certificacion-app-sorteos",
                "pricing": "\/es\/precios",
                "plans": "\/es\/planes",
                "support": "\/es\/soporte",
                "faqs": "\/es\/faqs",
                "blog": "\/es\/blog",
                "login": "\/es\/login",
                "signup": "\/es\/signup",
                "terms": "\/es\/terminos-y-condiciones",
                "privacy": "\/es\/politicas-de-privacidad",
                "affiliates": "\/es\/referidos"
            },
            user: null,
            features: [],
            available_plans: [{
                "id": 62,
                "name": "Starter",
                "name_long": "Starter Monthly",
                "slug": "starter_v3",
                "type": "month",
                "price": 9,
                "currency": "USD",
                "stripe_pricing_id": "price_1NVT0GCSS91wKgVl5Mon61Aj",
                "visible": true,
                "country": "all",
                "created": "2023-07-19T05:32:49+00:00",
                "modified": "2023-07-19T05:32:49+00:00",
                "features": {
                    "INSTAGRAM_COMMENTS_LIMIT": 2000,
                    "TIKTOK_COMMENTS_LIMIT": 2000,
                    "MUTINETWORK_GIVEAWAYS": 0,
                    "PROMOTIONS_PAGE_VIEWS": 500,
                    "PROMOTIONS_ACTIVE_CAMPAINGS": 2,
                    "PROMOTIONS_NO_BRANDING": 0
                }
            }, {
                "id": 72,
                "name": "Creator",
                "name_long": "Creator Monthly",
                "slug": "creator_v3",
                "type": "month",
                "price": 19,
                "currency": "USD",
                "stripe_pricing_id": "price_1NVT0OCSS91wKgVlM21SbRe0",
                "visible": true,
                "country": "all",
                "created": "2023-07-19T05:32:56+00:00",
                "modified": "2023-07-19T05:32:56+00:00",
                "features": {
                    "INSTAGRAM_COMMENTS_LIMIT": 5000,
                    "TIKTOK_COMMENTS_LIMIT": 5000,
                    "MUTINETWORK_GIVEAWAYS": 5000,
                    "PROMOTIONS_PAGE_VIEWS": 3500,
                    "PROMOTIONS_ACTIVE_CAMPAINGS": 5,
                    "PROMOTIONS_NO_BRANDING": 0
                }
            }, {
                "id": 82,
                "name": "Agency",
                "name_long": "Agency Monthly",
                "slug": "agency_v3",
                "type": "month",
                "price": 49,
                "currency": "USD",
                "stripe_pricing_id": "price_1NVT0UCSS91wKgVlVC8dSiwu",
                "visible": true,
                "country": "all",
                "created": "2023-07-19T05:33:02+00:00",
                "modified": "2023-07-19T05:33:02+00:00",
                "features": {
                    "INSTAGRAM_COMMENTS_LIMIT": 999999,
                    "TIKTOK_COMMENTS_LIMIT": 999999,
                    "MUTINETWORK_GIVEAWAYS": 999999,
                    "PROMOTIONS_PAGE_VIEWS": 25000,
                    "PROMOTIONS_ACTIVE_CAMPAINGS": 10,
                    "PROMOTIONS_NO_BRANDING": 1
                }
            }, {
                "id": 63,
                "name": "Starter",
                "name_long": "Starter Yearly",
                "slug": "starter_v3",
                "type": "year",
                "price": 84,
                "currency": "USD",
                "stripe_pricing_id": "price_1NVT0HCSS91wKgVlRqROi8Q9",
                "visible": true,
                "country": "all",
                "created": "2023-07-19T05:32:50+00:00",
                "modified": "2023-07-19T05:32:50+00:00",
                "features": {
                    "INSTAGRAM_COMMENTS_LIMIT": 2000,
                    "TIKTOK_COMMENTS_LIMIT": 2000,
                    "MUTINETWORK_GIVEAWAYS": 0,
                    "PROMOTIONS_PAGE_VIEWS": 500,
                    "PROMOTIONS_ACTIVE_CAMPAINGS": 2,
                    "PROMOTIONS_NO_BRANDING": 0
                }
            }, {
                "id": 73,
                "name": "Creator",
                "name_long": "Creator Yearly",
                "slug": "creator_v3",
                "type": "year",
                "price": 180,
                "currency": "USD",
                "stripe_pricing_id": "price_1NVT0OCSS91wKgVl3V0QqnV5",
                "visible": true,
                "country": "all",
                "created": "2023-07-19T05:32:56+00:00",
                "modified": "2023-07-19T05:32:56+00:00",
                "features": {
                    "INSTAGRAM_COMMENTS_LIMIT": 5000,
                    "TIKTOK_COMMENTS_LIMIT": 5000,
                    "MUTINETWORK_GIVEAWAYS": 5000,
                    "PROMOTIONS_PAGE_VIEWS": 3500,
                    "PROMOTIONS_ACTIVE_CAMPAINGS": 5,
                    "PROMOTIONS_NO_BRANDING": 0
                }
            }, {
                "id": 83,
                "name": "Agency",
                "name_long": "Agency Yearly",
                "slug": "agency_v3",
                "type": "year",
                "price": 480,
                "currency": "USD",
                "stripe_pricing_id": "price_1NVT0UCSS91wKgVllH41l5ku",
                "visible": true,
                "country": "all",
                "created": "2023-07-19T05:33:03+00:00",
                "modified": "2023-07-19T05:33:03+00:00",
                "features": {
                    "INSTAGRAM_COMMENTS_LIMIT": 999999,
                    "TIKTOK_COMMENTS_LIMIT": 999999,
                    "MUTINETWORK_GIVEAWAYS": 999999,
                    "PROMOTIONS_PAGE_VIEWS": 25000,
                    "PROMOTIONS_ACTIVE_CAMPAINGS": 10,
                    "PROMOTIONS_NO_BRANDING": 1
                }
            }],
            locale: 'es',
        };

        var SITE_URL = 'https://app-sorteos.com';
        var EXTENSION_ID = 'iedifognpinkpfaemlnnniomklocpcnh';
        var CDN_URL = 'https://as-media-upload.us-east-1.linodeobjects.com/';
        var signup_event_dispatched = 0;
        if (mixpanel && SHARED_DATA.user && SHARED_DATA.user.id) {
            if (signup_event_dispatched) {
                mixpanel.alias(SHARED_DATA.user.id);
            } else {
                mixpanel.identify(SHARED_DATA.user.id);
            }
        }
    </script>

    <script src="app_ruleta/i18n/es.js?1692721001" defer="defer" type="3eab436ace7728c68e812583-text/javascript"></script>
    <script src="app_ruleta/js/all.front.compiled.js?1692721005" defer="defer" type="3eab436ace7728c68e812583-text/javascript"></script>

    <script type="3eab436ace7728c68e812583-text/javascript">
        __WHEEL_DATA__ = [];
        __SAVED_WHEELS__ = [];
    </script>

    <script src="app_ruleta/js/all.wheel.v2.compiled.js?1692721006" defer="defer" type="3eab436ace7728c68e812583-text/javascript"></script>

    <div class="modal dash" tabindex="-1" role="dialog" id="alertModal">
        <div class="modal-dialog modal-dialog-top modal-md" id="js-alert-modal__dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0;">
                    <h5 class="modal-title _fs20" id="js-alert-modal__title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="js-alert-modal__close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="64" height="64" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg> </button>
                </div>
                <div id="js-alert-modal__body" class="modal-body px-4 pt-1 pb-4">
                    <p class="mb-0 pb-0" id="js-alert-modal__text"></p>
                    <div class="form-check mt-3" id="js-alert-modal__check">
                        <input class="form-check-input" type="checkbox" value="1" id="js-alert-modal__check-input">
                        <label class="form-check-label" for="js-alert-modal__check-input">
                            Acepto eliminar permanentemente </label>
                    </div>
                    <a class="btn btn-primary btn-lg px-5 mt-4 mb-3" id="js-alert-modal__link" target="_blank"></a>
                </div>
                <div id="js-alert-modal__loader" class="pt-4 pb-5 modal-body _df _aic _jcc">
                    <div class="loader"></div>
                </div>
                <div class="modal-footer" id="js-alert-modal__footer">
                    <div class="_df w-100 _jce">
                        <button class="btn btn-light" data-dismiss="modal" id="js-alert-modal__cancel">Cancelar</button>
                        <button class="btn btn-primary ml-3" id="js-alert-modal__ok">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal dash" tabindex="-1" role="dialog" id="errorModalInfo">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post no encontrado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="64" height="64" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg> </button>
                </div>
                <div class="modal-body text-center px-5 _fs16">
                    <img src="app_ruleta/img/svg/undraw_taken.svg" width="120" class="mb-4" alt="">
                    <p>Posiblemente tienes una <strong>Cuenta Privada</strong>, o tienes una <strong>Restricción de Edad Mínima</strong> para tu cuenta.</p>
                    <p class="text-secondary">Cambia tu perfil a Público o elimina la Restricción de Edad, e intenta nuevamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg btn-blaock" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal dash" tabindex="-1" role="dialog" id="errorNoComments">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Oops!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="64" height="64" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg> </button>
                </div>
                <div class="modal-body text-center p-5">
                    <p class="mb-0 pb-0">Este post no tiene comentarios. Realiza el sorteo cuando este haya finalizado y todos tus seguidores hayan participado.</p>
                </div>

            </div>
        </div>
    </div>
    <div class="modal dash" tabindex="-1" role="dialog" id="errorGenericModal">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detectamos algunos errores!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="64" height="64" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg> </button>
                </div>
                <div id="errors_display" class="px-4 pb-4 pt-0">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg py-2 px-4 btn-bold" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <script async="" src="app_ruleta/assets/stpdwrapper.js" crossorigin="anonymous" type="3eab436ace7728c68e812583-text/javascript"></script>
    <script type="3eab436ace7728c68e812583-text/javascript">
        mixpanel.track("AS_ViewTheWheelLanding");
    </script>
    <script type="3eab436ace7728c68e812583-text/javascript">
        var upgradeMetadata = {};
    </script>
    <script src="app_ruleta/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="3eab436ace7728c68e812583-|49" defer=""></script>
    <?php
    include 'include/menujs.php';


    ?>

    <!-- Listo -->
    <footer class="text-center py-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <p class="text-muted my-2">Pagina Creada por <b>Wichy Alonzo <?php echo date('Y'); ?></b></p>
                </div>
                <div class="col">
                    <ul class="list-inline my-2 text-center">
                        <?php
                        if (!empty($facebook)) { ?>
                            <li class="list-inline-item me-4">
                                <a href="<?php echo $facebook; ?>" target="blank">
                                    <div class="bs-icon-circle comprar bs-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </li>
                        <?php }
                        if (!empty($twitter)) { ?>
                            <li class="list-inline-item me-4">
                                <a href="<?php echo $twitter; ?>" target="blank">
                                    <div class="bs-icon-circle comprar bs-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="list-inline-item me-4">
                            <a href="https://wa.me/<?php echo $_SESSION['whatsApp']; ?>" target="blank">
                                <div class="bs-icon-circle comprar bs-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-whatsapp">
                                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
                                    </svg>
                                </div>
                            </a>
                        </li>
                        <?php
                        if (!empty($youtube)) { ?>
                            <li class="list-inline-item me-4">
                                <a href="<?php echo $youtube; ?>" target="blank">
                                    <div class="bs-icon-circle comprar bs-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-youtube">
                                            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (!empty($instagram)) { ?>
                            <li class="list-inline-item me-4">
                                <a href="<?php echo $instagram; ?>" target="blank">
                                    <div class="bs-icon-circle comprar bs-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                                        </svg>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-inline my-2">
                        <li class="list-inline-item">
                            <a class="link-secondary" href="<?php echo $linkRifas ?>" style="color: rgb(0,41,255)!important;"><strong>⚠️ Quiero mi pagina ⚠️</strong></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <ul class="list-inline my-2">
                        <li class="list-inline-item"><a class="link-secondary" href="<?php echo $urlPartner; ?>aviso" style="color: #212f5a !important;font-weight: 700;">Privacidad del Usuario</a></li>
                        <!-- <li class="list-inline-item"><a class="link-secondary" href="<?php echo $urlPartner; ?>aviso" style="color: #212f5a !important;font-weight: 700;">Terminos y condiciones</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-12">
                    <div class="col">
                        <ul class="list-inline my-2">
                            <li class="list-inline-item" style="font-weight: 700;color: #7d7d7d;">v. 2024.01.8102 {compiler: 14:12:23}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
</body>

</html>