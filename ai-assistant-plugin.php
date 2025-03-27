<?php
/*
Plugin Name: OpenAI Assistant
Plugin URI: https://www.seusite.com/wordpress-openai-assistant/
Description: Integração de assistente de IA com Elementor usando OpenAI para geração de conteúdo e respostas inteligentes.
Version: 1.0.0
Author: João Paulo
Author URI: https://www.macsym.com.br/
Text Domain: openai-assistant
Domain Path: /translation
License: GPL2
== Copyright ==
Copyright 2024 Seu Nome (www.seusite.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes do plugin
define('OPENAI_ASSISTANT_VERSION', '1.0.0');
define('OPENAI_ASSISTANT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('OPENAI_ASSISTANT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Incluir arquivos necessários
require_once OPENAI_ASSISTANT_PLUGIN_DIR . 'includes/class-openai-assistant.php';

// Inicializar o plugin
function openai_assistant_init() {
    // Inicialização do plugin
    OpenAIAssistant::get_instance();
}
add_action('plugins_loaded', 'openai_assistant_init');

// Registro de widget do Elementor
function register_openai_assistant_elementor_widget($widgets_manager) {
    require_once OPENAI_ASSISTANT_PLUGIN_DIR . 'includes/class-elementor-widget.php';
    $widgets_manager->register(new OpenAI_Assistant_Elementor_Widget());
}
add_action('elementor/widgets/register', 'register_openai_assistant_elementor_widget');

// Ativar plugin
function openai_assistant_activate() {
    // Verificações de ativação
    if (!current_user_can('activate_plugins')) {
        return;
    }
}
register_activation_hook(__FILE__, 'openai_assistant_activate');

// Desativar plugin
function openai_assistant_deactivate() {
    // Limpeza ao desativar
    if (!current_user_can('activate_plugins')) {
        return;
    }
}
register_deactivation_hook(__FILE__, 'openai_assistant_deactivate');