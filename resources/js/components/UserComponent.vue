<template>


<div>
    
    <div class="jumbotron text-center">
        <h1 class="display-4 ">SIGMA</h1>
        
        <h1>Cadastro e controle de usuarios</h1>
        <p class="lead">
            
        </p>
    </div> 
                        


<div class="container">

                

                <div class="row mt-5">
                   
                </div>

                <hr/>

                <h2 class="card-text text-center"></h2>

               <div class="row" style="padding-top: 50px;">
                    <button type="submit" class="btn btn-primary ml-3 mb-4" data-toggle="modal" data-target="#formInserir" title="Inserir"><i class="fa fa-solid fa-plus"></i> Inserir Usuário</button>
					<div class="col-lg-12">
						<div class="card mb-4 p-4">
                                                        
							<table class="table table-bordered table-striped table-hover" id="tabela-user">

                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="(user, index) in users" :key="user.id">
                                    <th scope="row">{{index + 1}}</th>
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td style="width: 12%;">

                                        <button type="submit" class="btn btn-primary btn-edit" @click.prevent.self="edit(user.id)" data-toggle="modal" data-target="#formEdit" title="Editar"><i class='fa fa-pencil'></i></button>
                                        
                                        <button type="submit" class="btn btn-danger btn-delete" @click.prevent.self="remover(user.id)"  title="Remover"><i class="fa fa-times"></i> </button>                                                                                              
                                        
                                    </td>
                                    </tr>
                                    
                                </tbody>
        
                            </table>
						</div>
					</div>
				</div>


                <div class="modal fade" id="formInserir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inserir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-signin mt-5 mb-5">
                                <div class="text-center mb-4">
                                    <h1 class="h3 mb-3 font-weight-normal">Dados Usuário</h1>        
                                </div>  

                                <div v-if="errors">
                                    <div v-for="(v, k) in errors" :key="k">
                                         
                                        <div class="alert alert-warning">
                                            <p v-for="error in v" :key="error" class="">
                                            {{error}} 
                                            </p>
                                        </div>                                        
                                    
                                    </div>
                                </div>                             

                                <div class="form-label-group mt-2">
                                    <label for="nome">Nome</label>
                                    <input type="text" id="name" name="name" class="form-control" v-model="name" required="" autofocus="">
                                </div>

                                

                                <div class="form-label-group mt-2">
                                    <label for="lote">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" v-model="email" required="" autofocus="">
                                    
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="validade">senha</label>
                                    <input type="password" id="senha" name="senha" class="form-control" v-model="senha" required="" autofocus="">
                                    
                                </div>                               
                                             
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"  @click.prevent.self="inserir()"  type="submit"><i class="fa fa-solid fa-plus"></i>  Inserir</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-signin mt-5 mb-5">
                                <div class="text-center mb-4">
                                    <h1 class="h3 mb-3 font-weight-normal">Editar Usuario</h1>        
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="nome">Nome</label>
                                    <input type="hidden" id="id" name="id" class="form-control" v-model="id">
                                    <input type="text" id="name_edit" name="name_edit" class="form-control" v-model="name_edit" required="" autofocus="">
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="lote_edit">E-mail</label>
                                    <input type="email" id="email_edit" name="email_edit" class="form-control" v-model="email_edit" required="" autofocus="">
                                    
                                </div>

                                <div class="form-label-group mt-2">
                                    <label for="validade_edit"></label>
                                    <input type="hidden" id="senha_edit" name="senha_edit" class="form-control" v-model="senha_edit" required="" disabled>
                                    
                                </div>
                                
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary"  @click.prevent.self="update(id)"  type="submit" >Editar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    
                        </div>
                        </div>
                    </div>
                </div>

</div>
</div>

 
    
</template>


<script>


export default {
  props:{

     userconected: {
      type: Object     
    }
  },    
    data(){
    return {        
        users: [],
        name: "",
        email: "",
        senha:"",
        id:"",
        name_edit:"",
        email_edit:"",
        senha_edit:"",
        errors:""   

    }
   },
   mounted(){
        this.getAllUsers();
        this.gettable();        
   },
   methods: {
    
    async getAllUsers(){

        axios.get("/all_users")
        .then(response => {
            
            if(response.data){
                      
                this.users= response.data;      
            }

        });
    },
    async inserir(){        

        
        if(this.name == ""){

            Swal.fire({
            type: 'warning',
            title: 'Atenção',
            html: 'O campo nome é obrigatorio!',
           
        }); 

        }else if(this.email == ""){

            Swal.fire({
            type: 'warning',
            title: 'Atenção',
            html: 'O campo email é obrigatorio!',
            
        }); 

        }else if(this.senha == ""){

            Swal.fire({
            type: 'warning',
            title: 'Atenção',
            html: 'O campo senha é obrigatorio!',
            
        }); 

        }else{

            
            axios.post("/save_user",{
                name: this.name,
                email: this.email,
                password: this.senha
            })
            .then(response => {
                
                if(response.data == "success"){
                    
                    Swal.fire({
                        type: 'success',
                        title: 'Sucesso',
                        html: 'Usuário adicionado com sucesso!',
                        onClose: function(){

                            $('#name').val("");
                            $('#email').val("");
                            $('#senha').val("");                            
                                                                
                        }
                    }); 

                    this.getAllUsers();

                }else{

                    Swal.fire({
                        type: 'erro',
                        title: 'Atenção',
                        html: 'Todos os campos são obrigatorios!',
                       
                    }); 

                }

            }).catch((error) => {
                console.log(error.response.data.errors) ;            
            });
            
        }          

    },    
    async edit(id){

       this.id = id;
       axios.get("get_user/"+id)
       .then(response => {
                        
            if(response.data){                
                this.name_edit= response.data.name;
                this.email_edit= response.data.email;
                this.senha_edit= response.data.password;
                
            }
        });
    },
    async update(id){

        axios.put("update_user",{
        id:   this.id,    
        name: this.name_edit,
        email: this.email_edit,
        password: this.senha_edit
    })
    .then(response => {
        
        if(response.data == "success"){

            Swal.fire({
                type: 'success',
                title: 'Sucesso',
                html: 'Usuário atualizado com sucesso!',
                    onClose: function(){
                        
                        $('#name_edit').val("");
                        $('#email_edit').val("");                                                
                                                                
                    }
            });            
            
            this.getAllUsers();

        }

    });
    },
    remover(id){

        
        Swal.fire({
            title: 'Você tem certeza que deseja excluir o usuário selecionado?',
            text: "Você não poderá reverter isso!",            
            type: "warning",
            animation: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: "Agora não!",
            showLoaderOnConfirm: false
            }).then((result) => {
            if (result.value) {


                if(this.userconected.id == id ){

                    Swal.fire({
                        type: 'warning',
                        title: 'Atenção!!',
                        html: 'Não pode remover o usuário que está conectado atualmente!',
                            onClose: function(){                                  
                                                                        
                            }
                    }); 

                }else{

                    axios.delete("delete_user/"+id)
                    .then(response => {
                        
                        if(response.data == "success"){ 

                            Swal.fire({
                                type: 'success',
                                title: 'Sucesso',
                                html: 'Usuario removido com sucesso!'
                                
                            });       

                            this.getAllUsers();

                        }

                    });

                }


            }
        })

        
    },    
    async gettable(){        

        axios.get("/all_users")
        .then(response => {

            $("#tabela-user").DataTable({ 
                dom: "<'row'<'col-xl-6'l><'col-xl-6'Tf>r>" +
                    "t" +
                    "<'row'<'col-xl-6'i><'col-xl-6'p>>",
                tableTools: {
                    sSwfPath: "assets/js/datatables/tabletools/copy_csv_xls_pdf.swf"
                }
            });

        });

    }

   }
    
}
</script>

<style scoped>
    #tabela-user {
			float: right;
		}

		.pagination {
			float: right;
		}

		table.table-bordered tbody td {
			padding: 10px;
			text-align: center;
		}

		table.dataTable thead>tr>th {
			padding: 10px;
			text-align: center;
		}
        .btn-edit{
            margin-right: 5px;
        }

        .btn-delete{
            width: 41%;
        }
</style>