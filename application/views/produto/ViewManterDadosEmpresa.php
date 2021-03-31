<!DOCTYPE html>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/produto-api/application/views/menus/MenuPrincipal.php');
?>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Dados cadastrais</title>

        <!-- por causa desse link o menu lateral fica grande-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.css'>

        <style>
            .main2 .waves-effect{
                z-index:0;
            }

            .width-30-pct{
                width:30%;
            }

            .text-align-center{
                text-align:center;
            }

            .margin-bottom-1em{
                margin-bottom:1em;
            }

            .breakEmail, .breakEmail a{
                /* These are technically the same, but use both */
                overflow-wrap: break-word;
                word-wrap: break-word;

                -ms-word-break: break-all;
                /* This is the dangerous one in WebKit, as it breaks things wherever */
                word-break: break-all;
                /* Instead use this non-standard one: 
                word-break: break-word;*/

                /* Adds a hyphen where the word breaks, if supported (No Blink) */
                -ms-hyphens: auto;
                -moz-hyphens: auto;
                -webkit-hyphens: auto;
                hyphens: auto;

            }

            .activetab {
                background-color: #ee6e73 !important;
                color: #fff!important;   min-width: 50px;
            }

            .activetab i.right { margin-left: 0px; }

            tr th {cursor: pointer;}

            .divider, .sorter {display: none;}

            .sorter .btn {    margin-bottom: 2px;
                              font-size: .75em; padding: 0 2px; }
            .customAction {
                margin-bottom: 2px;
                background-color: #0086b3;              
            }.customAction:hover{
                margin-bottom: 2px;
                background-color: #000080;
            }

            .ng-invalid.ng-dirty, input[type=tel].ng-invalid.ng-dirty:focus:not([readonly]){
                border-bottom: 1px solid #F44336;
                box-shadow: 0 1px 0 0 #F44336;
            }/* altera cor do botao*/


            .ng-invalid.ng-dirty, input[type=tel].ng-invalid.ng-dirty:focus:not([readonly]){border-bottom: 1px solid #F44336;
                                                                                            box-shadow: 0 1px 0 0 #F44336;}

            @media screen and (max-width: 1300px) {
                .container { width:90%;}
            }

            /* 
            Max width before this PARTICULAR table gets nasty
            This query will take effect for any screen smaller than 760px
            and also iPads specifically.
            */
            @media 
            only screen and (max-width: 760px),
            (min-device-width: 768px) and (max-device-width: 1024px)  {
                tr {margin-bottom: 10px;}
                .divider {display: block; width:100%;}
                .sorter {display: inline-block; margin-top: 15px;}
                .nopad {padding: 0!important; margin: 0;}

                /* Force table to not be like tables anymore */
                table, thead, tbody, th, td, tr { 
                    display: block; 
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                thead tr { 
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                tr { border: 1px solid #ccc; }

                td { 
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 0px solid #eee; 
                    position: relative;
                    padding-left: 50%;
                }

                td:before { 
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    /* top: 6px; */
                    left: 6px;
                    width: 45%; 
                    padding-right: 10px; 
                    white-space: nowrap;
                    margin-left: 20px;
                }
            }


            @media screen and (max-width: 500px) {

                td, th {padding: 7px 2px;}
                .customAction {padding: 0 5px;}
                .waves-effect {font-size: .75em;}

                h4 {    font-size: 1.5em;}
                .modal {width: 95%;}
                .row .col.nopad {padding: 0;}
                td { padding-left: 115px}
                td:before {width: 90px; margin-left:0; }
            }

            @media screen and (max-width: 400px) {
                .sorter {width: 100%; margin-top: 0px;     display: block;    clear: both;}
                .container .row {margin: 0;}
                .container {width: 100%;}
            }

        </style>
    </head>
    <body>
    <html>
        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Dados cadastrais</title>
            <!-- include material design icons -->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        </head>
        <body>
            <div class="container main2" ng-app="myApp" ng-controller="configPizzaria">
                <div class="row">
                    <br> 

                    <table class="table hoverable bordered">
                        <ng-form name="configForm" id="modal-config-form" novalidate>
                            <div class="modal-content">
                                <h4 id="modal-config-title"><br/>Dados cadastrais</h4>
                                <div class="row">

                                    <div class="input-field col s12">
                                            <label for="razao_social_empresa">Razão Social: </label>
                                            <input type="text" readonly="true" disabled="true" id="razao_social_empresa" name="razao_social_empresa" ng-model="empresa.razao_social_empresa"  required aria-required="true" ng-pattern="/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+([0-9,.'-()]+)?/" placeholder="">
                                    </div><!-- End of FirstName -->

                                    <!-- MiddleName -->
                                    <div class="input-field col s12">
                                            <label for="nome_fantasia_empresa">Nome fantasia: <span class="asterisk">*</span></label>
                                            <input type="text" id="nome_fantasia_empresa" name="nome_fantasia_empresa" ng-model="empresa.nome_fantasia_empresa" aria-required="true" required placeholder=""></input>
                                            <div ng-if="configForm.nome_fantasia_empresa.$error.required && configForm.nome_fantasia_empresa.$dirty" style="color:red">Campo obrigatório.</div>
                                    </div><!-- End of MiddleName -->

                                    <!-- LastName REQUIRED -->
                                    <div class="input-field col s6">
                                            <label for="cnpj_empresa">CNPJ </label>
                                            <input type="text" readonly="true" disabled="true" cnpj-input id="cnpj_empresa" name="cnpj_empresa" ng-model="empresa.cnpj_empresa" aria-required="true" required placeholder=""></input>
                                    </div><!-- End of LastName -->

                                    <!-- LastName REQUIRED -->
                                    <div class="input-field col s6">
                                            <label for="perfil_facebook_empresa">Perfil Facebook: </label>
                                            <input type="text" readonly="true" disabled="true" id="perfil_facebook_empresa" name="perfil_facebook_empresa" ng-model="empresa.perfil_facebook_empresa" aria-required="true" required placeholder=""></input>
                                    </div><!-- End of LastName -->
                                    <!-- LastName REQUIRED -->
                                    <div class="input-field col s6">
                                            <label for="telefone_empresa">Telefone: <span class="asterisk">*</span></label>
                                            <input type="text" id="telefone_empresa" phone-input name="telefone_empresa" ng-model="empresa.telefone_empresa" aria-required="true" required placeholder=""></input>
                                            <div ng-if="configForm.telefone_empresa.$error.required && configForm.telefone_empresa.$dirty" style="color:red">Campo obrigatório.</div>
                                    </div><!-- End of LastName -->
                                    <!-- LastName REQUIRED -->

                                    <!-- Zip REQUIRED -->
                                    <div class="input-field col s6">
                                            <label for="cep_empresa">CEP: <span class="asterisk">*</span></label> <span id="errmsgZip"></span>
                                            <input type="text" id="cep_empresa" name="cep_empresa" ng-model="empresa.cep_empresa"  cep-input class="no-spaces numeric required" required placeholder=""></input>
                                    </div><!-- End of Zip -->
                                    <!-- LastName REQUIRED -->
                                    <div class="input-field col s12">
                                            <label for="endereco_empresa">Endereço (Rua, Avenida): <span class="asterisk">*</span></label>
                                            <textarea class="materialize-textarea" type="text" id="LastName" name="endereco_empresa" ng-model="empresa.endereco_empresa" aria-required="true" required placeholder=""></textarea>
                                    </div><!-- End of LastName -->
                                    <!-- LastName REQUIRED -->
                                    <div class="input-field col s6">
                                            <label for="numero_endereco_empresa">Número: <span class="asterisk">*</span></label>
                                            <input type="text" id="numero_endereco_empresa" name="numero_endereco_empresa" ng-model="empresa.numero_endereco_empresa" aria-required="true" required placeholder=""></input>
                                            <div ng-if="configForm.numero_endereco_empresa.$error.required && configForm.numero_endereco_empresa.$dirty" style="color:red">Campo obrigatório.</div>
                                    </div><!-- End of LastName -->
                                    <!-- LastName REQUIRED -->
                                    <div class="input-field col s6">
                                            <label for="complemento_endereco_empresa">Complemento: </label>
                                            <input type="text" id="complemento_endereco_empresa" name="complemento_endereco_empresa" ng-model="empresa.complemento_endereco_empresa" aria-required="true"  placeholder=""></input>
                                    </div><!-- End of LastName -->
                                    <!-- LastName REQUIRED -->

                                    <div class="input-field col s4">
                                            <label for="State">UF: <span class="asterisk">*</span></label><br />
                                            <select id="State" name="State" ng-model="State" class="required" required 
                                                    ng-options="estado.codigo_uf as estado.descricao_uf for estado in uf">
                                                    <option value="">Selecione a UF</option>
                                            </select>
                                    </div>
                                    <div class="input-field col s4">
                                            <label for="selectCit">Cidade: <span class="asterisk">*</span></label><br />
                                            <select id="selectCit" name="selectCit" ng-model="selectCit" class="required" required 
                                                    ng-options="city.codigo_cidade as city.descricao_cidade for city in cidade">
                                                    <option value="">Selecione a Cidade</option>
                                            </select>
                                    </div>
                                    <div class="input-field col s4">
                                            <label for="SelectBairro">Bairro <span class="asterisk">*</span></label><br />
                                            <select id="SelectBairro" name="SelectBairro" ng-model="SelectBairro"  class="required" required 
                                                    ng-options="prod.codigo_bairro as prod.descricao_bairro for prod in bairro">
                                                    <option value="">Selecione o Bairro</option>
                                            </select>
                                    </div>
                                    <h4> Alterar senha</h4>
                                    <!-- Email REQUIRED -->
                                    <div class="input-field col s12">
                                            <label for="email_empresa">E-mail:  <span id="errmsgEmail"></span></label>
                                            <input type="text" readonly="true" disabled="true" id="email_empresa" name="email_empresa" ng-model="empresa.email_empresa"  placeholder="">
                                            <div ng-if="configForm.email_empresa.$error.required && configForm.email_empresa.$dirty" style="color:red">Campo obrigatório.</div>
                                    </div><!-- End of Email -->
        
                                    <!-- City REQUIRED -->
                                    <div class="input-field col s12">
                                            <label for="senha_cliente">Senha atual: </label>
                                            <input type="password" id="senha_cliente" name="senha_cliente" ng-model="empresa.senha_cliente"  placeholder="">
                                    </div><!-- End of City -->
                                    <!-- City REQUIRED -->
                                    <div class="input-field col s12">
                                            <label for="nova_senha">Nova senha: </label>
                                            <input type="password" id="nova_senha" name="nova_senha" ng-model="empresa.nova_senha" minlength="6" placeholder="">
                                    </div><!-- End of City -->
                                    <!-- City REQUIRED -->
                                    <div class="input-field col s12">
                                            <label for="confirma_nova_senha">Confirme nova senha: </label>
                                            <input type="password" id="confirma_nova_senha" name="confirma_nova_senha" minlength="6" ng-model="empresa.confirma_nova_senha"  placeholder="">
                                    </div><!-- End of City -->

                                    <div class="input-field col nopad s12">
                                        <a ng-class="{'disabled': configForm.$invalid}" id="btn-update-bebida" class="waves-effect waves-light btn customAction"
                                           ng-click="configForm.$valid && sendPost()"><i class="material-icons left">save</i>Salvar</a>
                                    </div>
                                </div>
                            </div>
                        </ng-form>
                    </table>
                </div> <!-- end col s12 -->
            </div> <!-- end row -->
        <!-- include jquery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <!-- material design js -->
        <script src="<?=base_url("js/materialize-0.100.2/js/materialize.min.js")?>"></script>

        <!-- include angular js -->
        <script src="<?=base_url("js/angular-1.5.7/angular.js")?>"></script>
        <!-- include angular-messages js -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.6.4/angular-messages.js"></script>-->

    </body>
</html>


<script>
    $(document).ready(function () {
        $('select').material_select();
    });
    
    var app = angular.module('myApp', ['angularUtils.directives.dirPagination']);
    app.controller('configPizzaria', function ($scope, $http) {
            $scope.empresa =<?php echo  json_encode($empresa);?>;
            $scope.bairro =<?php echo  json_encode($bairro);?>;
            $scope.cidade =<?php echo  json_encode($cidade);?>;
            $scope.uf =<?php echo  json_encode($uf);?>;          

            $scope.SelectBairro = $scope.empresa.bairro_empresa;
            $scope.State = $scope.empresa.uf_empresa;
            $scope.selectCit = $scope.empresa.cidade_empresa;
            
            $scope.sendPost = function() {  
                    $scope.empresa.bairro_empresa = $scope.SelectBairro;
                    $scope.empresa.uf_empresa = $scope.State;
                    $scope.empresa.cidade_empresa = $scope.selectCit;
                    var data = angular.toJson($scope.empresa);
                  //  var senha = [{"senha_cliente" : senha_cliente, "nova_senha" :nova_senha , "confirma_nova_senha" : confirma_nova_senha}];
                    if(confirm("As alterações dos Dados Cadastrais modificam alguns dados no chatbot. Deseja confirmar?")){
                        $http.post('<?=base_url("index.php/ControladorDadosEmpresa/confirmarAlterarDadosEmpresa")?>',data)
                        .success(function(data, status) {
                            alert("Dados alterados com sucesso.");
                            console.log("Success: " + status);
                        })
                        .error(function(data, status, message) {
                            alert("Erro ao incluir dados. ");
                            console.log("Error: " + status);
                        })
                    }
            }          

    }); // End of An AngularJS Block
    
app.directive('cnpjInput', function($filter, $browser) {
    return {
        require: 'ngModel',
        link:  function ($scope, $element, $attrs, ngModelCtrl) {
                var listener = function () {
                    var value = $element.val().replace(/[^0-9]/g, '');
                    $element.val($filter('cnpj')(value, false));
                };

                // This runs when we update the text field
                ngModelCtrl.$parsers.push(function (viewValue) {
                    return viewValue.replace(/[^0-9]/g, '').slice(0, 10);
                });

                // This runs when the model gets updated on the scope directly and keeps our view in sync
                ngModelCtrl.$render = function () {
                    $element.val($filter('cnpj')(ngModelCtrl.$viewValue, false));
                };

                $element.bind('change', listener);
                $element.bind('keydown', function (event) {
                    var key = event.keyCode;
                    // If the keys include the CTRL, SHIFT, ALT, or META keys, or the arrow keys, do nothing.
                    // This lets us support copy and paste too
                    if (key === 91 || (15 < key && key < 19) || (37 <= key && key <= 40)) {
                        return;
                    }
                    $browser.defer(listener); // Have to do this or changes don't get picked up properly
                });

                $element.bind('paste cut', function () {
                    $browser.defer(listener);
                });
            }

        };
    });
    //("99.999.999/9999-99")
    app.filter('cnpj', function () {
        return function (tel) {
            if (!tel) {return '';}
            var value = tel.toString().trim().replace(/^\+/, '');
            if (value.match(/[^0-9]/)) {return tel;}
            var country, city, number;
            switch (value.length) {
                case 1:
                case 2:
                case 3:
                    city = value;
                    break;

                default:
                    city = value.slice(0, 2);
                    number = value.slice(2);
            }
            if (number) {
                if (number.length > 3) {
                    number = number.slice(0, 3) + '.' + number.slice(3, 6) + '/' + number.slice(6, 10) + '-' + number.slice(10, 12);
                } else {
                    number = number;
                }
                return (city + "." + number).trim();
            } else {return city;}
        };
    });


    app.directive('phoneInput', function($filter, $browser) {
    return {
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModelCtrl) {
            var listener = function() {
                var value = $element.val().replace(/[^0-9]/g, '');
                $element.val($filter('tel')(value, false));
            };

            // This runs when we update the text field
            ngModelCtrl.$parsers.push(function(viewValue) {
                return viewValue.replace(/[^0-9]/g, '').slice(0,11);
            });

            // This runs when the model gets updated on the scope directly and keeps our view in sync
            ngModelCtrl.$render = function() {
                $element.val($filter('tel')(ngModelCtrl.$viewValue, false));
            };

            $element.bind('change', listener);
            $element.bind('keydown', function(event) {
                var key = event.keyCode;
                // If the keys include the CTRL, SHIFT, ALT, or META keys, or the arrow keys, do nothing.
                // This lets us support copy and paste too
                if (key == 91 || (15 < key && key < 19) || (37 <= key && key <= 40)){
                    return;
                }
                $browser.defer(listener); // Have to do this or changes don't get picked up properly
            });

            $element.bind('paste cut', function() {
                $browser.defer(listener);
            });
        }

    };
    });
    app.filter('tel', function () {
        return function (tel) {
            if (!tel) { return ''; }

            var value = tel.toString().trim().replace(/^\+/, '');

            if (value.match(/[^0-9]/)) {
                return tel;
            }

            var country, city, number;

            switch (value.length) {
                case 1:
                case 2:
                case 3:
                    city = value;
                    break;

                default:
                    city = value.slice(0, 2);
                    number = value.slice(2);
            }

            if(number){
                if(number.length > 3){
                    if(number.slice(0, 1) == "9"){
                        number = number.slice(0, 5) + '-' + number.slice(5,9);
                    }else{
                        number = number.slice(0, 4) + '-' + number.slice(4,8);
                    }
                }
                else{
                    number = number;
                }

                return ("(" + city + ") " + number).trim();
            }
            else{
                return "(" + city;
            }

        };
    });
    
    app.directive('cepInput', function ($filter, $browser) {
        return {
            require: 'ngModel',
            link: function ($scope, $element, $attrs, ngModelCtrl) {
                var listener = function () {
                    var value = $element.val().replace(/[^0-9]/g, '');
                    $element.val($filter('cep')(value, false));
                };

                // This runs when we update the text field
                ngModelCtrl.$parsers.push(function (viewValue) {
                    return viewValue.replace(/[^0-9]/g, '').slice(0, 10);
                });

                // This runs when the model gets updated on the scope directly and keeps our view in sync
                ngModelCtrl.$render = function () {
                    $element.val($filter('cep')(ngModelCtrl.$viewValue, false));
                };

                $element.bind('change', listener);
                $element.bind('keydown', function (event) {
                    var key = event.keyCode;
                    // If the keys include the CTRL, SHIFT, ALT, or META keys, or the arrow keys, do nothing.
                    // This lets us support copy and paste too
                    if (key === 91 || (15 < key && key < 19) || (37 <= key && key <= 40)) {
                        return;
                    }
                    $browser.defer(listener); // Have to do this or changes don't get picked up properly
                });

                $element.bind('paste cut', function () {
                    $browser.defer(listener);
                });
            }

        };
    });
    app.filter('cep', function () {
        return function (tel) {
            if (!tel) {return '';}
            var value = tel.toString().trim().replace(/^\+/, '');
            if (value.match(/[^0-9]/)) {return tel;}
            var country, city, number;
            switch (value.length) {
                case 1:
                case 2:
                case 3:
                    city = value;
                    break;

                default:
                    city = value.slice(0, 2);
                    number = value.slice(2);
            }
            if (number) {
                if (number.length > 3) {
                    number = number.slice(0, 3) + '-' + number.slice(3, 6);
                } else {number = number;}
                return (city + "." + number).trim();
            } else {return city;}
        };
    });

    // A jQuery $( document ).ready() Block
app.config(function (paginationTemplateProvider) {
        paginationTemplateProvider.setString('<ul class="pagination " ng-if="1 < pages.length || !autoHide">    <li class="nopad" ng-if="boundaryLinks" \n\
    ng-class="{ disabled : pagination.current == 1 }">        <a href="" ng-click="setCurrent(1)"><i class="material-icons">first_page</i></a>    </li>\n\
    <li class="nopad" ng-if="directionLinks" ng-class="{ disabled : pagination.current == 1 }">        <a href="" ng-click="setCurrent(pagination.current - 1)">\n\
    <i class="material-icons">chevron_left</i></a>    </li>    <li ng-click="setCurrent(pageNumber)" ng-repeat="pageNumber in pages track by tracker(pageNumber, $index)"\n\
    ng-class="{ active : pagination.current == pageNumber, disabled : pageNumber == \'...\' }">        <a href="" >{{ pageNumber }}</a>    </li>    <li class="nopad"\n\
    ng-if="directionLinks" ng-class="{ disabled : pagination.current == pagination.last }"> <a href="" ng-click="setCurrent(pagination.current + 1)"><i class="material-icons">\n\
    chevron_right</i></a>    </li> <li class="nopad" ng-if="boundaryLinks"  ng-class="{ disabled : pagination.current == pagination.last }"><a href=""\n\
    ng-click="setCurrent(pagination.last)"><i class="material-icons">last_page</i></a></li></ul>');

    });


    (function () {

        /**
         * Config
         */
        var moduleName = 'angularUtils.directives.dirPagination';
        var DEFAULT_ID = '__default';

        /**
         * Module
         */
        angular.module(moduleName, [])
                .directive('dirPaginate', ['$compile', '$parse', 'paginationService', dirPaginateDirective])
                .directive('dirPaginateNoCompile', noCompileDirective)
                .directive('dirPaginationControls', ['paginationService', 'paginationTemplate', dirPaginationControlsDirective])
                .filter('itemsPerPage', ['paginationService', itemsPerPageFilter])
                .service('paginationService', paginationService)
                .provider('paginationTemplate', paginationTemplateProvider)
                .run(['$templateCache', dirPaginationControlsTemplateInstaller]);

        function dirPaginateDirective($compile, $parse, paginationService) {

            return  {
                terminal: true,
                multiElement: true,
                priority: 100,
                compile: dirPaginationCompileFn
            };

            function dirPaginationCompileFn(tElement, tAttrs) {

                var expression = tAttrs.dirPaginate;
                // regex taken directly from https://github.com/angular/angular.js/blob/v1.4.x/src/ng/directive/ngRepeat.js#L339
                var match = expression.match(/^\s*([\s\S]+?)\s+in\s+([\s\S]+?)(?:\s+as\s+([\s\S]+?))?(?:\s+track\s+by\s+([\s\S]+?))?\s*$/);

                var filterPattern = /\|\s*itemsPerPage\s*:\s*(.*\(\s*\w*\)|([^\)]*?(?=\s+as\s+))|[^\)]*)/;
                if (match[2].match(filterPattern) === null) {
                    throw 'pagination directive: the \'itemsPerPage\' filter must be set.';
                }
                var itemsPerPageFilterRemoved = match[2].replace(filterPattern, '');
                var collectionGetter = $parse(itemsPerPageFilterRemoved);

                addNoCompileAttributes(tElement);

                // If any value is specified for paginationId, we register the un-evaluated expression at this stage for the benefit of any
                // dir-pagination-controls directives that may be looking for this ID.
                var rawId = tAttrs.paginationId || DEFAULT_ID;
                paginationService.registerInstance(rawId);

                return function dirPaginationLinkFn(scope, element, attrs) {

                    // Now that we have access to the `scope` we can interpolate any expression given in the paginationId attribute and
                    // potentially register a new ID if it evaluates to a different value than the rawId.
                    var paginationId = $parse(attrs.paginationId)(scope) || attrs.paginationId || DEFAULT_ID;

                    // (TODO: this seems sound, but I'm reverting as many bug reports followed it's introduction in 0.11.0.
                    // Needs more investigation.)
                    // In case rawId != paginationId we deregister using rawId for the sake of general cleanliness
                    // before registering using paginationId
                    // paginationService.deregisterInstance(rawId);
                    paginationService.registerInstance(paginationId);

                    var repeatExpression = getRepeatExpression(expression, paginationId);
                    addNgRepeatToElement(element, attrs, repeatExpression);

                    removeTemporaryAttributes(element);
                    var compiled = $compile(element);

                    var currentPageGetter = makeCurrentPageGetterFn(scope, attrs, paginationId);
                    paginationService.setCurrentPageParser(paginationId, currentPageGetter, scope);

                    if (typeof attrs.totalItems !== 'undefined') {
                        paginationService.setAsyncModeTrue(paginationId);
                        scope.$watch(function () {
                            return $parse(attrs.totalItems)(scope);
                        }, function (result) {
                            if (0 <= result) {
                                paginationService.setCollectionLength(paginationId, result);
                            }
                        });
                    } else {
                        paginationService.setAsyncModeFalse(paginationId);
                        scope.$watchCollection(function () {
                            return collectionGetter(scope);
                        }, function (collection) {
                            if (collection) {
                                var collectionLength = (collection instanceof Array) ? collection.length : Object.keys(collection).length;
                                paginationService.setCollectionLength(paginationId, collectionLength);
                            }
                        });
                    }

                    // Delegate to the link function returned by the new compilation of the ng-repeat
                    compiled(scope);

                    // (TODO: Reverting this due to many bug reports in v 0.11.0. Needs investigation as the
                    // principle is sound)
                    // When the scope is destroyed, we make sure to remove the reference to it in paginationService
                    // so that it can be properly garbage collected
                    // scope.$on('$destroy', function destroyDirPagination() {
                    //     paginationService.deregisterInstance(paginationId);
                    // });
                };
            }

            /**
             * If a pagination id has been specified, we need to check that it is present as the second argument passed to
             * the itemsPerPage filter. If it is not there, we add it and return the modified expression.
             *
             * @param expression
             * @param paginationId
             * @returns {*}
             */
            function getRepeatExpression(expression, paginationId) {
                var repeatExpression,
                        idDefinedInFilter = !!expression.match(/(\|\s*itemsPerPage\s*:[^|]*:[^|]*)/);

                if (paginationId !== DEFAULT_ID && !idDefinedInFilter) {
                    repeatExpression = expression.replace(/(\|\s*itemsPerPage\s*:\s*[^|\s]*)/, "$1 : '" + paginationId + "'");
                } else {
                    repeatExpression = expression;
                }

                return repeatExpression;
            }

            /**
             * Adds the ng-repeat directive to the element. In the case of multi-element (-start, -end) it adds the
             * appropriate multi-element ng-repeat to the first and last element in the range.
             * @param element
             * @param attrs
             * @param repeatExpression
             */
            function addNgRepeatToElement(element, attrs, repeatExpression) {
                if (element[0].hasAttribute('dir-paginate-start') || element[0].hasAttribute('data-dir-paginate-start')) {
                    // using multiElement mode (dir-paginate-start, dir-paginate-end)
                    attrs.$set('ngRepeatStart', repeatExpression);
                    element.eq(element.length - 1).attr('ng-repeat-end', true);
                } else {
                    attrs.$set('ngRepeat', repeatExpression);
                }
            }

            /**
             * Adds the dir-paginate-no-compile directive to each element in the tElement range.
             * @param tElement
             */
            function addNoCompileAttributes(tElement) {
                angular.forEach(tElement, function (el) {
                    if (el.nodeType === 1) {
                        angular.element(el).attr('dir-paginate-no-compile', true);
                    }
                });
            }

            /**
             * Removes the variations on dir-paginate (data-, -start, -end) and the dir-paginate-no-compile directives.
             * @param element
             */
            function removeTemporaryAttributes(element) {
                angular.forEach(element, function (el) {
                    if (el.nodeType === 1) {
                        angular.element(el).removeAttr('dir-paginate-no-compile');
                    }
                });
                element.eq(0).removeAttr('dir-paginate-start').removeAttr('dir-paginate').removeAttr('data-dir-paginate-start').removeAttr('data-dir-paginate');
                element.eq(element.length - 1).removeAttr('dir-paginate-end').removeAttr('data-dir-paginate-end');
            }

            /**
             * Creates a getter function for the current-page attribute, using the expression provided or a default value if
             * no current-page expression was specified.
             *
             * @param scope
             * @param attrs
             * @param paginationId
             * @returns {*}
             */
            function makeCurrentPageGetterFn(scope, attrs, paginationId) {
                var currentPageGetter;
                if (attrs.currentPage) {
                    currentPageGetter = $parse(attrs.currentPage);
                } else {
                    // If the current-page attribute was not set, we'll make our own.
                    // Replace any non-alphanumeric characters which might confuse
                    // the $parse service and give unexpected results.
                    // See https://github.com/michaelbromley/angularUtils/issues/233
                    var defaultCurrentPage = (paginationId + '__currentPage').replace(/\W/g, '_');
                    scope[defaultCurrentPage] = 1;
                    currentPageGetter = $parse(defaultCurrentPage);
                }
                return currentPageGetter;
            }
        }

        /**
         * This is a helper directive that allows correct compilation when in multi-element mode (ie dir-paginate-start, dir-paginate-end).
         * It is dynamically added to all elements in the dir-paginate compile function, and it prevents further compilation of
         * any inner directives. It is then removed in the link function, and all inner directives are then manually compiled.
         */
        function noCompileDirective() {
            return {
                priority: 5000,
                terminal: true
            };
        }

        function dirPaginationControlsTemplateInstaller($templateCache) {
            $templateCache.put('angularUtils.directives.dirPagination.template', '<ul class="pagination" ng-if="1 < pages.length || !autoHide"><li ng-if="boundaryLinks" ng-class="{ disabled : pagination.current == 1 }"><a href="" ng-click="setCurrent(1)">&laquo;</a></li><li ng-if="directionLinks" ng-class="{ disabled : pagination.current == 1 }"><a href="" ng-click="setCurrent(pagination.current - 1)">&lsaquo;</a></li><li ng-repeat="pageNumber in pages track by tracker(pageNumber, $index)" ng-class="{ active : pagination.current == pageNumber, disabled : pageNumber == \'...\' || ( ! autoHide && pages.length === 1 ) }"><a href="" ng-click="setCurrent(pageNumber)">{{ pageNumber }}</a></li><li ng-if="directionLinks" ng-class="{ disabled : pagination.current == pagination.last }"><a href="" ng-click="setCurrent(pagination.current + 1)">&rsaquo;</a></li><li ng-if="boundaryLinks"  ng-class="{ disabled : pagination.current == pagination.last }"><a href="" ng-click="setCurrent(pagination.last)">&raquo;</a></li></ul>');
        }

        function dirPaginationControlsDirective(paginationService, paginationTemplate) {

            var numberRegex = /^\d+$/;

            var DDO = {
                restrict: 'AE',
                scope: {
                    maxSize: '=?',
                    onPageChange: '&?',
                    paginationId: '=?',
                    autoHide: '=?'
                },
                link: dirPaginationControlsLinkFn
            };

            // We need to check the paginationTemplate service to see whether a template path or
            // string has been specified, and add the `template` or `templateUrl` property to
            // the DDO as appropriate. The order of priority to decide which template to use is
            // (highest priority first):
            // 1. paginationTemplate.getString()
            // 2. attrs.templateUrl
            // 3. paginationTemplate.getPath()
            var templateString = paginationTemplate.getString();
            if (templateString !== undefined) {
                DDO.template = templateString;
            } else {
                DDO.templateUrl = function (elem, attrs) {
                    return attrs.templateUrl || paginationTemplate.getPath();
                };
            }
            return DDO;

            function dirPaginationControlsLinkFn(scope, element, attrs) {

                // rawId is the un-interpolated value of the pagination-id attribute. This is only important when the corresponding dir-paginate directive has
                // not yet been linked (e.g. if it is inside an ng-if block), and in that case it prevents this controls directive from assuming that there is
                // no corresponding dir-paginate directive and wrongly throwing an exception.
                var rawId = attrs.paginationId || DEFAULT_ID;
                var paginationId = scope.paginationId || attrs.paginationId || DEFAULT_ID;

                if (!paginationService.isRegistered(paginationId) && !paginationService.isRegistered(rawId)) {
                    var idMessage = (paginationId !== DEFAULT_ID) ? ' (id: ' + paginationId + ') ' : ' ';
                    if (window.console) {
                        console.warn('Pagination directive: the pagination controls' + idMessage + 'cannot be used without the corresponding pagination directive, which was not found at link time.');
                    }
                }

                if (!scope.maxSize) {
                    scope.maxSize = 9;
                }
                scope.autoHide = scope.autoHide === undefined ? true : scope.autoHide;
                scope.directionLinks = angular.isDefined(attrs.directionLinks) ? scope.$parent.$eval(attrs.directionLinks) : true;
                scope.boundaryLinks = angular.isDefined(attrs.boundaryLinks) ? scope.$parent.$eval(attrs.boundaryLinks) : false;

                var paginationRange = Math.max(scope.maxSize, 5);
                scope.pages = [];
                scope.pagination = {
                    last: 1,
                    current: 1
                };
                scope.range = {
                    lower: 1,
                    upper: 1,
                    total: 1
                };

                scope.$watch('maxSize', function (val) {
                    if (val) {
                        paginationRange = Math.max(scope.maxSize, 5);
                        generatePagination();
                    }
                });

                scope.$watch(function () {
                    if (paginationService.isRegistered(paginationId)) {
                        return (paginationService.getCollectionLength(paginationId) + 1) * paginationService.getItemsPerPage(paginationId);
                    }
                }, function (length) {
                    if (0 < length) {
                        generatePagination();
                    }
                });

                scope.$watch(function () {
                    if (paginationService.isRegistered(paginationId)) {
                        return (paginationService.getItemsPerPage(paginationId));
                    }
                }, function (current, previous) {
                    if (current !== previous && typeof previous !== 'undefined') {
                        goToPage(scope.pagination.current);
                    }
                });

                scope.$watch(function () {
                    if (paginationService.isRegistered(paginationId)) {
                        return paginationService.getCurrentPage(paginationId);
                    }
                }, function (currentPage, previousPage) {
                    if (currentPage !== previousPage) {
                        goToPage(currentPage);
                    }
                });

                scope.setCurrent = function (num) {
                    if (paginationService.isRegistered(paginationId) && isValidPageNumber(num)) {
                        num = parseInt(num, 10);
                        paginationService.setCurrentPage(paginationId, num);
                    }
                };

                /**
                 * Custom "track by" function which allows for duplicate "..." entries on long lists,
                 * yet fixes the problem of wrongly-highlighted links which happens when using
                 * "track by $index" - see https://github.com/michaelbromley/angularUtils/issues/153
                 * @param id
                 * @param index
                 * @returns {string}
                 */
                scope.tracker = function (id, index) {
                    return id + '_' + index;
                };

                function goToPage(num) {
                    if (paginationService.isRegistered(paginationId) && isValidPageNumber(num)) {
                        var oldPageNumber = scope.pagination.current;

                        scope.pages = generatePagesArray(num, paginationService.getCollectionLength(paginationId), paginationService.getItemsPerPage(paginationId), paginationRange);
                        scope.pagination.current = num;
                        updateRangeValues();

                        // if a callback has been set, then call it with the page number as the first argument
                        // and the previous page number as a second argument
                        if (scope.onPageChange) {
                            scope.onPageChange({
                                newPageNumber: num,
                                oldPageNumber: oldPageNumber
                            });
                        }
                    }
                }

                function generatePagination() {
                    if (paginationService.isRegistered(paginationId)) {
                        var page = parseInt(paginationService.getCurrentPage(paginationId)) || 1;
                        scope.pages = generatePagesArray(page, paginationService.getCollectionLength(paginationId), paginationService.getItemsPerPage(paginationId), paginationRange);
                        scope.pagination.current = page;
                        scope.pagination.last = scope.pages[scope.pages.length - 1];
                        if (scope.pagination.last < scope.pagination.current) {
                            scope.setCurrent(scope.pagination.last);
                        } else {
                            updateRangeValues();
                        }
                    }
                }

                /**
                 * This function updates the values (lower, upper, total) of the `scope.range` object, which can be used in the pagination
                 * template to display the current page range, e.g. "showing 21 - 40 of 144 results";
                 */
                function updateRangeValues() {
                    if (paginationService.isRegistered(paginationId)) {
                        var currentPage = paginationService.getCurrentPage(paginationId),
                                itemsPerPage = paginationService.getItemsPerPage(paginationId),
                                totalItems = paginationService.getCollectionLength(paginationId);

                        scope.range.lower = (currentPage - 1) * itemsPerPage + 1;
                        scope.range.upper = Math.min(currentPage * itemsPerPage, totalItems);
                        scope.range.total = totalItems;
                    }
                }
                function isValidPageNumber(num) {
                    return (numberRegex.test(num) && (0 < num && num <= scope.pagination.last));
                }
            }

            /**
             * Generate an array of page numbers (or the '...' string) which is used in an ng-repeat to generate the
             * links used in pagination
             *
             * @param currentPage
             * @param rowsPerPage
             * @param paginationRange
             * @param collectionLength
             * @returns {Array}
             */
            function generatePagesArray(currentPage, collectionLength, rowsPerPage, paginationRange) {
                var pages = [];
                var totalPages = Math.ceil(collectionLength / rowsPerPage);
                var halfWay = Math.ceil(paginationRange / 2);
                var position;

                if (currentPage <= halfWay) {
                    position = 'start';
                } else if (totalPages - halfWay < currentPage) {
                    position = 'end';
                } else {
                    position = 'middle';
                }

                var ellipsesNeeded = paginationRange < totalPages;
                var i = 1;
                while (i <= totalPages && i <= paginationRange) {
                    var pageNumber = calculatePageNumber(i, currentPage, paginationRange, totalPages);

                    var openingEllipsesNeeded = (i === 2 && (position === 'middle' || position === 'end'));
                    var closingEllipsesNeeded = (i === paginationRange - 1 && (position === 'middle' || position === 'start'));
                    if (ellipsesNeeded && (openingEllipsesNeeded || closingEllipsesNeeded)) {
                        pages.push('...');
                    } else {
                        pages.push(pageNumber);
                    }
                    i++;
                }
                return pages;
            }

            /**
             * Given the position in the sequence of pagination links [i], figure out what page number corresponds to that position.
             *
             * @param i
             * @param currentPage
             * @param paginationRange
             * @param totalPages
             * @returns {*}
             */
            function calculatePageNumber(i, currentPage, paginationRange, totalPages) {
                var halfWay = Math.ceil(paginationRange / 2);
                if (i === paginationRange) {
                    return totalPages;
                } else if (i === 1) {
                    return i;
                } else if (paginationRange < totalPages) {
                    if (totalPages - halfWay < currentPage) {
                        return totalPages - paginationRange + i;
                    } else if (halfWay < currentPage) {
                        return currentPage - halfWay + i;
                    } else {
                        return i;
                    }
                } else {
                    return i;
                }
            }
        }

        /**
         * This filter slices the collection into pages based on the current page number and number of items per page.
         * serve para quebrar as paginas na quantidade maxima de itens
         * @param paginationService
         * @returns {Function}
         */
        function itemsPerPageFilter(paginationService) {
            return function (collection, itemsPerPage, paginationId) {
                if (typeof (paginationId) === 'undefined') {
                    paginationId = DEFAULT_ID;
                }
                if (!paginationService.isRegistered(paginationId)) {
                    throw 'pagination directive: the itemsPerPage id argument (id: ' + paginationId + ') does not match a registered pagination-id.';
                }
                var end;
                var start;
                if (angular.isObject(collection)) {
                    itemsPerPage = parseInt(itemsPerPage) || 9999999999;
                    if (paginationService.isAsyncMode(paginationId)) {
                        start = 0;
                    } else {
                        start = (paginationService.getCurrentPage(paginationId) - 1) * itemsPerPage;
                    }
                    end = start + itemsPerPage;
                    paginationService.setItemsPerPage(paginationId, itemsPerPage);

                    if (collection instanceof Array) {
                        // the array just needs to be sliced
                        return collection.slice(start, end);
                    } else {
                        // in the case of an object, we need to get an array of keys, slice that, then map back to
                        // the original object.
                        var slicedObject = {};
                        angular.forEach(keys(collection).slice(start, end), function (key) {
                            slicedObject[key] = collection[key];
                        });
                        return slicedObject;
                    }
                } else {
                    return collection;
                }
            };
        }

        /**
         * Shim for the Object.keys() method which does not exist in IE < 9
         * @param obj
         * @returns {Array}
         */
        function keys(obj) {
            if (!Object.keys) {
                var objKeys = [];
                for (var i in obj) {
                    if (obj.hasOwnProperty(i)) {
                        objKeys.push(i);
                    }
                }
                return objKeys;
            } else {
                return Object.keys(obj);
            }
        }

        /**
         * This service allows the various parts of the module to communicate and stay in sync.
         */
        function paginationService() {

            var instances = {};
            var lastRegisteredInstance;

            this.registerInstance = function (instanceId) {
                if (typeof instances[instanceId] === 'undefined') {
                    instances[instanceId] = {
                        asyncMode: false
                    };
                    lastRegisteredInstance = instanceId;
                }
            };

            this.deregisterInstance = function (instanceId) {
                delete instances[instanceId];
            };

            this.isRegistered = function (instanceId) {
                return (typeof instances[instanceId] !== 'undefined');
            };

            this.getLastInstanceId = function () {
                return lastRegisteredInstance;
            };

            this.setCurrentPageParser = function (instanceId, val, scope) {
                instances[instanceId].currentPageParser = val;
                instances[instanceId].context = scope;
            };
            this.setCurrentPage = function (instanceId, val) {
                instances[instanceId].currentPageParser.assign(instances[instanceId].context, val);
            };
            this.getCurrentPage = function (instanceId) {
                var parser = instances[instanceId].currentPageParser;
                return parser ? parser(instances[instanceId].context) : 1;
            };

            this.setItemsPerPage = function (instanceId, val) {
                instances[instanceId].itemsPerPage = val;
            };
            this.getItemsPerPage = function (instanceId) {
                return instances[instanceId].itemsPerPage;
            };

            this.setCollectionLength = function (instanceId, val) {
                instances[instanceId].collectionLength = val;
            };
            this.getCollectionLength = function (instanceId) {
                return instances[instanceId].collectionLength;
            };

            this.setAsyncModeTrue = function (instanceId) {
                instances[instanceId].asyncMode = true;
            };

            this.setAsyncModeFalse = function (instanceId) {
                instances[instanceId].asyncMode = false;
            };

            this.isAsyncMode = function (instanceId) {
                return instances[instanceId].asyncMode;
            };
        }

        /**
         * This provider allows global configuration of the template path used by the dir-pagination-controls directive.
         */
        function paginationTemplateProvider() {

            var templatePath = 'angularUtils.directives.dirPagination.template';
            var templateString;

            /**
             * Set a templateUrl to be used by all instances of <dir-pagination-controls>
             * @param {String} path
             */
            this.setPath = function (path) {
                templatePath = path;
            };

            /**
             * Set a string of HTML to be used as a template by all instances
             * of <dir-pagination-controls>. If both a path *and* a string have been set,
             * the string takes precedence.
             * @param {String} str
             */
            this.setString = function (str) {
                templateString = str;
            };

            this.$get = function () {
                return {
                    getPath: function () {
                        return templatePath;
                    },
                    getString: function () {
                        return templateString;
                    }
                };
            };
        }
    })();
</script>