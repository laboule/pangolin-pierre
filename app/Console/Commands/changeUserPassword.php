<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangeUserPassword extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'user:password {name : username} {password : mot de passe}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Change a user password';

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
			$user = User::where('name', $this->argument('name'))->first();
			if ($user) {
				$user->password = Hash::make($this->argument('password'));
				$user->save();
				$this->info("User password updated !");
			} else {
				$this->error("No user found with this name");
			}

		} catch (\Exception $e) {
			// var_dump($e);
			$this->error("Error updating user password");
		}
	}
}
