package br.com.jessicaabta.controle;

import br.com.jessicaabta.modelo.TarefaExisteException;
import br.com.jessicaabta.modelo.Tarefa;
import br.com.jessicaabta.modelo.TarefaDAOImpl;
import br.com.jessicaabta.modelo.Usuario;
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletNovo extends HttpServlet {

    private void erro(HttpServletRequest request, String erro) {
        request.setAttribute("erro", "Erro: " + erro);
        request.setAttribute("anotacao", Util.decodificar(request.getParameter("anotacao")));
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        response.sendRedirect("novo.jsp");
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        Usuario usuario = (Usuario) request.getSession().getAttribute("usuario");

        if (!request.getSession().isNew() && usuario != null) {
            try {
                Tarefa anotacao = new Tarefa(Util.decodificar(request.getParameter("anotacao")));
                new TarefaDAOImpl().cadastrar(usuario.getId(), anotacao);
                request.setAttribute("sucesso", "Nova tarefa cadastrada com sucesso.");
            } catch (IndexOutOfBoundsException | IllegalArgumentException | TarefaExisteException e) {
                erro(request, e.getMessage());
            }
        }

        request.getRequestDispatcher("novo.jsp").forward(request, response);
    }
}
