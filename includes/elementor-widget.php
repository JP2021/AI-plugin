<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class AIAssistantElementorWidget extends Widget_Base {
    public function get_name() {
        return 'ai_assistant_widget';
    }

    public function get_title() {
        return 'Assistente de IA';
    }

    public function get_icon() {
        return 'eicon-chatbot';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Configurações', 'ai-assistant'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'placeholder_text',
            [
                'label' => __('Texto do Placeholder', 'ai-assistant'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Faça uma pergunta...',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ai-assistant-widget">
            <input 
                type="text" 
                class="ai-assistant-input" 
                placeholder="<?php echo esc_attr($settings['placeholder_text']); ?>"
            >
            <button class="ai-assistant-submit">Enviar</button>
            <div class="ai-assistant-response"></div>
        </div>
        <?php
    }
}