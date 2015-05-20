<?php
 namespace Jai\Backend\Contracts;
/**
 * 
 * @author JaiKora  <Kora.jayaram@gmail.comsss>
 *         TODO: may be make this abstract class
 */
 interface BackendInterface
{
	 /**
	  * @param $entity
	  *
	  * @return mixed
	  */
	 public function all($entity);

	 /**
	  * @param $entity
	  *
	  * @return mixed
	  */
	 public function edit($entity);



}