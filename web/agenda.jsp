<!-- jessicaabta -->
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix ="c"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Projeto Bloco de Tarefas</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/app.js" type="text/javascript"></script>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="btn-group pull-right">
                <form class="btn-group" action="novo" method="GET">
                    <button type="submit" class="btn btn-link">Cadastrar tarefas</button>
                </form>
                <form class="btn-group">
                    <h5> | </h5>
                </form>
                <form class="btn-group" action="logout" method="POST">
                    <button type="submit" class="btn btn-link">Sair</button>
                </form>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-2 col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-5 text-center">
                    <h4>Suas tarefas</h4>
                </div>
            </div>
            <c:choose>
                <c:when test="${tarefas != null && !tarefas.isEmpty()}">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xs-offset-0 col-sm-offset-1 col-md-offset-1 col-lg-offset-2 text-center">
                            <table id="tabelaAnotacoes" class="table table-bordered">
                                <thead>
                                    <th class="text-center" onclick="sortTable(0)">ANOTAÇÃO</th>
                                    <th class="text-center" style="cursor:text">ALTERAR</th>
                                    <th class="text-center" style="cursor:text">REMOVER</th>
                                </thead>
                                <c:forEach items="${tarefas}" var="nota">
                                    <tr>
                                        <td>${nota.anotacao}</td>
                                        <td>
                                            <a href='javascript:confirmaAlterar("${nota.id}","${nota.anotacao}");'
                                               class="btn btn-info btn-xs">X</a>
                                        </td>
                                        <td>
                                            <a href='javascript:confirmaRemover("${nota.id}","${nota.anotacao}");'
                                               class="btn btn-danger btn-xs">X</a>
                                        </td>
                                    </tr>
                                </c:forEach>
                            </table>
                        </div>
                    </div>
                </c:when>
                <c:when test="${blocovazio != null}">
                    <div class="row">
                        <div class="form-group col-xs-10 col-sm-8 col-md-6 col-lg-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 text-center">
                            <span class="help-block" style="color:red">${blocovazio}</span>
                        </div>
                    </div>
                </c:when>
            </c:choose>
            <c:if test="${sucesso != null || erro != null}">
                <div class="row">
                    <div class="form-group col-xs-10 col-sm-8 col-md-6 col-lg-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 text-center">
                        <c:choose>
                            <c:when test="${sucesso != null}">
                                <span class="help-block" style="color:limegreen">${sucesso}</span>
                            </c:when>
                            <c:when test="${erro != null}">
                                <span class="help-block" style="color:red">${erro}</span>
                            </c:when>
                        </c:choose>
                    </div>
                </div>   
            </c:if>
            <div class="row">
                <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-2 col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-5 text-center">
                    <span class="help-block">@jessicaabta</span>
                </div>
            </div>
        </div>
    </body>
</html>
