package br.com.jessicaabta.controle;

import br.com.jessicaabta.modelo.Tarefa;
import br.com.jessicaabta.modelo.TarefaDAOImpl;
import br.com.jessicaabta.modelo.Usuario;
import java.io.IOException;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletBloco extends HttpServlet {

    @Override
    protected void service(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        Usuario usuario = (Usuario) request.getSession().getAttribute("usuario");

        if (!request.getSession().isNew() && usuario != null) {
            ArrayList<Tarefa> tarefas = new TarefaDAOImpl().carregar(usuario);
            if (!tarefas.isEmpty()) {
                request.setAttribute("tarefas", tarefas);
            } else {
                request.setAttribute("blocovazio", "O bloco não possui tarefas listadas no momento.");
            }
        }

        request.getRequestDispatcher("bloco.jsp").forward(request, response);
    }
}
