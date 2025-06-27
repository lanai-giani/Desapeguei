/*---------------------------------celular----------------------------------*/
var menuItens = document.getElementById("menuItens");
menuItens.style.maxHeight = "0px"

function menuCelular(){
    if(menuItens.style.maxHeight == "0px"){
        menuItens.style.maxHeight = "200px";
    }else{
        menuItens.style.maxHeight = "0px";
    }
}






/*----------------------carrosel e botões-----------------------------------------------------*/
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');
    const categorias = document.querySelectorAll('.col-3.categoria-img');
    let currentIndex = 0;
    const itemsPerPage = 4;

    function updateCarousel() {
        // Esconde todas as categorias
        categorias.forEach(cat => cat.classList.add('hidden-categoria'));
        
        // Mostra apenas as 4 categorias atuais
        for (let i = currentIndex; i < currentIndex + itemsPerPage; i++) {
            if (categorias[i]) {
                categorias[i].classList.remove('hidden-categoria');
            }
        }

        // Atualiza visibilidade dos botões
        prevBtn.classList.toggle('hidden', currentIndex === 0);
        nextBtn.classList.toggle('hidden', currentIndex >= categorias.length - itemsPerPage);
    }

    nextBtn.addEventListener('click', function() {
        if (currentIndex < categorias.length - itemsPerPage) {
            currentIndex += itemsPerPage;
            updateCarousel();
        }
    });

    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex -= itemsPerPage;
            updateCarousel();
        }
    });
    updateCarousel();
});









/*--------------------------------------- Verificação se está logado para vender--------------------------------*/

function verificarLogin() {
    return localStorage.getItem('usuarioLogado') === 'true';
}

// Controle do botão Vender
document.getElementById('btnVender').addEventListener('click', function(e) {
    e.preventDefault();
    
    if (verificarLogin()) {
        window.location.href = 'vender.html';
    } else {
        // Mostra modal ou redireciona
        const confirmar = confirm('Para vender, você precisa estar logado. Deseja fazer login agora?');
        if (confirmar) {
            window.location.href = 'cadastro.html?redirect=vender';
        }
    }
});



/*------------------------validação senha pra ver se é igual--------------------------*/
document.getElementById('btnCadastro').addEventListener('click', function(event) {
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmar-senha').value;
    
    if (senha !== confirmarSenha) {
        event.preventDefault();
        alert('As senhas não coincidem!');
    }
});

/*------------------------subcategorias--------------------------*/
// Validação de senha no cadastro
const botaoCadastro = document.getElementById('btnCadastro');
if (botaoCadastro) {
    botaoCadastro.addEventListener('click', function (event) {
        const senha = document.getElementById('senha').value;
        const confirmarSenha = document.getElementById('confirmar-senha').value;

        if (senha !== confirmarSenha) {
            event.preventDefault();
            alert('As senhas não coincidem!');
        }
    });
}

/*------------------------ subcategorias --------------------------*/
document.addEventListener('DOMContentLoaded', function () {
    const categoriaSelect = document.getElementById('categoria');
    const subcategoriaGroup = document.getElementById('subcategoria-group');
    const subcategoriaSelect = document.getElementById('subcategoria');

    if (!categoriaSelect || !subcategoriaGroup || !subcategoriaSelect) {
        console.warn("Elemento(s) de categoria/subcategoria não encontrado(s) nesta página.");
        return;
    }

    subcategoriaGroup.classList.add('hidden');

    categoriaSelect.addEventListener('change', function () {
        const categoria = this.value;

        if (categoria !== '') {
            // Dados estáticos para teste
            const subcategorias = {
                'vestuario': ['Camiseta', 'Vestido', 'Jaqueta', 'Calça'],
                'calcados': ['Rasteirinha', 'Chinelo', 'Tênis', 'Bota'],
                'eletronicos': ['Celular', 'Notebook', 'Tablet', 'Fones de ouvido'],
                'bolsas': ['Bolsa de mão', 'Mochila', 'Pochete'],
                'livros': ['Romance', 'Terror', 'Autoajuda', 'Didático'],
                'beleza': ['Maquiagem', 'Skincare', 'Cabelo'],
                'acessorios': ['Relógio', 'Óculos', 'Bijuteria'],
                'kids': ['Roupas infantis', 'Brinquedos', 'Carrinhos']
            };

            if (subcategorias[categoria]) {
                subcategoriaSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>';
                subcategorias[categoria].forEach(function(sub) {
                    const option = document.createElement('option');
                    option.value = sub.toLowerCase().replace(' ', '_');
                    option.textContent = sub;
                    subcategoriaSelect.appendChild(option);
                });
                subcategoriaGroup.classList.remove('hidden');
            } else {
                subcategoriaSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>';
                subcategoriaGroup.classList.add('hidden');
            }
        } else {
            subcategoriaSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>';
            subcategoriaGroup.classList.add('hidden');
        }
    });
});
