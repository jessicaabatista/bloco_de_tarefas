package br.com.jessicaabta.modelo;


public class Usuario implements java.io.Serializable {
    
    private static final long serialVersionUID = -1853712843268014785L;

    private int id;
    private String anotacao, senha;

    public Usuario() {

    }

    public Usuario(String anotacao, String senha) {
        this.anotacao = anotacao;
        this.senha = senha;
    }

    public Usuario(int id, String anotacao, String senha) {
        this.id = id;
        this.anotacao = anotacao;
        this.senha = senha;
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

    public String getSenha() {
        return senha;
    }

    public void setSenha(String senha) {
        this.senha = senha;
    }
}
