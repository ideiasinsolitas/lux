<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <title></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        
        <!-- BEGIN GLOBAL THEME STYLES -->
            <!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /-->
            <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL THEME STYLES -->
        

    <body>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#/">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a v-href="#/projects">Projetos</a>
                </li>
                <li v-if="activeProject.id">
                    <a v-href="#/project/{{activeProject.id}}">{{activeProject.name}}</a>
                </li>
                <li v-if="activeTicket.id">
                    <a v-href="#/project/{{activeProject.id}}/ticket/{{activeTicket.id}}">Ticket</a>
                </li>
                <li v-if="newComment.id">
                    <a v-href="#/project/{{activeProject.id}}/ticket/{{activeTicket.id}}/comment/{{newComment.id}}">Comentário</a>
                </li>
            </ul>
        </div>

        <!-- END PAGE HEADER-->
        <div id="app" class="row">
            <div class="col-md-12">

                <!-- BEGIN PAGE TITLE-->
                <h3 class="page.name"> Informações de cadastro relevantes
                    <small>Informações de cadastro relevantes ao cálculo da All Scorings</small>
                </h3>
                <!-- END PAGE TITLE-->
                
                <div v-if="sysMessage" class="sysMessage alert alert-info">
                    <button class="close" data-dismiss="alert"></button> {{sysMessage}} </div>

        {{activeProject}}
        {{proxy.opened}}

                <div
                    id="project-all"
                    class="portlet light bordered">

                    <a
                        id="project-new-anchor"
                        v-href="#/project/new"
                        class="btn btn-outline green"> novo projeto</a>

                    <a 
                        v-href="#"
                        v-click="allProjects()"
                        class="btn btn-outline green">listar projetos</a>

                    <a
                        v-href="#"
                        v-click="openedProjects()"
                        class="btn btn-outline green">projetos abertos</a>

                    <div
                        v-repeat="project in proxy.collection"
                        class="portlet light bordered">

                        <p>nome: {{project.name}}</p>

                        <a
                            id="project-anchor"
                            v-href="#/project/{{project.id}}"
                            class="btn btn-outline green">ver</a>

                        <a
                            id="project-edit-anchor"
                            v-href="#/project/{{project.id}}/edit"
                            class="btn btn-outline green">editar</a>
                    </div>

                    <div
                        v-if="display.projectList === 'all'"
                        v-repeat="project in proxy.collection"
                        class="portlet light bordered">

                        <p>{{project.name}}</p>

                        <a
                            id="project-anchor"
                            v-href="#/project/{{project.id}}"
                            class="btn btn-outline green">ver</a>

                        <a
                            id="project-edit-anchor"
                            v-href="#/project/{{project.id}}/edit"
                            class="btn btn-outline green">editar</a>
                    </div>
                </div>
            </div>

            <div
                v-show="display.viewMode === 'project'"
                class="col-md-12">
                <div
                    id="project-form"
                    class="portlet light bordered">
                    <div class="row">
                        <div class="col-md-4">
                            <div
                                v-show="display.activeForm"
                                id="project-form"
                                class="col-md-4">
                                <form>
                                <div class="form-group">
                                    <label class="control-label">nome
                                        <span class="required"> * </span>
                                    </label>
                                        <input 
                                            v-model="activeProject.name"
                                            name="name"
                                            v-change="stain()"
                                            type="text" 
                                            class="form-control" 
                                            placeholder="name"> 

                                </div>

                                <div class="form-group">
                                    <label class="control-label">descrição
                                    </label>
                                        <input 
                                            v-change="stain()"
                                            v-model="activeProject.description"
                                            name="description"
                                            type="text" 
                                            class="form-control col-md-4" 
                                            placeholder="description"> 
                                </div>

            
                                <div class="form-group">
                                    <label class="control-label">atividade
                                        <span class="required"> * </span>
                                    </label>
                                        <input 
                                            v-model="activeProject.activity"
                                            name="name"
                                            v-change="stain()"
                                            type="activity" 
                                            class="form-control" 
                                            placeholder="activity"> 
                                </div>

                                </form>

                                <a 
                                    v-href="#"
                                    v-click="saveProject()"
                                    class="btn btn-outline green">salvar</a>
                            </div>
                            <div
                                v-show="!display.activeForm"
                                id="project-detail"
                                class="portlet light bordered">

                                <p>{{activeProject.name}}</p>
                                <p><small>{{activeProject.description}}</small></p>

                                <a
                                    id="ticket-add-anchor"
                                    href="#/project/{{activeProject.id}}/ticket/add"
                                    class="btn btn-outline green"> novo ticket</a>

                                <a 
                                    v-href="#"
                                    v-click="saveProject()"
                                    class="btn btn-outline green">salvar</a>

                                <a 
                                    v-href="#"
                                    v-click="closeProject()"
                                    class="btn btn-outline green"> fechar</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div
                                id="project-ticket-list"
                                class="portlet light bordered">
                                <div
                                    id=""
                                    v-repeat="ticket in activeTickets"
                                    class="portlet light bordered">

                                    <p>{{ticket.problem_url}}</p>
                                    <p><small>{{ticket.description}}</small></p>

                                    <a
                                        v-href="#" 
                                        v-click="openTicket()"
                                        class="btn btn-outline green">abrir</a
                                        >

                                    <a
                                        id="ticket-show-anchor"
                                        v-href="#/project/{{activeProject.id}}/ticket/{{ticket.id}}"    
                                        class="btn btn-outline green"> ver</a>
                                    <a
                                        id="ticket-edit-anchor"
                                        v-href="#/project/{{activeProject.id}}/ticket/{{ticket.id}}/edit"
                                        class="btn btn-outline green"> editar</a>
                                    <a
                                        id="ticket-comment-anchor"
                                        v-href="#/project/{{activeProject.id}}/ticket/{{ticket.id}}/comment"
                                        class="btn btn-outline green"> commentar</a>
                                    <a 
                                        v-href="#" 
                                        v-click="removeTicket()"
                                        class="btn btn-outline green"> remover</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-show="display.viewMode === 'ticket'"
                class="col-md-12">

                <div
                    id="ticket-detail"
                    class="portlet light bordered">

                    <div class="row">
                        <div class="col-md-4">
                            <div
                                v-show="display.activeForm"
                                id="ticket-form"
                                class="portlet light bordered">

                                <div class="form-group">
                                    <label class="control-label">url do problema
                                        <span class="required"> * </span>
                                    </label>
                                        <input 
                                            v-change="stain()"
                                            v-model="activeTicket.problem_url"
                                            name="problem_url"
                                            type="text" 
                                            class="form-control" 
                                            placeholder="problem_url">
                                </div>


                                <div class="form-group">
                                    <label class="control-label">descrição do problema
                                        <span class="required"> * </span>
                                    </label>
                                        <textarea 
                                            v-change="stain()"
                                            v-model="activeTicket.description"
                                            name="description"
                                            type="text" 
                                            class="form-control">{{activeTicket.description}}</textarea>
                                </div>

                                <a 
                                    v-href="#"
                                    v-click="saveTicket()"
                                    class="btn btn-outline green"> salvar</a>
                                
                                <a 
                                    v-href="#"
                                    v-click="removeTicket()"
                                    class="btn btn-outline green"> remover</a>

                                <a 
                                    v-href="#"
                                    v-click="commentTicket()"
                                    class="btn btn-outline green"> commentar</a>
                            </div>
                            <div
                                v-show="!display.activeForm"
                                id="ticket-detail"
                                class="">

                                <p>{{activeTicket.problem_url}}</p>
                                <p><small>{{activeTicket.description}}</small></p>

                                <div class="form-group">
                                    <label class="control-label">atividade
                                        <span class="required"> * </span>
                                    </label>
                                        <input 
                                            v-model="activeTicket.activity"
                                            v-change="stain()"
                                            name="name"
                                            type="activity" 
                                            class="form-control" 
                                            placeholder="activity"> 
                                </div>

                                <a
                                    id="ticket-comment-anchor"
                                    v-href="#/project/{{activeProject.id}}/ticket/{{activeTicket.id}}/comment"
                                    class="btn btn-outline green"> comentários</a>

                                <a
                                    v-href="#" 
                                    v-if="canVote()"
                                    v-click="voteTicket()"
                                    class="btn btn-outline green"> votar</a>
                                
                                <a 
                                    v-href="#" 
                                    v-click="removeTicket()"
                                    class="btn btn-outline green"> remover</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="ticket-show-anchor" class="portlet light bordered">
                                <div
                                    v-repeat="comment in activeTicket.comments"
                                    class="portlet light bordered">

                                    <p><small>{{comment.user.display_name}}</small></p>
                                    <p>{{comment.comment}}</p>

                                    <a
                                        id="comment-show-anchor"
                                        v-href="#/project/{{activeProject.id}}/ticket/{{ticket.id}}/comment/{{comment.id}}"
                                        class="btn btn-outline green"> ver</a>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <div
                v-show="display.viewMode === 'comment'"
                class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div
                            id="comment-detail"
                            class="portlet light bordered">
                            <a
                                id="comment-reply-anchor"
                                v-href="#/project/{{activeProject.id}}/ticket/{{activeTicket.id}}/comment/{{newComment.id}}/reply"
                                class="btn btn-outline green"></a>

                            <a 
                                v-href="#" 
                                v-click="removeTicketComment()"
                                class="btn btn-outline green"></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div
                            id="comment-form"
                            class="portlet light bordered">
                            <div
                                v-show="display.activeForm"
                                class="">


                                <div class="form-group">
                                    <label class="control-label">commentário
                                        <span class="required"> * </span>
                                    </label>
                                        <textarea 
                                            v-model="newComment.comment"
                                            name="comment"
                                            type="text" 
                                            class="form-control">{{newComment.comment}}</textarea>
                                </div>

                                <a 
                                    v-href="#" 
                                    v-click="removeTicketComment()"
                                    class="btn btn-outline green"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        
        <!-- BEGIN CORE JQUERY PLUGINS -->
        
        <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        
        <!-- BEGIN JQUERY dependencies -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <!-- END JQUERY dependencies -->

        <!-- BEGIN VUE dependencies -->
        <script src="../assets/vue/vue.min.js" type="text/javascript"></script>
        <script src="../assets/vue/vue-mdl.min.js" type="text/javascript"></script>
        <!-- END VUE dependencies -->

        <script src="../js/vue/menu.js" type="text/javascript"></script>
        <script src="../js/vue/sidebar.js" type="text/javascript"></script>
        <script src="../js/vue/message.js" type="text/javascript"></script>
        <script src="../js/vue/notification.js" type="text/javascript"></script>
        <script src="../js/vue/project.js" type="text/javascript"></script>

    </body>
    <!-- END BODY -->
</html>
