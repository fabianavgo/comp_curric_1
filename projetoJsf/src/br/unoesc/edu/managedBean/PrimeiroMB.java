package br.unoesc.edu.managedBean;

import java.io.Serializable;
import java.util.Date;
import javax.faces.bean.ManagedBean;
import javax.faces.bean.SessionScoped;

@ManagedBean
/**S�o tipos de escopos de request.
 * @SessionScoped= quando atualiza nao some os dados, quer dizer que a sess�o nao terminou.
 * @viewscoped permanece com os dados desde que nao troque de pagina, ou seja feito atravez de bot�es*/
public class PrimeiroMB implements Serializable{

	/**
	 * 
	 */
	private static final long serialVersionUID = 7808283262037449298L;
	/**serializable pra que o tomcat consiga gravar classes que n�o s�o usadas.
	 *  */
	
	private String nome;
	private Integer idade;
	private Date dataNascimento;
	
	public Date getDataNascimento() {
		return dataNascimento;
	}

	public void setDataNascimento(Date dataNascimento) {
		this.dataNascimento = dataNascimento;
	}

	public String vaiparaConteudo() {
		return "conteudo";
	}

	public Integer getIdade() {
		return idade;
	}

	public void setIdade(Integer idade) {
		this.idade = idade;
	}

	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}
	
	
}
