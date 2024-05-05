// contato.script.js

// Função para validar o formulário antes de enviar
function validateForm() {
    const fullName = document.getElementById('full-name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    // Exemplo de validação simples (pode ser personalizado conforme necessário)
    if (!fullName || !email || !phone) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return false;
    }

    // Mais validações podem ser adicionadas aqui

    return true;
}

// Event listener para o envio do formulário
document.getElementById('contact-form').addEventListener('submit', function (event) {
    if (!validateForm()) {
        event.preventDefault(); // Impede o envio se o formulário não for válido
    }
});

