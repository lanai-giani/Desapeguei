/*---------------------------------celular----------------------------------*/
var menuItens = document.getElementById("menuItens");
menuItens.style.maxHeight = "0px"

function menuCelular(){
    if(menuItens.style.maxHeight == "0px"){
        menuItens.style.maxHeight = "200px";
    } else {
        menuItens.style.maxHeight = "0px";
    }
}


/*----------------------carrossel e botões------------------------*/
document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');
    const categorias = document.querySelectorAll('.col-3.categoria-img');
    let currentIndex = 0;
    const itemsPerPage = 4;

    if (nextBtn && prevBtn && categorias.length > 0) {
        function updateCarousel() {
            categorias.forEach(cat => cat.classList.add('hidden-categoria'));
            for (let i = currentIndex; i < currentIndex + itemsPerPage; i++) {
                if (categorias[i]) {
                    categorias[i].classList.remove('hidden-categoria');
                }
            }

            prevBtn.classList.toggle('hidden', currentIndex === 0);
            nextBtn.classList.toggle('hidden', currentIndex >= categorias.length - itemsPerPage);
        }

        nextBtn.addEventListener('click', function () {
            if (currentIndex < categorias.length - itemsPerPage) {
                currentIndex += itemsPerPage;
                updateCarousel();
            }
        });

        prevBtn.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex -= itemsPerPage;
                updateCarousel();
            }
        });

        updateCarousel();
    }
});


/*----------------------verificação login botão vender------------------------*/
function verificarLogin() {
    return localStorage.getItem('usuarioLogado') === 'true';
}

const btnVender = document.getElementById('btnVender');
if (btnVender) {
    btnVender.addEventListener('click', function (e) {
        e.preventDefault();

        if (verificarLogin()) {
            window.location.href = 'vender.html';
        } else {
            const confirmar = confirm('Para vender, você precisa estar logado. Deseja fazer login agora?');
            if (confirmar) {
                window.location.href = 'cadastro.html?redirect=vender';
            }
        }
    });
}


/*----------------------validação de senha no cadastro------------------------*/
const btnCadastro = document.getElementById('btnCadastro');
if (btnCadastro) {
    btnCadastro.addEventListener('click', function(event) {
        const senha = document.getElementById('senha').value;
        const confirmarSenha = document.getElementById('confirmar-senha').value;
        
        if (senha !== confirmarSenha) {
            event.preventDefault();
            alert('As senhas não coincidem!');
        }
    });
}


/*----------------------subcategorias dinâmicas------------------------*/
document.addEventListener('DOMContentLoaded', function () {
    const subcategoriasPorCategoria = {
        'vestuario': ['Camisa', 'Vestido', 'Jaqueta', 'Calça', 'Short','Saia', 'Outro'],
        'calcados': ['Chinela', 'Bota', 'Salto', 'Tênis', 'Sapatilha', 'Outro'],
        'eletronicos': ['Celular', 'Notebook', 'TV', 'Fone', 'Acessórios', 'Outro'],
        'bolsas': ['Mochila', 'Bolsa de mão', 'Bolsa transversal', 'Carteira', 'Mala', 'Outro'],
        'livros': ['Romance', 'Ficção', 'Didático', 'HQ', 'Biografia','Terror', 'Outro'],
        'beleza': ['Maquiagem', 'Cabelo', 'Perfume', 'Skincare', 'Outro'],
        'acessorios': ['Relógio', 'Óculos', 'Brinco', 'Colar','Cinto','Joias', 'Outro'],
        'kids': ['Macacão', 'Brinquedos', 'Calçados Infantis','Vestido', 'Calça','Blusa','Casaco','Body', 'Outro']
    };

    const categoriaSelect = document.getElementById('categoria');
    const subcategoriaSelect = document.getElementById('subcategoria');

    if (categoriaSelect && subcategoriaSelect) {
        categoriaSelect.addEventListener('change', function () {
            const categoriaSelecionada = this.value;
            const subcategorias = subcategoriasPorCategoria[categoriaSelecionada] || [];

            subcategoriaSelect.innerHTML = '<option value="">Selecione...</option>';

            subcategorias.forEach(function (subcat) {
                const option = document.createElement('option');
                option.value = subcat
                    .toLowerCase()
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(/ /g, '_');
                option.textContent = subcat;
            subcategoriaSelect.appendChild(option);
            });
        });
    }
});


/*----------------------verificação login botão ao add no carrinho------------------------*/
document.querySelectorAll('.form-adicionar').forEach(form => {
    form.addEventListener('submit', function (e) {
        if (!verificarLogin()) {
            e.preventDefault();
            const confirmar = confirm('Para adicionar ao carrinho, você precisa estar logado. Deseja fazer login agora?');
            if (confirmar) {
                window.location.href = '../cadastro.html?redirect=carrinho';
            }
        }
    });
});

const btnCarrinho = document.getElementById('btnCarrinho');
if (btnCarrinho) {
    btnCarrinho.addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = '../php/verifica_carrinho.php';
    });
}

/*----------------------google login------------------------*/
function handleGoogleLogin(response) {
    const idToken = response.credential;

    fetch('php/google_login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_token: idToken })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = '/desapeguei/index.php';
        } else {
            alert('Erro ao fazer login com Google: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(err => {
        console.error('Erro na requisição:', err);
        alert('Erro na comunicação com o servidor');
    });
}
