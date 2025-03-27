<?php
/**
 * Plugin Name: AI Assistant para WordPress
 * Description: Integração de assistente de IA com Elementor
 * Version: 1.0.0
 * Author: Seu Nome
 */

// Impedir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

// Incluir arquivos necessários
require_once plugin_dir_path(__FILE__) . 'admin/class-admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-ai-assistant.php';
require_once plugin_dir_path(__FILE__) . 'includes/elementor-widget.php';

// Carregar dependências
function ai_assistant_load_dependencies() {
    // Carregar bibliotecas ou dependências adicionais, se necessário
}
add_action('plugins_loaded', 'ai_assistant_load_dependencies');

// Inicializar configurações de admin
function ai_assistant_init_admin() {
    new AIAssistantAdminSettings();
}
add_action('admin_init', 'ai_assistant_init_admin');

// Registrar widget do Elementor
function register_ai_assistant_elementor_widget($widgets_manager) {
    $widgets_manager->register(new AIAssistantElementorWidget());
}
add_action('elementor/widgets/register', 'register_ai_assistant_elementor_widget');