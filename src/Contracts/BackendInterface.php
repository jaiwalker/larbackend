<?php
 namespace Jai\Backend\Contracts;
/**
 * 
 * @author JaiKora  <Kora.jayaram@gmail.comsss>
 *         TODO: may be make this abstract class
 */
 interface BackendInterface
{
	 public function all($entity);

	 public function edit($entity);

}