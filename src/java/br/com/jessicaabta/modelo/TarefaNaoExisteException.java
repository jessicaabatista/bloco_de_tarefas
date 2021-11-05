package br.com.jessicaabta.modelo;


public class TarefaNaoExisteException extends Exception {

    public TarefaNaoExisteException() {
        super("Essa tarefa não existe.");
    }

    public TarefaNaoExisteException(String mensagem) {
        super(mensagem);
    }
}
