<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body style="font-family: Arial; font-size: 12px;">
		<span>
			<strong>Nome:</strong>
			<?php $this->printVal('nome', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>E-mail:</strong> 
			<?php $this->printVal('email', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>Telefone:</strong> 
			<?php $this->printVal('telefone', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>Convênio:</strong> 
			<?php $this->printVal('convenio', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>Data de preferência:</strong> 
			<?php echo date('d/m/Y', strtotime(@$data)); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>Período de preferência:</strong> 
			<?php $this->printVal('periodo', ''); ?>
		</span>
		<?php $this->printbr(2); ?>
		<span>
			<strong>Exame desejado:</strong> 
			<?php $this->printVal('exame', ''); ?>
		</span>
		<?php $this->printbr(1); ?>
		<p style="font-size: 14px;">
			<?php $this->printVal('mensagem', ''); ?>
		</p>
	</body>
</html>