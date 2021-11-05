package br.com.jessicaabta.controle;

import br.com.jessicaabta.modelo.TarefaNaoExisteException;
import br.com.jessicaabta.modelo.Tarefa;
import br.com.jessicaabta.modelo.TarefaDAOImpl;
import br.com.jessicaabta.modelo.Usuario;
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletRemover extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        Usuario usuario = (Usuario) request.getSession().getAttribute("usuario");

        if (!request.getSession().isNew() && usuario != null) {
            try {
                Tarefa anotacao = new Tarefa(
                        Integer.parseInt(request.getParameter("id")),
                        Util.decodificar(request.getParameter("anotacao")));
                new TarefaDAOImpl().remover(usuario.getId(), anotacao);
                request.setAttribute("sucesso", "Tarefa removida com sucesso.");
            } catch (TarefaNaoExisteException e) {
                request.setAttribute("erro", "Erro: " + e.getMessage());
            }
        }

        request.getRequestDispatcher("bloco").forward(request, response);
    }
}
