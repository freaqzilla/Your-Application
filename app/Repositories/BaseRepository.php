<?php

namespace App\Repositories;

Interface UserRepositoryInterface
{
    public function selectAll();
	
	public function find($id);

}
