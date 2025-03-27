<?php
class AIAssistantAdminSettings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'AI Assistant', 
            'AI Assistant', 
            'manage_options', 
            'ai-assistant', 
            [$this, 'render_admin_page']
        );
    }

    public function register_settings() {
        register_setting('ai_assistant_options', 'openai_api_key');
        
        add_settings_section(
            'ai_assistant_main_section', 
            'Configurações Principais', 
            [$this, 'main_section_callback'], 
            'ai-assistant'
        );

        add_settings_field(
            'openai_api_key', 
            'Chave da API OpenAI', 
            [$this, 'openai_api_key_callback'], 
            'ai-assistant', 
            'ai_assistant_main_section'
        );
    }

    public function main_section_callback() {
        echo '<p>Configure as configurações principais do seu assistente de IA</p>';
    }

    public function openai_api_key_callback() {
        $api_key = get_option('openai_api_key');
        echo '<input type="password" name="openai_api_key" value="' . esc_attr($api_key) . '" class="regular-text">';
    }

    public function render_admin_page() {
        ?>
        <div class="wrap">
            <h1>AI Assistant - Configurações</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('ai_assistant_options');
                do_settings_sections('ai-assistant');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}