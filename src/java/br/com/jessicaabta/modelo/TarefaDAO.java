package br.com.jessicaabta.modelo;


public interface TarefaDAO {

    public void cadastrar(int usuario_id, Tarefa anotacao)
            throws IndexOutOfBoundsException, IllegalArgumentException, TarefaExisteException;

    public java.util.ArrayList<Tarefa> carregar(Usuario usuario);

    public boolean anotacaoExiste(int usuario_id, Tarefa anotacao);

    public void alterar(int usuario_id, Tarefa anotacao)
            throws IndexOutOfBoundsException, IllegalArgumentException, TarefaExisteException, TarefaNaoExisteException;

    public void remover(int usuario_id, Tarefa anotacao)
            throws TarefaNaoExisteException;
}
