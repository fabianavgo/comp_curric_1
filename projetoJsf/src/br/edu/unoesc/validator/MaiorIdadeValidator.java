package br.edu.unoesc.validator;

import javax.faces.application.FacesMessage;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.validator.FacesValidator;
import javax.faces.validator.Validator;
import javax.faces.validator.ValidatorException;

@FacesValidator(value="maiorIdadeValidator") /**para identificar a classe como validadora, value � o nome*/
public class MaiorIdadeValidator implements Validator {

	@Override
	public void validate(FacesContext facesContext, UIComponent arg1, Object arg2)
			throws ValidatorException {
		if(arg2 instanceof Integer) { //instance of para ver se � instancia de alguma classe
			Integer idade = (Integer)arg2;  
			
			if (idade<18) {
				//exe��o de valida��o
				FacesMessage m = new FacesMessage();
				m.setDetail("Voc� precisa ter mais de 18 anos.");
				
				
				throw new ValidatorException(m);
				
				
			}
						
		}
		
	}
	
	
	
}
