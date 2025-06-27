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
    console.log("DOM carregado");

    const categoriaSelect = document.getElementById('categoria');
    const subcategoriaGroup = document.getElementById('subcategoria-group');
    const subcategoriaSelect = document.getElementById('subcategoria');

    if (!categoriaSelect || !subcategoriaGroup || !subcategoriaSelect) {
        console.warn("Elemento(s) de categoria/subcategoria não encontrado(s) nesta página.");
        return;
    }

    categoriaSelect.addEventListener('change', function () {
        const categoria = this.value;
        console.log("Categoria selecionada:", categoria);

        if (categoria !== '') {
            fetch(`./php/subcategorias.php?categoria=${categoria}`)
    .then(response => {
        if (!response.ok) throw new Error('Erro na rede');
        return response.text();
    })
    .then(data => {
        console.log('Dados recebidos:', data);
        if (data.trim() === "") {
            console.warn("Nenhuma subcategoria retornada");
            subcategoriaSelect.innerHTML = '<option value="">Nenhuma subcategoria disponível</option>';
        } else {
            subcategoriaSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>' + data;
        }
        subcategoriaGroup.style.display = 'block';
    })
                .catch(error => {
                    console.error('Erro ao buscar subcategorias:', error);
                });
        } else {
            subcategoriaSelect.innerHTML = '<option value="">Selecione uma subcategoria</option>';
            subcategoriaGroup.classList.remove('hidden');
        }
    });
});
