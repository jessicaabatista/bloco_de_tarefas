package br.com.jessicaabta.controle;

import br.com.jessicaabta.modelo.Tarefa;
import br.com.jessicaabta.modelo.TarefaDAOImpl;
import br.com.jessicaabta.modelo.TarefaExisteException;
import br.com.jessicaabta.modelo.TarefaNaoExisteException;
import br.com.jessicaabta.modelo.Usuario;
import java.io.IOException;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletAlterar extends HttpServlet {

    private void erro(HttpServletRequest request, String erro) {
        request.setAttribute("erro", "Erro: " + erro);
        request.setAttribute("anotacao", Util.decodificar(request.getParameter("anotacao")));
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        request.setAttribute("id", Util.decodificar(request.getParameter("id")));
        request.setAttribute("anotacao", Util.decodificar(request.getParameter("anotacao")));

        request.getRequestDispatcher("alterar.jsp").forward(request, response);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        RequestDispatcher rd = null;

        Usuario usuario = (Usuario) request.getSession().getAttribute("usuario");

        if (!request.getSession().isNew() && usuario != null) {
            try {
                Tarefa anotacao = new Tarefa(
                        Integer.parseInt(request.getParameter("id")),
                        Util.decodificar(request.getParameter("novaNota")));

                new TarefaDAOImpl().alterar(usuario.getId(), anotacao);

                request.setAttribute("sucesso", "Tarefa alterada com sucesso.");
                rd = request.getRequestDispatcher("bloco");
            } catch (IndexOutOfBoundsException | IllegalArgumentException | TarefaExisteException | TarefaNaoExisteException e) {
                erro(request, e.getMessage());
                rd = request.getRequestDispatcher("alterar.jsp");
            }
        }

        rd.forward(request, response);
    }
}
