package br.com.jessicaabta.controle;

import br.com.jessicaabta.modelo.Usuario;
import br.com.jessicaabta.modelo.UsuarioDAOImpl;
import br.com.jessicaabta.modelo.UsuarioExisteException;
import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletCadastrar extends HttpServlet {

    private void erro(HttpServletRequest request, String erro) {
        request.setAttribute("erro", "Erro: " + erro);
        request.setAttribute("anotacao", Util.decodificar(request.getParameter("anotacao")));
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        if (!request.getSession().isNew() && request.getSession().getAttribute("usuario") != null) {
            response.sendRedirect("bloco");
        } else {
            response.sendRedirect("cadastrar.jsp");
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        if (!request.getSession().isNew() && request.getSession().getAttribute("usuario") != null) {
            response.sendRedirect("bloco");
        } else {
            try {
                Usuario usuario = new Usuario(Util.decodificar(request.getParameter("anotacao")), Util.decodificar(request.getParameter("senha")));
                new UsuarioDAOImpl().cadastrar(usuario);
                request.setAttribute("sucesso", "Usuário \"" + usuario.getTarefa() + "\" cadastrado com sucesso.");
            } catch (IllegalArgumentException | IndexOutOfBoundsException | UsuarioExisteException e) {
                erro(request, e.getMessage());
            }
            request.getRequestDispatcher("cadastrar.jsp").forward(request, response);
        }
    }
}
