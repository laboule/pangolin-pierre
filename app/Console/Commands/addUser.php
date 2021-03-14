<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class addUser extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:create {name : username} {password : mot de passe}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add a user to the DB';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {
		try
		{
			$user = new User;
			$user->name = $this->argument('name');
			$user->password = Hash::make($this->argument('password'));
			$user->save();
			$this->info("User added !");
		} catch (\Exception $e) {
			// var_dump($e);
			$this->info("Error adding user");
		}
	}
}
