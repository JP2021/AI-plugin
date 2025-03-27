<?php
class AIAssistant {
    private $api_key;

    public function __construct() {
        $this->api_key = get_option('openai_api_key');
    }

    public function generate_response($prompt) {
        $response = wp_remote_post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->api_key
            ],
            'body' => json_encode([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 150
            ])
        ]);

        if (is_wp_error($response)) {
            return 'Erro na comunicação com a API';
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        return $data['choices'][0]['message']['content'] ?? 'Sem resposta';
    }
}