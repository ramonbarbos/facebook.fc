
//CONSULTANDO FEED INDIVIDUAL
async function listFeed(id){
    console.log("Envido: " +id)
    const dados = await fetch("./class/consultaFeed.php?id=" + id) //enviar
    const resposta = await dados.json(); //receber
    console.log(resposta)

    if(resposta['erro']){
        document.getElementById('msgAlerta').innerHTML = resposta['msg'];
    }else{

        

        //Feed
       
        document.getElementById('conteudoFeed').innerHTML = resposta['dados-feed'].conteudo;
        if(resposta['dados-feed'].capa === ''){
            document.getElementById('capaFeed').innerHTML = '<div class="img-card" style="visibility: hidden; height: 10px;"><img   alt="Card image cap"  > </div>' ;   
        }else{
            document.getElementById('capaFeed').innerHTML = '<div class="img-card" ><img src="./painel/uploads/'+ resposta['dados-feed'].capa +' " alt="Card image cap"  >  </div>' ; 
        }
       
        document.getElementById('dataFeed').innerHTML = resposta['dados-feed'].data;

        //User
        document.getElementById('nomeUser').innerHTML = resposta['dados-res'].nome;
        document.getElementById('imgUser').innerHTML = '<img class="" src="./painel/uploads/'+resposta['dados-res'].img +' " alt="Card image cap"  >' ; 
        

        //INSERINDO COMENTARIOS NA PUBLICAÇÃO
        const cadForm = document.getElementById("cad-comentario-form");

        cadForm.addEventListener("submit", async (e) =>{
            e.preventDefault(); //para não recarrecar a pagina

            const dadosForm =  new FormData(cadForm);
            dadosForm.append("add", 1)
            dadosForm.append("id_noticia" , id)
            console.log(dadosForm)

            const dadosComentario = await fetch("./class/cadastrarComentario.php",{
                method: "POST",
                body:dadosForm
            });

            const respostaComentario = await dadosComentario.json();
            console.log(respostaComentario);

            if(respostaComentario['erro']){
                document.getElementById('msg').innerHTML ='<div class="alert alert-danger" role="alert">'+respostaComentario['msg']+'</div>'  ;
                document.getElementById("cad-comentario-form").reset(); //resetar input
            }else{
                document.getElementById('msg').innerHTML = respostaComentario['dados']  ;
                document.getElementById("cad-comentario-form").reset(); //resetar input
                
            }

            
           


        })


           //CONSULTANDO COMENTARIOS
           const content = document.querySelector("content-coment");

           const listUsuario = async () => {
               const dados = await fetch("./class/listComentarios.php?id=" + id);
               const respostaComent = await dados.text();
               document.getElementById('idContent').innerHTML = respostaComent;

               //const visModal = document.getElementById("feedUser").show();
               //visModal.show();
           }
           
           listUsuario(); //Carregar na tela
    }
}

  //NOVAS NA PUBLICAÇÃO
  const cadForm = document.getElementById("car-publi-form");

    cadForm.addEventListener("submit", async (e) =>{
        e.preventDefault(); //para não recarrecar a pagina
        console.log("chegou a requisição para ser adicionado")

        const dadosForm =  new FormData(cadForm);
        dadosForm.append("add", 1)
        console.log(dadosForm)

        const dadosPubli = await fetch("./class/cadastrarPublicacao.php",{
            method: "POST",
            body:dadosForm
        });

        
        const respostaPubli = await dadosPubli.json();

        if(respostaPubli['erro']){
            document.getElementById('msgADD').innerHTML ='<div class="alert alert-danger" role="alert">'+respostaPubli['msg']+'</div>'  ;
            document.getElementById("car-publi-form").reset(); //resetar input
            
                //const visModal = document.getElementById("feedUser");
              // visModal.show();
        }else{
            document.getElementById('msgADD').innerHTML ='<div class="alert alert-success" role="alert">'+respostaPubli['msg']+'</div>'  ;
            document.getElementById("car-publi-form").reset(); //resetar input

                 console.log(respostaPubli);
        }
       

       

  })

  //DELETAR  PUBLICAÇÃO
  async function apagarFeed(id){
    console.log("Envido: " +id)
    const dados = await fetch("./class/apagarFeed.php?id=" + id) //enviar
    const resposta = await dados.json(); //receber
    console.log(resposta)

    if(resposta['erro']){
        document.getElementById('msg').innerHTML ='<div class="alert alert-danger" role="alert">'+resposta['msg']+'</div>'  ;
        
    }else{
        document.getElementById('msg').innerHTML ='<div class="alert alert-primary" role="alert">'+resposta['msg']+'</div>'  ;

    }

}


  //NOVO USUARIO
  const userForm = document.getElementById("user-form");

  userForm.addEventListener("submit", async (e) =>{
        e.preventDefault(); //para não recarrecar a pagina
        console.log("chegou a requisição para ser adicionado")

        const dadosForm =  new FormData(userForm);
        dadosForm.append("add", 1)
        console.log(dadosForm)

     
       

       

  })