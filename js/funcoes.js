
//posiciona o conteudo em relação ao menu
if(document.title=="Mangakaz - ADMIN"){
    tamDashboard()
    window.onresize = function() {tamDashboard()};
    document.getElementById('sideBar').onresize = function() {tamDashboard();};

    //função responsável pelo carregamento
    setTimeout(carregar, 300);
    function carregar(){
        document.getElementById('overlayLoad').style.animation="load 0.2s forwards";
    }
}else{
    document.getElementById('conteudo').style.marginTop=document.getElementById("menu").offsetHeight+"px";
    window.onresize = function(){document.getElementById('conteudo').style.marginTop=document.getElementById("menu").offsetHeight+"px";};
    
    //animacoes do menu
    window.onscroll = function (){rolar()};

    function rolar(){
        menu()
        botaoSubir()
    }
}

var overlay = document.querySelectorAll('.overlay');

//função que estabelece a posição e largura do menu e do dashboard
function tamDashboard(){
    var barrasMenu = document.querySelectorAll('#btnMenu span');

    var tamBody = document.querySelector('html').offsetWidth;
    var largPagina = tamBody-document.getElementById("sideBar").offsetWidth+"px";
    
    barrasMenu[0].style.backgroundColor = "black";
    barrasMenu[0].style.rotate = "none";
    barrasMenu[1].style.display = 'block';
    barrasMenu[1].style.backgroundColor = 'black';
    barrasMenu[2].style.backgroundColor = "black";
    barrasMenu[2].style.rotate = "none";
    barrasMenu[2].style.top = "0px";

    if(tamBody>575){
        document.getElementById('itens').style.width=170+"px";
        document.getElementById('dashboard').style.marginLeft=document.getElementById("sideBar").offsetWidth+"px";
        document.getElementById('dashboard').style.width=largPagina;
    }else{
        document.getElementById('itens').style.width=0+"px";
        document.getElementById('dashboard').style.marginLeft="0px";
        document.getElementById('dashboard').style.width=tamBody+"px";
    }
    document.getElementById('dashboard').style.marginTop = document.getElementById("menu").offsetHeight+"px";
}

function abrirBarras(){

    var barrasMenu = document.querySelectorAll('#btnMenu span');

    if(document.getElementById('itens').offsetWidth==170){
        barrasMenu[0].style.backgroundColor = "black";
        barrasMenu[0].style.rotate = "none";
        barrasMenu[1].style.display = 'block';
        barrasMenu[1].style.backgroundColor = 'black';
        barrasMenu[2].style.backgroundColor = "black";
        barrasMenu[2].style.rotate = "none";
        barrasMenu[2].style.top = "0px";
    }else{
        barrasMenu[0].style.backgroundColor = "white";
        barrasMenu[0].style.rotate = "45deg";
        barrasMenu[1].style.display = 'none';
        barrasMenu[1].style.backgroundColor = 'white';
        barrasMenu[2].style.backgroundColor = "white";
        barrasMenu[2].style.rotate = "-45deg";
        barrasMenu[2].style.top = "-8px";
    }

}

//função que abre o menu lateral
function abreMenu(){

    if(document.getElementById('itens').offsetWidth==170){
        document.getElementById('itens').style.width=0+"px";
    }else{
        document.getElementById('itens').style.width=170+"px";
    }

    abrirBarras();
}

//função responsavel pelo modo noturno
var $element = document.querySelector('html');

function noturno() {
    if($element.classList.contains('darkmode')) {
        document.cookie = "theme=light";
    }else{
        document.cookie = "theme=dark";
    }

    $element.classList.toggle('darkmode')
}

//funcao que mostra as opçoes do botao
function botaoUsuario() {

    if(document.getElementById('opcoesUser').style.display != 'block') {
        document.getElementById('opcoesUser').style.display = 'block'
    }else{
        document.getElementById('opcoesUser').style.display = 'none'
    }
}

function botaoUsuario2() {

    if(document.getElementById('opcoesUser2').style.display != 'block') {
        document.getElementById('opcoesUser2').style.display = 'block'
    }else{
        document.getElementById('opcoesUser2').style.display = 'none'
    }
}

//funcao responsável por subir ou baixar o menu de acordo com o scroll
function menu() {

    var tamMenu = document.getElementById("menu").offsetHeight;
    var tamItensMenu = document.getElementById("itensMenu").offsetHeight;

    var t = -tamMenu + tamItensMenu

    document.getElementById("menu").style.transitionDuration = "0.2s"
    if(document.documentElement.scrollTop > tamMenu) {
        document.getElementById("menu").style.top = t + "px";
    }else if(document.documentElement.scrollTop < tamMenu * 2) {
        document.getElementById("menu").style.transitionDuration = "0.1s"
        document.getElementById("menu").style.top = "0%";
    }
}


//funcao responsável por exibir o botão de subir
function botaoSubir() {
    var tamPagina = document.documentElement.offsetHeight;

    if(document.documentElement.scrollTop > tamPagina / 4) {
        document.getElementById('botaoSubir').style.bottom = "5%"
    }else if(document.documentElement.scrollTop < tamPagina / 4) {
        document.getElementById('botaoSubir').style.bottom = "-100%"
    }

}

//máscara do cpf
function mascara(vCpf){
    var cpf = vCpf.value;

    if (cpf.length == 3 || cpf.length == 7) vCpf.value += ".";
    if (cpf.length == 11) vCpf.value += "-";
}

function mascaraCep(vCep){
    var cep = vCep.value;

    
    if (cep.length == 5) vCep.value += "-";
}

for(var i = 0; i<overlay.length; i++){
    overlay[i].addEventListener('click', function(){sumirModal()});
}

function sumirModal(){

    var tamBody = document.querySelector('html').offsetWidth;
    
    if(document.getElementById('itens').offsetWidth==170 && tamBody<=575){
        abreMenu();
    }else{
        sair();
        msgErro();
        
    }
}
function sumirModalVer(){

    var tamBody = document.querySelector('html').offsetWidth;
    
    if(document.getElementById('itens').offsetWidth==170 && tamBody<=575){
        abreMenu();
    }else{
        sairVer();
        msgErro();
        
    }
}


//funções que abrem ou fecham um popup

function deletar(id) {
    document.getElementById('btnOk').value = id;
    document.getElementById('confirmaDelete').style.display = "block";
    document.getElementById('confirmaDelete').style.opacity = "1";

    overlay[0].style.display='block';
    overlay[0].style.visibility="visible";
    overlay[0].style.opacity="0.5";
}
function AlterarStatus(id) {
    document.getElementById('btnOk').value = id;
    document.getElementById('confirmaDelete').style.display = "block";
    document.getElementById('confirmaDelete').style.opacity = "1";

    overlay[0].style.display='block';
    overlay[0].style.visibility="visible";
    overlay[0].style.opacity="0.5";
}
function VerItens(id) {
    document.getElementById('btnOk').value = id;
    document.getElementById('Ver').style.display = "block";
    document.getElementById('Ver').style.opacity = "1";

    overlay[0].style.display='block';
    overlay[0].style.visibility="visible";
    overlay[0].style.opacity="0.5";
}

function editar(id, nome, preco, imagem, categoria) {

    document.getElementById('btnEdit').value = id;
    document.getElementById('txtNomeProdutoEdit').value = nome;
    document.getElementById('txtPrecoProdutoEdit').value = preco;
    document.getElementById("previewEdit").src = "../"+imagem;
    document.getElementById('slCategoriaEdit').value = categoria;


    document.getElementById('confirmaEdit').style.display = "block";
    document.getElementById('confirmaEdit').style.opacity = "1";

    overlay[0].style.display='block';
    overlay[0].style.visibility="visible";
    overlay[0].style.opacity="0.5";
}

function editarCat(id, nome) {

    document.getElementById('btnEdit').value = id;
    document.getElementById('txtNomeCategoriaEdit').value = nome;

    document.getElementById('confirmaEdit').style.display = "block";
    document.getElementById('confirmaEdit').style.opacity = "1";

    overlay[0].style.display='block';
    overlay[0].style.visibility="visible";
    overlay[0].style.opacity="0.5";
}

function sair() {
    for(var i = 0; i<overlay.length; i++){
        overlay[i].style.display='none';
        overlay[i].style.visibility="hidden";
    }
    document.getElementById("confirmaDelete").style.display='none';
    
    document.getElementById("confirmaEdit").style.display='none';
}
function sairVer() {
    for(var i = 0; i<overlay.length; i++){
        overlay[i].style.display='none';
        overlay[i].style.visibility="hidden";
    }
   
    
    document.getElementById("Ver").style.display='none';
}

function msgErro(){
    var overlay = document.getElementsByClassName('overlay');

    for(var i = 0; i<overlay.length; i++){
        overlay[i].style.display='none';
        overlay[i].style.visibility="hidden";
    }
    document.getElementById("mensagemErro").style.display='none';
}


//função que verifica o tamanho da senha e se sao iguais
function verificaCadastro(){

    var senhaUsuario = document.getElementById('txtSenhaCadastro').value;
    var senhaConfirm = document.getElementById('txtSenhaConfirma').value;

    if(senhaUsuario.length<=8 || senhaConfirm.length<=8 || senhaUsuario != senhaConfirm){
        document.getElementById('txtSenhaCadastro').style.backgroundColor="pink";
        document.getElementById('txtSenhaConfirma').style.backgroundColor="pink";
        document.getElementById('txtSenhaCadastro').classList.add('senhaplc');
        document.getElementById('txtSenhaConfirma').classList.add('senhaplc');
    }else if(senhaConfirm==senhaUsuario){
        document.getElementById('txtSenhaCadastro').style.backgroundColor="#F6F6F6";
        document.getElementById('txtSenhaConfirma').style.backgroundColor="#F6F6F6";
        document.getElementById('txtSenhaCadastro').classList.remove('senhaplc');
        document.getElementById('txtSenhaConfirma').classList.remove('senhaplc');
    }
}

//funções de esconder ou mostrar a senha
function olhoSenha(){
    if(document.getElementById('txtSenha').type=="text"){
        document.getElementById('txtSenha').type="password";
        document.getElementById('olho').classList.add('fa-eye');
        document.getElementById('olho').classList.remove('fa-eye-slash');
    }else{
        document.getElementById('txtSenha').type="text";
        document.getElementById('olho').classList.remove('fa-eye');
        document.getElementById('olho').classList.add('fa-eye-slash');
    }
}

function olhoSenhaCadastro(){
    if(document.getElementById('txtSenhaCadastro').type=="text"){
        document.getElementById('txtSenhaCadastro').type="password";
        document.getElementById('txtSenhaConfirma').type="password";
        document.getElementById('olho').classList.add('fa-eye');
        document.getElementById('olho').classList.remove('fa-eye-slash');
    }else{
        document.getElementById('txtSenhaCadastro').type="text";
        document.getElementById('txtSenhaConfirma').type="text";
        document.getElementById('olho').classList.remove('fa-eye');
        document.getElementById('olho').classList.add('fa-eye-slash');
    }
}

function emailAlterar(){
    if(document.getElementById('txtEmail').readOnly==true){
        document.getElementById('txtEmail').readOnly = false;
        document.getElementById('txtEmail').focus();
    }
}
function senhaAlterar(){
    if(document.getElementById('txtSenha').readOnly==true){
        document.getElementById('txtSenha').readOnly = false;
        document.getElementById('txtSenha').focus();
    }
}


 
function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('txtLogradouroCliente').value=("");
    document.getElementById('txtBairroCliente').value=("");
    document.getElementById('txtCidadeCliente').value=("");
    document.getElementById('txtUFCliente').value=("");
    
}

function meu_callback(conteudos) {
if (!("erro" in conteudos)) {
    //Atualiza os campos com os valores.
    document.getElementById('txtLogradouroCliente').value=(conteudos.logradouro);
    document.getElementById('txtBairroCliente').value=(conteudos.bairro);
    document.getElementById('txtCidadeCliente').value=(conteudos.localidade);
    document.getElementById('txtUFCliente').value=(conteudos.uf);
    
} //end if.
else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    alert("CEP não encontrado.");
}
}



function pesquisacep(valor) {

//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        document.getElementById('txtLogradouroCliente').value="...";
        document.getElementById('txtBairroCliente').value="...";
        document.getElementById('txtCidadeCliente').value="...";
        document.getElementById('txtUFCliente').value="...";
        

        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

    } //end if.
    else {
        //cep é inválido.
        limpa_formulário_cep();
        alert("Formato de CEP inválido.");
    }
} //end if.
else {
    //cep sem valor, limpa formulário.
    limpa_formulário_cep();
}
};

function verificaValor(){
    
}

function checkare(e) {
    var char = String.fromCharCode(e.keyCode);
  
  console.log(char);
    var pattern = '[a-z-A-Z-á-ú-Á-Ú-â-û-Â-Û-Ã-Õ-ã-õ-0-9- ]';
    if (char.match(pattern)) {
      return true;
  }
}
var input = document.querySelector("#categoriass");
input.addEventListener("keypress", function(e) {
    if(!checkare(e)) {
      e.preventDefault();
  }
});

var input = document.querySelector("#nomeProde");
input.addEventListener("keypress", function(e) {
    if(!checkare(e)) {
      e.preventDefault();
  }
});



