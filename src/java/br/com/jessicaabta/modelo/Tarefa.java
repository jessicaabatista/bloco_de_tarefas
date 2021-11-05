package br.com.jessicaabta.modelo;


public class Tarefa implements java.io.Serializable {

    private static final long serialVersionUID = -2319598745423332344L;
    
    private int id;
    private String anotacao;

    public Tarefa() {

    }

    public Tarefa(String anotacao) {
        this.anotacao = anotacao;
    }

    public Tarefa(int id, String anotacao) {
        this.id = id;
        this.anotacao = anotacao;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTarefa() {
        return anotacao;
    }

    public void setTarefa(String anotacao) {
        this.anotacao = anotacao;
    }

    public boolean equals(Tarefa anotacao) {
        return anotacao instanceof Tarefa
                && getTarefa().equals((anotacao).getTarefa());
    }
}
