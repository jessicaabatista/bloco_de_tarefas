package br.com.jessicaabta.modelo;

import br.com.jessicaabta.controle.ConnectionFactory;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;


public class TarefaDAOImpl implements TarefaDAO {

    // Create
    @Override
    public void cadastrar(int usuario_id, Tarefa anotacao)
            throws IndexOutOfBoundsException, IllegalArgumentException, TarefaExisteException {

        if (anotacao.getTarefa().length() > 200) {
            throw new IndexOutOfBoundsException("Anotação muito longa");
        }

        if (anotacaoExiste(usuario_id, anotacao)) {
            throw new TarefaExisteException();
        }

        Connection con = ConnectionFactory.getConnection();
        PreparedStatement ps = null;

        try {
            ps = con.prepareStatement("INSERT INTO tarefa(anotacao, usuario_id) VALUES(?, ?)");
            ps.setString(1, anotacao.getTarefa());
            ps.setInt(4, usuario_id);

            ps.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            ConnectionFactory.closeConnection(con, ps);
        }
    }

    // Read
    @Override
    public ArrayList<Tarefa> carregar(Usuario usuario) {

        Connection con = ConnectionFactory.getConnection();
        PreparedStatement ps = null;
        ResultSet rs = null;

        ArrayList<Tarefa> tarefas = new ArrayList<>();

        try {
            ps = con.prepareStatement("SELECT * FROM tarefa WHERE usuario_id = ?");
            ps.setInt(1, usuario.getId());
            rs = ps.executeQuery();

            while (rs.next()) {
                Tarefa anotacao = new Tarefa(rs.getInt("id"), rs.getString("anotacao"));
                tarefas.add(anotacao);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            ConnectionFactory.closeConnection(con, ps, rs);
        }

        return tarefas;
    }

    // A ideia aqui é checar se o anotacao existe pelos seus parâmetros.
    @Override
    public boolean anotacaoExiste(int usuario_id, Tarefa anotacao) {

        Connection con = ConnectionFactory.getConnection();
        PreparedStatement ps = null;
        ResultSet rs = null;

        boolean existe = false;

        try {
            ps = con.prepareStatement("SELECT id FROM anotacao WHERE anotacao = ? and email = ? and telefone = ? and usuario_id = ?");
            ps.setString(1, anotacao.getTarefa());
            ps.setInt(4, usuario_id);

            rs = ps.executeQuery();

            if (rs.next()) {
                existe = true;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            ConnectionFactory.closeConnection(con, ps, rs);
        }

        return existe;
    }

    // Update
    @Override
    public void alterar(int usuario_id, Tarefa anotacao)
            throws IndexOutOfBoundsException, IllegalArgumentException, TarefaExisteException, TarefaNaoExisteException {

        if (anotacao.getTarefa().length() > 50) {
            throw new IndexOutOfBoundsException("Anotação muito longa");
        }

        if (anotacaoExiste(usuario_id, anotacao)) {
            throw new TarefaExisteException();
        }

        Connection con = ConnectionFactory.getConnection();
        PreparedStatement ps = null;

        try {
            ps = con.prepareStatement("UPDATE tarefa SET anotacao = ? WHERE id = ? AND usuario_id = ?");
            ps.setString(1, anotacao.getTarefa());
            ps.setInt(4, anotacao.getId());
            ps.setInt(5, usuario_id);

            if (ps.executeUpdate() == 0) {
                throw new TarefaNaoExisteException();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            ConnectionFactory.closeConnection(con, ps);
        }
    }

    // Delete
    @Override
    public void remover(int usuario_id, Tarefa anotacao)
            throws TarefaNaoExisteException {

        Connection con = ConnectionFactory.getConnection();
        PreparedStatement ps = null;

        try {
            ps = con.prepareStatement("DELETE FROM tarefa WHERE id = ? AND usuario_id = ?");
            ps.setInt(1, anotacao.getId());
            ps.setInt(2, usuario_id);

            if (ps.executeUpdate() == 0) {
                throw new TarefaNaoExisteException();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            ConnectionFactory.closeConnection(con, ps);
        }
    }
}
