package br.com.jessicaabta.modelo;


public class TarefaExisteException extends Exception {

    public TarefaExisteException() {
        super("Tarefa já cadastrada.");
    }

    public TarefaExisteException(String mensagem) {
        super(mensagem);
    }
}
