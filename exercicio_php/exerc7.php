<!-- 7  Descrever a sua funcionalidade e fazer exemplos das seguintes funções do PHP:
a) array() 
b) trim()
c) substr()
d) strtolower()
e) strtoupper()
f) ucfirst()
g) ucwords()
h) explode()
i) var_dump()
j) implode()
k) htmlspecialchars()
l) join()
m) isset()
n) strlen()
o) is_float(), is_int(), is_array(), is_string(), is_bool(), is_numeric()
p) getdate()
q) empty()
r) strip_tags()
s) max(), min()
t) abs()
u) ceil(), floor(), round()
v) rand()
w) sqrt()
x) str_replace()
y) count()
z) htmlentities() -->
<meta charset="UTF-8"> 
	
	<?php $title= "Site.com";
	  $subtitle = "este é um site em PHP";
	?>
  
  
  <!DOCTYPE html>
  	<html>
  		<head>
  			<title>
  				<?php 
  				echo $title."-".$subtitle;
				//. é para concatenar 
				?>
  			</title>
  		</head>
  	
  		<body>
  			<?php 
  			echo $title."-".$subtitle;
			?>
			
			
			<div class="rodape"> 
				® copyright Site.com – 2012
				</div>
  		</body>
  
   	</html>