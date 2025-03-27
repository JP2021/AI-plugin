jQuery(document).ready(function($) {
    $('.ai-assistant-submit').on('click', function() {
        const input = $(this).siblings('.ai-assistant-input');
        const responseContainer = $(this).siblings('.ai-assistant-response');
        const prompt = input.val();

        if (!prompt) return;

        responseContainer.html('Carregando...');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'ai_assistant_generate_response',
                prompt: prompt
            },
            success: function(response) {
                responseContainer.html(response);
            },
            error: function() {
                responseContainer.html('Erro ao processar a solicitação');
            }
        });
    });
});